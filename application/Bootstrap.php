<?php



$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

if (($request_url != $script_url)) {
    $url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '', $request_url, 1), '/');
} else {
    $url = '';
}
$path = trim(parse_url($_SERVER['REQUEST_URI'])['path'] , '/');
$segments = explode('/', $path);

$controller = (isset($segments[0]) && $segments[0] != '') ? $segments[0] : $config['default_controller'];
$action = (isset($segments[1]) && $segments[1] != '') ? $segments[1] : $config['default_action'];

$controllerFile = APP_DIR . '/controller/' . $controller . '.php';

//Verify controller file
if (file_exists($controllerFile)) {
    require_once($controllerFile);
} else {
    $controller = $config['default_error'];
    $action = $config['default_action'];
    require_once(APP_DIR . '/controller/' . $config['default_error'] . '.php');
}

$oController = new $controller;
call_user_func_array(array($oController, $action), array(array_slice($segments, 2)));