<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 13/07/16
 * Time: 10:34
 */


$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

var_dump(trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '', $request_url, 1), '/'));
var_dump($script_url);
