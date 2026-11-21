<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/HomePage.php';
require_once __DIR__ . '/../models/NewsPost.php';
require_once __DIR__ . '/../models/NewsContent.php';
require_once __DIR__ . '/../models/RealmStatus.php';
require_once __DIR__ . '/../config/Database.php';

final class HomeController
{
    public function index(): void
    {
        $page = (new HomePage())->content();
        $newsError = !Environment::load(dirname(__DIR__, 2) . '/.env');
        $realmStatus = (new RealmStatus())->current();
        $page['updates'] = [];

        if (!$newsError) {
            try {
                $news = new NewsPost(Database::connect('WEB'), Database::connect('AUTH'));
                $page['updates'] = $news->latest(3);
            } catch (PDOException | RuntimeException $exception) {
                error_log('Homepage news query failed: ' . $exception->getMessage());
                $newsError = true;
            }
        }

        require __DIR__ . '/../views/home.php';
    }
}
