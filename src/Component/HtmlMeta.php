<?php declare(strict_types=1);

namespace App\Component;

use App\Entity\OpenGraphData;

/**
 * Properties for HTML meta data.
 *
 * @since 2026.06.24
 */
class HtmlMeta
{
    /**
     * The back url for various points on the page.
     */
    public string $back_url = '';

    /**
     * Data for Open Graph Protocol.
     */
    public ?OpenGraphData $open_graph = null;

    /**
     * The page title.
     */
    public string $title = '';
}
