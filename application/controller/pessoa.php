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

        $enderecos = $this->loadModel('Endereco');

        if (isset($pessoa['rua']) && $pessoa['rua'] != '') {
            $enderecos->setRua($pessoa['rua']);
        }
        if (isset($pessoa['numero']) && $pessoa['numero'] != '') {
            $enderecos->setNumero($pessoa['numero']);
        }
        if (isset($pessoa['bairro']) && $pessoa['bairro'] != '') {
            $enderecos->setBairro($pessoa['bairro']);
        }
        if (isset($pessoa['cidade']) && $pessoa['cidade'] != '') {
            $enderecos->setCidade($pessoa['cidade']);
        }

        if (isset($pessoa['uf']) && $pessoa['uf'] != '') {
            $enderecos->setCidade($pessoa['uf']);
        }

        $enderecos->save();

        echo json_encode($enderecos->getEndereco());

        $pessoas = $this->loadModel('Pessoas');

//        Nome
        if (isset($pessoa['nome']) && $pessoa['nome'] != '') {
            $pessoas->setNome($pessoa['nome']);
        } else {
            echo json_encode(array('erro'=>true, 'msg'=>'A pessoa deve ter um nome'));
            die();
        }

//        Sobrenome
        if (isset($pessoa['sobrenome']) && $pessoa['sobrenome'] != '') {
            $pessoas->setSobrenome($pessoa['sobrenome']);
        } else {
            echo json_encode(array('erro'=>true, 'msg'=>'A pessoa deve ter um sobrenome'));
            die();
        }

//        FK Endereço
        if (!is_null($enderecos->getID())) {
            $pessoas->setEndereco($enderecos->getID());
        }

        $pessoas->save();

        echo 1;
    }
}