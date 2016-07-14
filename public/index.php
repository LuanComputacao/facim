<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 13/07/16
 * Time: 10:04
 */

var_dump(realpath(dirname(__DIR__)));

$database = [
    'dataSourceName' => 'mysql:dbname=homestead;host=127.0.0.1',
    'user' => 'homestead',
    'password' => 'secret'
];

try {
    $dbh = new PDO($database['dataSourceName'], $database['user'], $database['password']);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
