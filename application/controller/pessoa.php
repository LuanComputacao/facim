<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 19/07/16
 * Time: 23:25
 */
class Pessoa extends Controller
{
    function index()
    {
        echo json_encode($this->getPost());
    }

    function create($args)
    {

    }
}