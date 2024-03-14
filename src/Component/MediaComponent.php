<?php declare(strict_types=1);

namespace App\Component;

use App\Entity\MediaDirectory;
use App\Entity\MediaFile;
use App\Entity\MediaList;
use App\Entity\MediaListRequest;

/**
 * Component for media files.
 *
 * @since 2024.03.12
 */
class MediaComponent
{
    const string PUBLIC_PATH = __DIR__.'/../../public';

    /**
     * List media files.
     *
     * @param MediaListRequest $request
     * @return void
     */
    public function list(MediaListRequest $request): void
    {
        $directories = [];
        $files = [];
        $path = self::PUBLIC_PATH.$request->getPath();
        $dir = dir($path);
        while ($file = $dir->read()) {
            if ('.' == $file || ('..' == $file && !$request->getPath())) {
                continue;
            }

            if (is_dir($path.'/'.$file)) {
                $directories[] = (new MediaDirectory())->setName(('..' != $file ? '/' : '').$file);
            } else {
                if (!preg_match('/\.(jpe?g|gif|png)$/i', $file)) {
                    continue;
                }

                $files[] = (new MediaFile())->setName($file);
            }
        }
        $dir->close();

        $request->setFiles((new MediaList())
            ->setDirectories($directories)
            ->setFiles($files));
    }
}
