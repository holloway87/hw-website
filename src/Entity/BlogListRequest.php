<?php declare(strict_types=1);

namespace App\Entity;

/**
 * A request to list blog entries.
 *
 * After the process the result is in the `$entries` property.
 *
 * @since 2026.01.08
 */
class BlogListRequest
{
    /**
     * Number of maximum entries to retrieve.
     */
    public int $limit = 0;

    /**
     * @var BlogEntry[]
     */
    public array $entries = [];

    /**
     * Search for a specific entry.
     */
    public string $slug = '';
}
