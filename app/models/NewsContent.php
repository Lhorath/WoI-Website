<?php
declare(strict_types=1);

final class NewsContent
{
    private const ALLOWED_ELEMENTS = [
        'a', 'b', 'blockquote', 'br', 'code', 'em', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'hr', 'i', 'li', 'ol', 'p', 'pre', 's', 'strong', 'table', 'tbody', 'td', 'th',
        'thead', 'tfoot', 'tr', 'u', 'ul',
    ];

    private const DROP_CONTENT_ELEMENTS = [
        'embed', 'iframe', 'math', 'noscript', 'object', 'script', 'style', 'svg', 'template',
    ];

    public static function render(string $content): string
    {
        if (preg_match('/<\/?[a-z][a-z0-9]*(?:\s[^>]*)?\s*\/?>/i', $content) !== 1) {
            return nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'), false);
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previousErrorMode = libxml_use_internal_errors(true);
        try {
            $loaded = $document->loadHTML(
                '<?xml encoding="UTF-8"><div id="news-body">' . $content . '</div>',
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
            );
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorMode);
        }

        if (!$loaded) {
            throw new RuntimeException('News article content could not be parsed.');
        }

        $container = $document->getElementById('news-body');
        if (!$container instanceof DOMElement) {
            throw new RuntimeException('News article content container was not found.');
        }

        self::sanitizeChildren($container);

        $html = '';
        foreach ($container->childNodes as $child) {
            $html .= $document->saveHTML($child);
        }

        return $html;
    }

    private static function sanitizeChildren(DOMNode $parent): void
    {
        $children = [];
        foreach ($parent->childNodes as $child) {
            $children[] = $child;
        }

        foreach ($children as $child) {
            if ($child instanceof DOMComment || $child instanceof DOMProcessingInstruction) {
                $parent->removeChild($child);
                continue;
            }

            if (!$child instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($child->tagName);
            if (in_array($tag, self::DROP_CONTENT_ELEMENTS, true)) {
                $parent->removeChild($child);
                continue;
            }

            self::sanitizeChildren($child);
            if (!in_array($tag, self::ALLOWED_ELEMENTS, true)) {
                while ($child->firstChild !== null) {
                    $parent->insertBefore($child->firstChild, $child);
                }
                $parent->removeChild($child);
                continue;
            }

            $href = $tag === 'a' ? trim($child->getAttribute('href')) : '';
            while ($child->attributes->length > 0) {
                $child->removeAttributeNode($child->attributes->item(0));
            }

            if ($tag === 'a' && self::isSafeLink($href)) {
                $child->setAttribute('href', $href);
            }
        }
    }

    private static function isSafeLink(string $href): bool
    {
        if ($href === '') {
            return false;
        }

        $parts = parse_url($href);
        if ($parts === false) {
            return false;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));
        return $scheme === '' || in_array($scheme, ['http', 'https', 'mailto'], true);
    }
}
