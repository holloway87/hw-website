<?php declare(strict_types=1);

namespace App\Component;

use App\Entity\TimelineEntriesRequest;
use App\Entity\TimelineEntry;
use App\Entity\TimelineEntryImage;

/**
 * Component for timeline entries.
 *
 * @since 2024.02.20
 */
class TimelineComponent
{
    /**
     * Path to timeline entry files.
     */
    const string TIMELINE_PATH = __DIR__.'/../../data/timeline';

    /**
     * Load the entries according to the request data.
     *
     * @param TimelineEntriesRequest $request
     * @return void
     * @throws \Exception
     */
    public function retrieveEntries(TimelineEntriesRequest $request): void
    {
        $timeline_entries = [];
        $dir = dir(self::TIMELINE_PATH);
        while ($file = $dir->read()) {
            if (!preg_match('/^(\d{4})(\d{2})(\d{2})-(\d{2})(\d{2})\.json$/', $file, $match)) {
                continue;
            }

            $data = json_decode(file_get_contents(self::TIMELINE_PATH.'/'.$file), true);
            if (!is_array($data)) {
                continue;
            }
            $data['date'] = new \DateTime(sprintf('%d-%d-%d %d:%d:00', $match[1], $match[2], $match[3],
                $match[4], $match[5]));

            $timeline_entries[$data['date']->format('Ymd-Hi')] = $data;
        }
        $dir->close();
        krsort($timeline_entries);

        $entries = [];
        foreach ($timeline_entries as $key => $data) {
            $entry = (new TimelineEntry())
                ->setId($key)
                ->setDate($data['date'])
                ->setTitle(array_key_exists('title', $data) ? $data['title'] : null)
                ->setContent(array_key_exists('content', $data) ? $data['content'] : null)
                ->setImages(array_map(function (string $image) {
                    $entry_image = (new TimelineEntryImage())
                        ->setUrl($image);
                    $size = getimagesize(__DIR__.'/../../public'.$image);
                    if ($size) {
                        $entry_image->setWidth($size[0])
                            ->setHeight($size[1]);
                    }

                    return $entry_image;
                }, array_key_exists('images', $data) ? $data['images'] : []));

            if ($request->getId()) {
                if ($request->getId() == $key) {
                    $entries = [$entry];
                    break;
                }
            } else {
                $entries[] = $entry;
            }

            if (!$request->getId() && $request->getLimit() && $request->getLimit() == count($entries)) {
                break;
            }
        }

        $request->setEntries($entries);
    }
}
