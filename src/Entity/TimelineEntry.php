<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Data from a timeline entry.
 *
 * @since 2024.02.20
 */
class TimelineEntry
{
    /**
     * Content.
     */
    private ?string $content = null;

    /**
     * Date.
     */
    private ?\DateTime $date = null;

    /**
     * Timeline ID.
     */
    private ?string $id = null;

    /**
     * Images.
     *
     * @var TimelineEntryImage[]
     */
    private array $images = [];

    /**
     * Title.
     */
    private ?string $title = null;

    /**
     * Return the content.
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Return the date.
     *
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Return the timeline ID.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Return all images.
     *
     * @return TimelineEntryImage[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * Return the title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the content.
     *
     * @param string|null $content
     * @return self
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the date.
     *
     * @param \DateTime|null $date
     * @return self
     */
    public function setDate(?\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set the timeline ID.
     *
     * @param string|null $id
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set all images.
     *
     * @param TimelineEntryImage[] $images
     * @return self
     */
    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Set the title.
     *
     * @param string|null $title
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
