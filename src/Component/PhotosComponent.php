<?php declare(strict_types=1);

namespace App\Component;

use App\Entity\PhotoFile;
use App\Entity\PhotosListRequest;

/**
 * Component for photos.
 *
 * @since 2022.03.11
 */
class PhotosComponent
{
    /**
     * Path to photo project files.
     */
    private string $path = __DIR__.'/../../public/photos';

    /**
     * Returns the path to the photo files.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function getProjectPath(string $project): string
    {
        return sprintf('%s/%s', $this->path, $project);
    }

    /**
     * Returns if the project is a valid name and exists.
     *
     * @param string $project
     * @return bool
     */
    public function isValidProject(string $project): bool
    {
        if (!preg_match('/^[a-z0-9-_]+$/i', $project)) {
            return false;
        }

        $path = $this->getProjectPath($project);

        return file_exists($path) && is_dir($path);
    }

    /**
     * Creates a file list for a photo project.
     *
     * @param PhotosListRequest $request
     */
    public function listPhotos(PhotosListRequest $request): void
    {
        if (!$request->getProject() || !$this->isValidProject($request->getProject())) {
            return;
        }

        $path = $this->getProjectPath($request->getProject());
        $dir = dir($path);
        $files = [];
        while ($file = $dir->read()) {
            if (!preg_match('/\.(png|jpe?g)$/i', $file)) {
                continue;
            }

            $size = getimagesize(sprintf('%s/%s', $path, $file));
            if (!$size) {
                continue;
            }

            $files[] = (new PhotoFile())
                ->setFilename(sprintf('/photos/%s/%s', $request->getProject(), $file))
                ->setWidth($size[0])
                ->setHeight($size[1]);
        }

        $request->setFiles($files);
    }
}
