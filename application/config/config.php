<?php
/**
 * Configurações da aplicação
 */

$config = [];

// Data Base
$config['db_sgbd']  = 'mysql';
$config['db_name']  = 'crossknowledge';
$config['db_host']  = '127.0.0.1';
$config['db_dsn']   = $config['db_sgbd'] . ':dbname=' . $config['db_name'] . ';host=' . $config['db_host'];
$config['db_user']  = 'homestead';
$config['db_pass']  = 'secret';

// MVC
$config['default_controller'] = 'home';
$config['default_error']      = 'notfound';
$config['default_action']     = 'index';

$config['title'] = 'Cadastro de pessoas fácil';