<?php declare(strict_types=1);

namespace App\Entity;

use App\Validator as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Request data to read photo files from a project.
 *
 * @since 2022.03.11
 */
class PhotosListRequest
{
    /**
     * All files from the project.
     *
     * @var PhotoFile[]
     */
    private array $files = [];

    /**
     * Project name.
     */
    #[Assert\NotBlank]
    #[AppAssert\ValidPhotoProject]
    private ?string $project = null;

    /**
     * Returns all files from the project.
     *
     * @return PhotoFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Returns the project name.
     *
     * @return string|null
     */
    public function getProject(): ?string
    {
        return $this->project;
    }

    /**
     * Set all files from the project.
     *
     * @param PhotoFile[] $files
     * @return self
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Set the project name.
     *
     * @param string|null $project
     * @return self
     */
    public function setProject(?string $project): self
    {
        $this->project = $project;

        return $this;
    }
}
