<?php
/** Implementação do controle de rota pessoa */

namespace Facim\application\controller;
/**
 * Classe Pessoa
 *
 * Funções para administração do modelo pessoa, via rest
 *
 * @package Facim\application\controller
 */
class Pessoa extends Controller
{

	/**
	 * Função principal
	 *
	 * Retorna uma lista de poessoas para a view
	 */
	function index()
	{
		$pessoas = $this->loadModel('Pessoas');
		echo json_encode($pessoas->getPessoas());
	}

	/**
	 * Captura os parâmetros enviados por post e cria uma pessoa
	 *
	 * A partir dos dados fornecidos, salva um endereço na tabela Endereços, captura o seu ID e cria um registro na
	 * tabela pessoas com umma chave estrangeira __apontando__ para o endereço.
	 */
	function create()
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
			echo json_encode(array('erro' => true, 'msg' => 'A pessoa deve ter um nome'));
			die();
		}

//        Sobrenome
		if (isset($pessoa['sobrenome']) && $pessoa['sobrenome'] != '') {
			$pessoas->setSobrenome($pessoa['sobrenome']);
		} else {
			echo json_encode(array('erro' => true, 'msg' => 'A pessoa deve ter um sobrenome'));
			die();
		}

//        FK Endereço
		if (!is_null($enderecos->getID())) {
			$pessoas->setIdEndereco($enderecos->getID());
		}

		$pessoas->save();

		echo 1;
	}

	/**
	 * Captura os parâmetros enviados por post e cria uma pessoa
	 *
	 * A partir dos dados fornecidos, atualiza o registro de pessoa e a partir da chave estrangeira, atualiza o
	 * registro de endereço desta pessoa
	 */
	function update()
	{
		$pessoa = $this->getPost();

		$pessoas = $this->loadModel('Pessoas');

//        ID
		if (isset($pessoa['id']) && $pessoa['id'] != '' && is_numeric($pessoa['id'])) {
			$pessoas->setID($pessoa['id']);
		} else {
			echo json_encode(array('erro' => true, 'msg' => 'Não foi selecionada uma pessoa para editar'));
		}
//        Nome
		if (isset($pessoa['nome']) && $pessoa['nome'] != '') {
			$pessoas->setNome($pessoa['nome']);
		} else {
			echo json_encode(array('erro' => true, 'msg' => 'A pessoa deve ter um nome'));
			die();
		}

//        Sobrenome
		if (isset($pessoa['sobrenome']) && $pessoa['sobrenome'] != '') {
			$pessoas->setSobrenome($pessoa['sobrenome']);
		} else {
			echo json_encode(array('erro' => true, 'msg' => 'A pessoa deve ter um sobrenome'));
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

	/**
	 * Deleta um registro de pessoa do banco, conforme o ID fornecido
	 */
	function delete()
	{
		//@TODO::realizar validações para não deletar registros que não venham de fonte segura
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
		} else {
			echo json_encode(array('erro' => true, 'msg' => 'Não foi selecionado um usuário'));
		}
	}

}