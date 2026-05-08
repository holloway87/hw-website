<?php declare(strict_types=1);

namespace App\Component;

use App\Entity\BlogEntry;
use App\Entity\BlogListRequest;

/**
 * Component for the blog.
 *
 * @since 2026.01.08
 */
class BlogComponent
{
    public function __construct(private readonly string $blog_path)
    {}

    /**
     * Read all blog files and set the entries in the request object.
     *
     * @param BlogListRequest $request
     */
    public function listEntries(BlogListRequest $request): void
    {
        if ($request->slug) {
            $path = sprintf('%s/%s.md', $this->blog_path, $request->slug);
            if (\file_exists($path)) {
                $request->entries = [$this->processFile(sprintf('%s.md', $request->slug))];

                return;
            }
        }

        $dir = dir($this->blog_path);
        $files = [];
        while ($file = $dir->read()) {
            if (!preg_match('/\.md$/i', $file)) {
                continue;
            }

            $files[] = $this->processFile($file);
        }
        usort($files, function (BlogEntry $a, BlogEntry $b) {
            if ($a->created == $b->created) {
                return 0;
            }

            return $a->created < $b->created ? 1 : -1;
        });
        if (0 < $request->limit) {
            $files = array_splice($files, 0, $request->limit);
        }
        $request->entries = $files;
    }

    /**
     * Process the file and return the BlogEntry instance.
     *
     * @param string $file
     * @return BlogEntry
     */
    private function processFile(string $file): BlogEntry
    {
        $path = sprintf('%s/%s', $this->blog_path, $file);
        $entry = new BlogEntry;
        $entry->content = file_get_contents($path);
        $entry->slug = mb_substr($file, 0, -3);
        $this->processFileProperties($entry);
        if (null === $entry->created) {
            $entry->created = new \DateTime(sprintf('@%d', filectime($path)));
        }
        if (!$entry->title) {
            $entry->title = $entry->slug;
        }

        return $entry;
    }

    /**
     * Process the file properties and set meta data if found.
     *
     * @param BlogEntry $entry
     */
    private function processFileProperties(BlogEntry $entry): void
    {
        if (!\str_starts_with($entry->content, '---')) {
            return;
        }

        $start = false;
        $end = false;
        do {
            preg_match('/^.*\r?\n/', $entry->content, $match);
            if (!$match) {
                break;
            }
            $line = \mb_trim($match[0]);
            if ('---' === $line) {
                if (!$start) {
                    $start = true;
                } elseif (!$end) {
                    $end = true;
                }
            } elseif (\preg_match('/^(?<key>[^:]+): (?<value>.+)$/', $line, $key_value)) {
                switch ($key_value['key']) {
                    case 'dateCreated':
                        $entry->created = new \DateTime($key_value['value']);
                        break;
                    case 'title':
                        $entry->title = $key_value['value'];
                        break;
                }
            }
            $entry->content = \mb_substr($entry->content, \mb_strlen($match[0]));
        } while (!$end);
    }
}
