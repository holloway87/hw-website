<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Open Graph data.
 *
 * @since 2026.06.24
 */
class OpenGraphData
{
    /**
     * Date when the article was published.
     */
    public ?\DateTime $article_published_time = null;

    /**
     * Short description.
     */
    public string $description = '';

    /**
     * Locale from the content.
     */
    public string $locale = '';

    /**
     * Name of the site.
     */
    public string $site_name = '';

    /**
     * Title.
     */
    public string $title = '';

    /**
     * Type of the data.
     */
    public string $type = '';

    /**
     * URL for the data.
     */
    public string $url = '';
}
