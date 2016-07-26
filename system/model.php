<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:32
 */
class Model
{

    public $connection;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        global $config;
        $this->connection = new PDO($config['db_dsn'], $config['db_user'], $config['db_pass']) or die('MySQL connection problem');
        $this->connection->query("use ". $config['db_name']);
    }

    public function create()
    {
    }

    public function read($sqlSt)
    {
    }

    public function update()
    {
    }

    public function delete()
    {

    }
}
