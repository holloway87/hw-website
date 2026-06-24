<?php declare(strict_types=1);

namespace App\Markdown;

use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

/**
 * Renderer for a link.
 *
 * @since 2026.06.24
 */
class LinkRenderer implements NodeRendererInterface
{
    /**
     * Render the node.
     *
     * @param Link $node
     * @param ChildNodeRendererInterface $childRenderer
     * @return \Stringable
     */
    public function render(
        Node $node,
        ChildNodeRendererInterface $childRenderer,
    ): \Stringable {
        Link::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');
        $attrs['class'] = 'underline decoration-dashed underline-offset-4 hover:no-underline cursor-pointer';
        $attrs['href'] = $node->getUrl();
        $attrs['rel'] = 'nofollow';
        $attrs['target'] = '_blank';

        return new HtmlElement(
            'a',
            $attrs,
            $childRenderer->renderNodes($node->children()),
        );
    }
}
