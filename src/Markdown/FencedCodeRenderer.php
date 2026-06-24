<?php declare(strict_types=1);

namespace App\Markdown;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;

/**
 * Renderer for fenced code block.
 *
 * @since 2026.06.24
 */
class FencedCodeRenderer implements NodeRendererInterface
{
    /**
     * Render the node.
     *
     * @param FencedCode $node
     * @param ChildNodeRendererInterface $childRenderer
     * @return \Stringable
     */
    public function render(
        Node $node,
        ChildNodeRendererInterface $childRenderer,
    ): \Stringable {
        FencedCode::assertInstanceOf($node);

        return new HtmlElement(
            'pre',
            ['class' => 'mb-4 px-2 py-1.5 border-2 rounded-md border-dashed border-white/50 overflow-x-scroll contain-inline-size'],
            new HtmlElement(
                'code',
                ['data-language' => \implode(' ', $node->getInfoWords())],
                Xml::escape($node->getLiteral()),
            ),
        );
    }
}
