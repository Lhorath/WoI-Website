<?php
declare(strict_types=1);

require_once __DIR__ . '/NewsContent.php';

final class NewsPost
{
    private const ICON_EXTENSIONS = ['svg', 'png', 'webp', 'jpg', 'jpeg', 'gif'];

    public function __construct(
        private PDO $websiteDatabase,
        private PDO $authDatabase
    ) {
    }

    public function latest(int $limit): array
    {
        if ($limit < 1 || $limit > 50) {
            throw new InvalidArgumentException('News post limit must be between 1 and 50.');
        }

        $statement = $this->websiteDatabase->prepare(
            'SELECT id, poster_id, date_posted, icon, title, body
             FROM news_posts
             ORDER BY id DESC
             LIMIT :limit'
        );
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $this->addDisplayData($statement->fetchAll());
    }

    public function listing(int $page, int $perPage): array
    {
        if ($page < 1 || $perPage < 1 || $perPage > 50) {
            throw new InvalidArgumentException('News page and page size must be positive.');
        }

        $total = (int) $this->websiteDatabase
            ->query('SELECT COUNT(*) FROM news_posts')
            ->fetchColumn();
        $pageCount = max(1, (int) ceil($total / $perPage));
        $page = min($page, $pageCount);
        $offset = ($page - 1) * $perPage;

        $statement = $this->websiteDatabase->prepare(
            'SELECT id, poster_id, date_posted, icon, title, body
             FROM news_posts
             ORDER BY date_posted DESC, id DESC
             LIMIT :limit OFFSET :offset'
        );
        $statement->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        return [
            'posts' => $this->addDisplayData($statement->fetchAll()),
            'page' => $page,
            'pageCount' => $pageCount,
            'total' => $total,
        ];
    }

    public function find(int $id): ?array
    {
        if ($id < 1) {
            return null;
        }

        $statement = $this->websiteDatabase->prepare(
            'SELECT id, poster_id, date_posted, icon, title, body
             FROM news_posts
             WHERE id = :id
             LIMIT 1'
        );
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $post = $statement->fetch();

        if ($post === false) {
            return null;
        }

        return $this->addDisplayData([$post])[0];
    }

    private function addDisplayData(array $posts): array
    {
        if ($posts === []) {
            return [];
        }

        $posterIds = array_values(array_unique(array_map(
            static fn(array $post): int => (int) $post['poster_id'],
            $posts
        )));
        $placeholders = implode(',', array_fill(0, count($posterIds), '?'));
        $statement = $this->authDatabase->prepare(
            'SELECT id, username FROM account WHERE id IN (' . $placeholders . ')'
        );
        foreach ($posterIds as $index => $posterId) {
            $statement->bindValue($index + 1, $posterId, PDO::PARAM_INT);
        }
        $statement->execute();

        $authors = [];
        foreach ($statement->fetchAll() as $account) {
            $authors[(int) $account['id']] = (string) $account['username'];
        }

        foreach ($posts as &$post) {
            $id = (int) $post['id'];
            $posterId = (int) $post['poster_id'];
            $body = (string) $post['body'];
            $title = trim((string) ($post['title'] ?? ''));
            $post['id'] = $id;
            $post['poster_id'] = $posterId;
            $post['title'] = $title === '' ? 'News #' . $id : $title;
            $excerpt = preg_replace('/\s+/u', ' ', self::plainText($body)) ?? '';
            $post['excerpt'] = self::truncate($excerpt, 220);
            try {
                $post['body_html'] = NewsContent::render($body);
            } catch (RuntimeException) {
                $post['body_html'] = nl2br(htmlspecialchars($body, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'), false);
            }
            $post['author_name'] = $authors[$posterId] ?? 'Account #' . $posterId;
            $post['date_label'] = date('F j, Y', (int) $post['date_posted']);
            $post['icon_path'] = self::iconPath((string) ($post['icon'] ?? ''));
        }
        unset($post);

        return $posts;
    }

    private static function plainText(string $body): string
    {
        $separated = preg_replace(
            '/<(?:br|hr)\b[^>]*>|<\/(?:blockquote|div|h[1-6]|li|ol|p|pre|section|table|td|th|tr|ul)\s*>/i',
            ' ',
            $body
        );
        $text = html_entity_decode(
            strip_tags($separated ?? $body),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );
        $text = preg_replace('/[ \t]+/u', ' ', $text) ?? '';
        $text = preg_replace('/ *\R */u', "\n", $text) ?? '';
        return trim($text);
    }

    private static function truncate(string $text, int $limit): string
    {
        $matches = [];
        if (preg_match('/^.{0,' . $limit . '}/us', $text, $matches) !== 1) {
            return substr($text, 0, $limit);
        }

        $truncated = $matches[0];
        if ($truncated === $text) {
            return $text;
        }

        $lastSpace = strrpos($truncated, ' ');
        if ($lastSpace !== false && $lastSpace > (int) ($limit * 0.6)) {
            $truncated = substr($truncated, 0, $lastSpace);
        }

        return rtrim($truncated) . '...';
    }

    private static function iconPath(string $icon): ?string
    {
        if (!preg_match('/\A[A-Za-z0-9_-]+\z/', $icon)) {
            return null;
        }

        $assetRoot = dirname(__DIR__, 2) . '/assets/';
        foreach (['icons/', 'images/icons/'] as $directory) {
            foreach (self::ICON_EXTENSIONS as $extension) {
                if (is_file($assetRoot . $directory . $icon . '.' . $extension)) {
                    return 'assets/' . $directory . $icon . '.' . $extension;
                }
            }
        }

        return null;
    }
}
