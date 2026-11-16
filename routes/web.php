<?php

return function ($router) {
    $router->any('/', array('WoI\\Controllers\\HomeController', 'index'));
    $router->any('/index.php', array('WoI\\Controllers\\HomeController', 'index'));

    $router->any('/about', array('WoI\\Controllers\\PageController', 'about'));
    $router->any('/connect', array('WoI\\Controllers\\PageController', 'connect'));
    $router->any('/contact', array('WoI\\Controllers\\PageController', 'contact'));
    $router->any('/faq', array('WoI\\Controllers\\PageController', 'faq'));
    $router->any('/rules', array('WoI\\Controllers\\PageController', 'rules'));
    $router->any('/tos', array('WoI\\Controllers\\PageController', 'terms'));
    $router->any('/vent', array('WoI\\Controllers\\PageController', 'vent'));

    $router->any('/register', array('WoI\\Controllers\\RegisterController', 'index'));

    $router->any('/account', array('WoI\\Controllers\\AccountController', 'index'));
    $router->any('/account/bancheck', array('WoI\\Controllers\\AccountController', 'bancheck'));
    $router->any('/account/revive', array('WoI\\Controllers\\AccountController', 'revive'));
    $router->any('/account/teleport', array('WoI\\Controllers\\AccountController', 'teleport'));
    $router->any('/account/userdetails', array('WoI\\Controllers\\AccountController', 'userdetails'));
    $router->any('/account/logout', array('WoI\\Controllers\\AccountController', 'logout'));
    $router->any('/ucp', array('WoI\\Controllers\\AccountController', 'ucp'));
    $router->any('/logout', array('WoI\\Controllers\\AccountController', 'logout'));

    $router->any('/status', array('WoI\\Controllers\\StatusController', 'index'));
    $router->any('/arena', array('WoI\\Controllers\\StatusController', 'arena'));
    $router->any('/online/{server}', array('WoI\\Controllers\\StatusController', 'online'));

    $router->any('/vote', array('WoI\\Controllers\\VoteController', 'index'));
    $router->any('/vote/rewards', array('WoI\\Controllers\\VoteController', 'rewards'));

    // Root donate.php and donate/index.php are distinct legacy pages.
    $router->any('/donate', array('WoI\\Controllers\\DonationController', 'index'));
    $router->any('/donate/terms', array('WoI\\Controllers\\DonationController', 'terms'));
    $router->any('/donate/index', array('WoI\\Controllers\\DonationController', 'terms'));
    $router->any('/donate/donate', array('WoI\\Controllers\\DonationController', 'donate'));
    $router->any('/donate/history', array('WoI\\Controllers\\DonationController', 'history'));
    $router->any('/donate/preview', array('WoI\\Controllers\\DonationController', 'preview'));
    $router->any('/donate/paypal', array('WoI\\Controllers\\DonationController', 'paypal'));
    $router->any('/donate/postback', array('WoI\\Controllers\\DonationController', 'postback'));
    $router->any('/donate/packages', array('WoI\\Controllers\\DonationController', 'packages'));
    $router->any('/agree', array('WoI\\Controllers\\DonationController', 'agree'));
    $router->any('/accepted', array('WoI\\Controllers\\DonationController', 'accepted'));
    $router->any('/cancelled', array('WoI\\Controllers\\DonationController', 'cancelled'));

    $router->any('/gm', array('WoI\\Controllers\\GMController', 'index'));
    $router->any('/gm/banchecker', array('WoI\\Controllers\\GMController', 'banchecker'));
    $router->any('/gm/donation', array('WoI\\Controllers\\GMController', 'donation'));
    $router->any('/gm/instance', array('WoI\\Controllers\\GMController', 'instance'));
    $router->any('/gm/instance/blizz-only', array('WoI\\Controllers\\GMController', 'instanceBlizzOnly'));
    $router->any('/gm/passchange', array('WoI\\Controllers\\GMController', 'passchange'));
    $router->any('/gm/promo', array('WoI\\Controllers\\GMController', 'promo'));
    $router->any('/gm/vote', array('WoI\\Controllers\\GMController', 'vote'));
};
