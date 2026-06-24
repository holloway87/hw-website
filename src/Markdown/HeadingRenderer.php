<?php declare(strict_types=1);

namespace App\Markdown;

use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

/**
 * Renderer for a heading.
 *
 * @since 2026.06.24
 */
class HeadingRenderer implements NodeRendererInterface
{
    /**
     * Render the node.
     *
     * @param Heading $node
     * @param ChildNodeRendererInterface $childRenderer
     * @return \Stringable
     */
    public function render(
        Node $node,
        ChildNodeRendererInterface $childRenderer,
    ): \Stringable {
        Heading::assertInstanceOf($node);

        return new HtmlElement(
            'h'.$node->getLevel(),
            ['class' => 'mb-4'],
            $childRenderer->renderNodes($node->children()),
        );
    }
}
