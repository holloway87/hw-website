<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Data about a photo file.
 *
 * @since 2022.03.11
 */
class PhotoFile
{
    /**
     * Filename.
     */
    private ?string $filename = null;

    /**
     * Height.
     */
    private ?int $height = null;

    /**
     * Width.
     */
    private ?int $width = null;

    /**
     * Returns the filename.
     *
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * Returns the height.
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Returns the width.
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * Set the filename.
     *
     * @param string|null $filename
     * @return self
     */
    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Set the height.
     *
     * @param int|null $height
     * @return self
     */
    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set the width.
     *
     * @param int|null $width
     * @return self
     */
    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }
}
