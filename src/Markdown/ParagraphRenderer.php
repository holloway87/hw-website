<?php declare(strict_types=1);

namespace App\Markdown;

use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

/**
 * Renderer for a paragraph.
 *
 * @since 2026.06.24
 */
class ParagraphRenderer implements NodeRendererInterface
{
    /**
     * Render the node.
     *
     * @param Paragraph $node
     * @param ChildNodeRendererInterface $childRenderer
     * @return \Stringable
     */
    public function render(
        Node $node,
        ChildNodeRendererInterface $childRenderer,
    ): \Stringable {
        Paragraph::assertInstanceOf($node);

        return new HtmlElement(
            'p',
            ['class' => 'mb-4'],
            $childRenderer->renderNodes($node->children()),
        );
    }
}
