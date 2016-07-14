<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 02:04
 */


define('db_host', '127.0.0.1');
define('db_sgbd', 'mysql');
define('db_user', 'homestead');
define('db_pass', 'secret');
define('db_name', 'crossknowledge');

define('db_dsn', db_sgbd . ':dbname=' . db_name . ';host=' . db_host);