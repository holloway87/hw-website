<?php declare(strict_types=1);

namespace App\Entity;

/**
 * A list of media directories and files.
 *
 * @since 2024.03.12
 */
class MediaList
{
    /**
     * Directories.
     *
     * @var MediaDirectory[]
     */
    private array $directories = [];

    /**
     * Files.
     *
     * @var MediaFile[]
     */
    private array $files = [];

    /**
     * Return all directories.
     *
     * @return MediaDirectory[]
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }

    /**
     * Return all files.
     *
     * @return MediaFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Set all directories.
     *
     * @param MediaDirectory[] $directories
     * @return self
     */
    public function setDirectories(array $directories): self
    {
        $this->directories = $directories;

        return $this;
    }

    /**
     * Set all files.
     *
     * @param MediaFile[] $files
     * @return self
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;

        return $this;
    }
}
