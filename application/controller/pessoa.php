<?php


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
            $enderecos->setUf($pessoa['uf']);
        }

        $enderecos->save();

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
            $pessoas->setIdEndereco($enderecos->getID());
        }

        $pessoas->save();

        echo 1;
    }

    function update($args)
    {
        $pessoa = $this->getPost();

        $pessoas = $this->loadModel('Pessoas');

//        ID
        if (isset($pessoa['id']) && $pessoa['id'] != '' && is_numeric($pessoa['id'])) {
            $pessoas->setID($pessoa['id']);
        } else{
            echo json_encode(array('erro'=>true, 'msg'=>'Não foi selecionada uma pessoa para editar'));
        }
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
            $enderecos->setUf($pessoa['uf']);
        }


        $idEndereco = $pessoas->getIdEndereco();

        echo json_encode($idEndereco);
        if (!is_null($idEndereco)) {
            $enderecos->setId($idEndereco);
            $enderecos->update();
        } else {
            $enderecos->save();
            if (!is_null($enderecos->getID())) {
                $pessoas->setIdEndereco($enderecos->getID());
            }
        }
        $pessoas->update();
        echo json_encode($enderecos->getEndereco());




    }

    function delete($args){
        $pessoa = $this->getPost();

        //        ID
        if (isset($pessoa['id']) && $pessoa['id'] != '' && is_numeric($pessoa['id'])) {
            $pessoas = $this->loadModel('Pessoas');
            $pessoas->setID($pessoa['id']);
            $idEndereco = $pessoas->getIdEndereco();
            $pessoas->delete();
            $enderecos = $this->loadModel('Endereco');
            $enderecos->setId($idEndereco);
            $enderecos->delete();
        } else{
            echo json_encode(array('erro'=>true, 'msg'=>'Não foi selecionado um usuário'));
        }
    }

}