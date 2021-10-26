<?php
DEFINE('APP_FOLDER', 'app/');
DEFINE('CONFIG_FOLDER', 'config/');
DEFINE('RESOURCES_FOLDER', 'public/');
DEFINE('CONTROLLERS_FOLDER', APP_FOLDER . '/controllers/');
DEFINE('CLASS_FOLDER', APP_FOLDER . '/class/');
DEFINE('VIEWS_FOLDER', RESOURCES_FOLDER . '/views/');
DEFINE('CSS_FOLDER', RESOURCES_FOLDER . '/css/');
DEFINE('JS_FOLDER', RESOURCES_FOLDER . '/js/');
DEFINE('ASSET_FOLDER', RESOURCES_FOLDER . '/assets/');
DEFINE('PARTIALS_SUBFOLDER', VIEWS_FOLDER . '/partials/');
DEFINE('EMAILS_SUBFOLDER', VIEWS_FOLDER . '/emails/');
DEFINE('LOGS_FOLDER', '../logs/');


require_once(CONFIG_FOLDER . 'init.php');

@session_start();

spl_autoload_register(function ($class) {
    $class = strtolower($class);
    $sources = array(CONTROLLERS_FOLDER . "/$class.php", CLASS_FOLDER . "$class.php");
    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
            break;
        }
    }
});

$controller = false;
if (isset($_GET['c']) and class_exists($_GET['c'])) {
    $controller = new $_GET['c']();
} else {
    header('HTTP/1.1 401 Unauthorized');
    die();
}

$content =  $controller->render();

if ($controller->useLayout()) {
    $h1Controller = $controller->getH1();
    $titleController = $controller->getTitle();
    $content = App::get_content(
        'layout.php',
        array(
            'title' => $titleController,
            'h1' => $h1Controller,
            'content' => $content
        )
    );
}
unset($controller);
echo $content;
// Db::getInstance()->close();