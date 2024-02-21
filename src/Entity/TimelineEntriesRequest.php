<?php declare(strict_types=1);

namespace App\Entity;

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
     * Maximum amount of entries to retrieve.
     */
    private int $limit = 0;

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
     * Return the maximum amount of entries to retrieve.
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
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
     * Set the maximum amount of entries to retrieve.
     *
     * @param int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
