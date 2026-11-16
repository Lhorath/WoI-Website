<?php

define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/app/bootstrap.php';

$config = array(
    'root_dir' => '/',
    'img_dir' => '/utility/images/',
    'css_dir' => '/utility/css/',
    'js_dir' => '/utility/js/'
);

$expectations = array(
    'connect' => array('Connection Guide', 'realmlist worldofimmortality.servegame.org', '3.3.5a'),
    'contact' => array('30 active members of volunteer staff', 'Ingame Ticket', 'Ventrilo'),
    'faq' => array('Immortal Coins', 'Vote Points', 'common misconceptions'),
    'tos' => array('Server Rules', 'In –game Chat', 'Cross-faction Grouping', 'Donations:')
);

foreach ($expectations as $view => $needles) {
    ob_start();
    \WoI\Core\View::render('pages/' . $view, array('config' => $config));
    $html = ob_get_clean();

    foreach ($needles as $needle) {
        if (strpos($html, $needle) === false) {
            fwrite(STDERR, 'Informational view smoke test failed: ' . $view . ' missing ' . $needle . PHP_EOL);
            exit(1);
        }
    }

    if (strpos($html, 'body_resize') === false || strpos($html, 'class="right"') === false) {
        fwrite(STDERR, 'Informational view smoke test failed: ' . $view . ' layout wrapper missing.' . PHP_EOL);
        exit(1);
    }
}

echo "Informational view smoke test passed.\n";
