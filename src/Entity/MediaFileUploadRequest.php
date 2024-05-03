<?php declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data for a media file upload request.
 *
 * @since 2024.03.14
 */
class MediaFileUploadRequest
{
    /**
     * Uploaded media file.
     */
    #[Assert\Image]
    private ?UploadedFile $file = null;

    /**
     * Path to save the file into.
     */
    #[Assert\Regex('/^(\/[a-z0-9-_]+)*$/')]
    private ?string $path = null;

    /**
     * Return the uploaded media file.
     *
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * Return the path the file will be uploaded to.
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the uploaded file.
     *
     * @param UploadedFile|null $file
     * @return self
     */
    public function setFile(?UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set the path the uploaded file will be saved into.
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
