<?php declare(strict_types=1);

namespace App\Markdown;

/**
 * Sanitizer for markdown.
 *
 * @since 2026.06.24
 */
class MarkdownSanitizer
{
    /**
     * Sanitize the given content.
     *
     * @param string $content
     * @return string
     */
    public static function sanitize(string $content): string
    {
        $content = \preg_replace('/\s+/m', ' ', $content);
        $content = \preg_replace('/\[([^\]]+)\]\([^\)]+\)/m', '$1', $content);
        $content = \explode(' ', $content, 32);
        if (32 === \count($content)) {
            unset($content[31]);
        }

        return \implode(' ' , $content).' ...';
    }
}
