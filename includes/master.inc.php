<?php
// Session
//session_set_cookie_params(900); // 15 minutes
session_start();

// Timezone
date_default_timezone_set('Europe/Paris');

// Constantes
require 'conf.php';

// Inclusions de fichiers
require DOC_ROOT . '/includes/functions.inc.php';
require DOC_ROOT . '/includes/Smarty-3.1.13/Smarty.class.php';
require DOC_ROOT . '/includes/php-activerecord/ActiveRecord.php';
require DOC_ROOT . '/includes/mail.class.php';
require DOC_ROOT . '/includes/auth.class.php';
require DOC_ROOT . '/includes/db.conf.php';

// Smarty
$tpl = new Smarty();
$tpl->template_dir = DOC_ROOT . '/templates/';
$tpl->compile_dir = DOC_ROOT . '/templates_c/';
$tpl->config_dir = DOC_ROOT . '/langues/';
$tpl->cache_dir = DOC_ROOT . '/cache/';
//if (ENVIRONMENT != 'development') $tpl->caching = 1;
$tpl->caching = false;
$tpl->force_compile = true;
$tpl->assign('baseurl', BASEURL);

// Auth
$Auth = new Auth();

// Is Logged In
$tpl->assign('isLoggedIn', $Auth->isLoggedIn());