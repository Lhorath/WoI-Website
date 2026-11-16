<?php
namespace WoI\Controllers;

use WoI\Core\View;

class HomeController extends LegacyController
{
    public function index()
    {
        require_once APP_PATH . '/Legacy/bootstrap.php';

        $config = isset($GLOBALS['config']) ? $GLOBALS['config'] : array();

        $extra = "<script type='text/javascript'>
            var flashvars = {};
            flashvars.xml = '".$config['swf_dir']."config.xml';
            flashvars.font = '".$config['swf_dir']."font.swf';
            var attributes = {};
            attributes.wmode = 'transparent';
            attributes.id = 'slider';
            swfobject.embedSWF('".$config['swf_dir']."cu3er.swf', 'cu3er-container', '960', '400', '9', '".$config['swf_dir']."expressInstall.swf', flashvars, attributes);
        </script>";

        View::render('layouts/page', array(
            'config' => $config,
            'extra_info' => $extra,
            'active_page' => 'index',
            'title_type' => 'front_page',
            'content_view' => 'home/index',
            'content_data' => array('config' => $config)
        ));
    }
}
