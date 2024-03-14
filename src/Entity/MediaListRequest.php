<?php declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data for media list request.
 *
 * @since 2024.03.12
 */
class MediaListRequest
{
    /**
     * All directories and files for the path.
     */
    private ?MediaList $files = null;

    /**
     * Path.
     */
    #[Assert\Regex('/^(\/[a-z0-9-_]+)*$/')]
    private ?string $path = null;

    /**
     * Return all directories and files.
     *
     * @return MediaList|null
     */
    public function getFiles(): ?MediaList
    {
        return $this->files;
    }

    /**
     * Return the path.
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set all directories and files.
     *
     * @param MediaList $files
     * @return self
     */
    public function setFiles(MediaList $files): self
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Set the path.
     *
     * @param string|null $path
     * @return self
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
