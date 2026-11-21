<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/NewsPost.php';
require_once __DIR__ . '/../models/NewsContent.php';

final class NewsController
{
    public function dispatch(): void
    {
        if (array_key_exists('id', $_GET)) {
            $this->show();
            return;
        }

        $this->index();
    }

    private function index(): void
    {
        $pageInput = $_GET['page'] ?? '1';
        $page = is_string($pageInput) || is_int($pageInput)
            ? filter_var((string) $pageInput, FILTER_VALIDATE_INT)
            : false;
        if ($page === false || $page === null || $page < 1) {
            $this->renderError('Invalid news page', 'Choose a valid page number.', 400);
            return;
        }

        try {
            $listing = $this->newsPosts()->listing($page, 10);
            $pageTitle = 'News | TrinityCore Realms';
            $contentPartial = __DIR__ . '/../views/news-list-content.php';
            $includeSliderScript = false;
            require __DIR__ . '/../views/news-list.php';
        } catch (PDOException | RuntimeException $exception) {
            error_log('News listing failed: ' . $exception->getMessage());
            $this->renderError(
                'News is temporarily unavailable',
                'We could not load the news right now. Please try again later.',
                500
            );
        }
    }

    private function show(): void
    {
        $idInput = $_GET['id'] ?? null;
        $id = is_string($idInput) || is_int($idInput)
            ? filter_var((string) $idInput, FILTER_VALIDATE_INT)
            : false;
        if ($id === false || $id === null || $id < 1) {
            $this->renderError('News article not found', 'That article does not exist.', 404);
            return;
        }

        try {
            $post = $this->newsPosts()->find($id);
            if ($post === null) {
                $this->renderError('News article not found', 'That article does not exist.', 404);
                return;
            }

            $articleHtml = NewsContent::render((string) ($post['body'] ?? ''));
            $pageTitle = $post['title'] . ' | News';
            $contentPartial = __DIR__ . '/../views/news-article-content.php';
            $includeSliderScript = false;
            require __DIR__ . '/../views/news-article.php';
        } catch (PDOException | RuntimeException $exception) {
            error_log('News article request failed: ' . $exception->getMessage());
            $this->renderError(
                'News is temporarily unavailable',
                'We could not load this article right now. Please try again later.',
                500
            );
        }
    }

    private function newsPosts(): NewsPost
    {
        if (!Environment::load(dirname(__DIR__, 2) . '/.env')) {
            throw new RuntimeException('Environment configuration could not be loaded.');
        }

        return new NewsPost(Database::connect('WEB'), Database::connect('AUTH'));
    }

    private function renderError(string $heading, string $message, int $status): void
    {
        http_response_code($status);
        $pageTitle = $heading . ' | TrinityCore Realms';
        $errorHeading = $heading;
        $errorMessage = $message;
        $contentPartial = __DIR__ . '/../views/news-error-content.php';
        $includeSliderScript = false;
        require __DIR__ . '/../views/news-error.php';
    }
}
