<?php
/**
 * Shared MVC page composition.
 * Controllers provide page metadata and the content view.
 */
use WoI\Core\View;

View::render('layouts/header', array(
    'extra_info' => isset($extra_info) ? $extra_info : ''
));
View::render('layouts/navbar', array(
    'active_page' => isset($active_page) ? $active_page : ''
));
View::render('layouts/title-bar', array(
    'title_text' => isset($title_text) ? $title_text : '',
    'title_type' => isset($title_type) ? $title_type : ''
));

if (!empty($content_view)) {
    View::render($content_view, isset($content_data) && is_array($content_data) ? $content_data : array());
}

View::render('layouts/footer');
