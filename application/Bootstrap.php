<?php
namespace Facim\system;
use Facim\application\controller;

/**
 * Realiza a validação das rotas
 *
 * Verifica se a rota de controle e a ação de controle são existentes na aplicação.
 * Caso a o controle e/ou ação não sejam encontrados, retorna a pagina de erro padrão da aplicação
 *
 * *Página de erro configurada em _application/config/config.php_
 */


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
    require_once('/controller/' . $config['default_error'] . '.php');
}

$controller = 'Facim\application\controller\\' . $controller;
$oController = new $controller;
call_user_func_array(array($oController, $action), array(array_slice($segments, 2)));