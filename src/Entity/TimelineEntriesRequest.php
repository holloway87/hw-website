<?php declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Request data to retrieve timeline entries.
 *
 * @since 2024.02.20
 */
class TimelineEntriesRequest
{
    /**
     * Retrieved entries.
     *
     * @var TimelineEntry[]
     */
    private array $entries = [];

    /**
     * Timeline ID.
     */
    #[Assert\Regex(pattern: '/^\d{8}-\d{4}$/', message: 'Enter a valid timeline id.')]
    private ?string $id = null;

    /**
     * If empty entries will be included.
     */
    private bool $includeEmpty = false;

    /**
     * Maximum amount of entries to retrieve.
     */
    #[Assert\PositiveOrZero(message: 'Enter a valid positive limit.')]
    private ?int $limit = 0;

    /**
     * Return all retrieved entries.
     *
     * @return TimelineEntry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Return a timeline ID.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Return the maximum amount of entries to retrieve.
     *
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Returns if empty entries will be included.
     *
     * @return bool
     */
    public function isIncludeEmpty(): bool
    {
        return $this->includeEmpty;
    }

    /**
     * Set the retrieved entries.
     *
     * @param TimelineEntry[] $entries
     * @return self
     */
    public function setEntries(array $entries): self
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * Set a timeline ID.
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
     * Set if empty entries will be included.
     *
     * @param bool $includeEmpty
     * @return self
     */
    public function setIncludeEmpty(bool $includeEmpty): self
    {
        $this->includeEmpty = $includeEmpty;

        return $this;
    }

    /**
     * Set the maximum amount of entries to retrieve.
     *
     * @param int|null $limit
     * @return self
     */
    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
