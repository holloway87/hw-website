<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Data for a timeline entry image.
 *
 * @since 2024.02.20
 */
class TimelineEntryImage
{
    /**
     * Height.
     */
    private ?int $height = null;

    /**
     * Mime type for the image.
     */
    private ?string $mimeType = null;

    /**
     * URL.
     */
    private ?string $url = null;

    /**
     * Width.
     */
    private ?int $width = null;

    /**
     * Return the height.
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Return the mime type for the image.
     *
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Return the URL.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Return the width.
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
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
     * Set the mime type for the image.
     *
     * @param string|null $mimeType
     * @return self
     */
    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Set the URL.
     *
     * @param string|null $url
     * @return self
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

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
