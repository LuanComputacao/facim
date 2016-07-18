<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:32
 */
class Model
{

    protected $connection;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        global $config;
        $this->connection = new PDO($config['db_dsn'], $config['db_user'], $config['db_pass']) or die('MySQL connection problem');
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
