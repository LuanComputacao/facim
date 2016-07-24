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

        $pessoas = $this->loadModel('Pessoas');
        echo json_encode($pessoas->getPessoas());
    }

    function create($args)
    {

    }
}