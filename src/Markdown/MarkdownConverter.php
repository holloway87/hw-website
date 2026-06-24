<?php declare(strict_types=1);

namespace App\Markdown;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\MarkdownConverter as LeagueMarkdownConverter;
use League\CommonMark\Node\Block\Paragraph;

/**
 * Markdown convert with all needed extensions and renderers.
 *
 * @since 2026.06.24
 */
class MarkdownConverter extends LeagueMarkdownConverter
{
    /**
     * Create the environment with all extensions and renderers.
     */
    public function __construct()
    {
        $environment = (new Environment())
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new AutolinkExtension())
            ->addRenderer(FencedCode::class, new FencedCodeRenderer())
            ->addRenderer(Heading::class, new HeadingRenderer())
            ->addRenderer(Link::class, new LinkRenderer())
            ->addRenderer(Paragraph::class, new ParagraphRenderer());

        parent::__construct($environment);
    }
}
