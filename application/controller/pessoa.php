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
        $pessoa = $this->getPost();

        $pessoas = $this->loadModel('Pessoas');
        if (isset($pessoa['nome']) && $pessoa['nome'] != '') {
            $pessoas->setNome($pessoa['nome']);
        } else {
            echo 'A pessoa deve ter um nome';
            die();
        }
        if (isset($pessoa['sobrenome']) && $pessoa['sobrenome'] != '') {
            $pessoas->setSobrenome($pessoa['sobrenome']);
        } else {
            echo 'A pessoa deve ter um sobrenome';
            die();
        }
        if (isset($pessoa['rua'])       && $pessoa['rua'] != '')       $pessoas->setId($pessoa['rua']);
        if (isset($pessoa['numero'])    && $pessoa['numero'] != '')    $pessoas->setId($pessoa['numero']);
        if (isset($pessoa['bairro'])    && $pessoa['bairro'] != '')    $pessoas->setId($pessoa['bairro']);
        if (isset($pessoa['cidade'])    && $pessoa['cidade'] != '')    $pessoas->setId($pessoa['cidade']);

        $pessoas->save();
        echo '1';
    }
}