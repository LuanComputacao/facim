<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:32
 */
class Model
{

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $dbh = new PDO($database['dataSourceName'], $database['user'], $database['password']);
    }
}