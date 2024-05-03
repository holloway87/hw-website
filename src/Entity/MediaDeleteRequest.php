<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Data for media delete request.
 *
 * @since 2024.05.03
 */
class MediaDeleteRequest
{
    /**
     * Files to delete.
     *
     * @var string[]
     */
    private array $files = [];

    /**
     * Return all files to delete.
     *
     * @return string[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Set all files to delete.
     *
     * @param string[] $files
     * @return self
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;

        return $this;
    }
}
