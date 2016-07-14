<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 02:04
 */


//Data Base constants
$config['db_sgbd']  = 'mysql';
$config['db_name']  = 'crossknowledge';
$config['db_host']  = '127.0.0.1';
$config['db_dsn']   = db_sgbd . ':dbname=' . db_name . ';host=' . db_host;
$config['db_user']  = 'homestead';
$config['db_pass']  = 'secret';


$config['default_controller'] = 'main';