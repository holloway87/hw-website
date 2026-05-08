<?php declare(strict_types=1);

namespace App\Entity;

/**
 * A blog entry with all it's data.
 *
 * @since 2026.01.08
 */
class BlogEntry
{
    public string $content = '';
    public \DateTime|null $created = null;
    public string $slug = '';
    public string $title = '';
}
