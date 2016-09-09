<?php
/**
 * Funções para administração da tabela Pessoas
 */

namespace Facim\application\model;
use PDO;

/**
 * Classe Model Pessoas
 *
 * Classe para administrar o modelo __pessoas__. Representa _exatamente a tabela_ do banco de dados.
 *
 * @package Facim\application\model
 */
class Pessoas extends Model
{
	/** @var null|integer 	$id 			ID do registro da pessoa */
	/** @var string 		$nome 			Nome da pessoa*/
	/** @var string  		$sobrenome 		Sobrenome*/
	/** @var integer 		$idEndereco 	Chave estrangeira da tabela de endereços*/
	private $id, $nome, $sobrenome, $idEndereco = null;


    /**
	 * Atribui um ID
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
	 * Atribui nome
     * @param null $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
	 * Atribui sobrenome
     * @param null $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
	 * Atribui uma chave de endereço
     * @param null $idEndereco
     */
    public function setIdEndereco($idEndereco)
    {
        $this->idEndereco = $idEndereco;
    }

    /**
	 * Retorna o ID do endereço.
	 *
	 * Caso o ID esteja vazio, busca o ID do endereço desta pessoa no banco de dados e atribui
	 * para então retornar.
	 *
     * @return null|string ID do Endereço
     */
    public function getIdEndereco()
    {
        if (is_null($this->idEndereco)) {
            if (!is_null($this->id)) {
                $prepStm = $this->connection->query("SELECT fk_enderecos FROM pessoas WHERE id = $this->id");
                $id = $prepStm->fetch(PDO::FETCH_ASSOC);
                if (!is_null($id['fk_enderecos'])) {
                    $this->idEndereco = $id['fk_enderecos'];
                } else {
                    $this->idEndereco = null;
                }
            }
        }
        return $this->idEndereco;

    }

	/**
	 * Retorna todos os dados da pessoa
	 *
	 * @return array[id, nome, sobrenome, endereco]
	 */
    public function getPessoa()
    {
        return array(
            'id'        => $this->id,
            'nome'      => $this->nome,
            'sobrenome' => $this->sobrenome,
            'endereco'  => $this->idEndereco
        );
    }

    /**
     * Obtem pessoas com seus respectivos endereços
     *
     * @param string $nome
     * @param null $sobrenome
     * @return array
     */
    public function getPessoas($nome = null, $sobrenome = null)
    {
        $sqlStm = 'SELECT  p.id, p.nome, p.sobrenome, e.rua, e.numero, e.bairro, e.cidade, e.uf FROM pessoas p LEFT JOIN enderecos e ON p.fk_enderecos = e.id ';
        $sqlStm .= (!is_null($nome)) ? ' AND nome LIKE :nome' : '';
        $sqlStm .= (!is_null($sobrenome)) ? ' AND sobrenome LIKE :sobrenome' : '';
        $prepSt = $this->connection->prepare($sqlStm);

        if (!is_null($nome)) $prepSt->bindValue(':nome', "%$nome%");
        if (!is_null($sobrenome)) $prepSt->bindValue(':sobrenome    ', "%$sobrenome%");

        $prepSt->execute();

        return $prepSt->fetchAll(PDO::FETCH_ASSOC);
    }

	/**
	 * Salva a instancia do objeto no banco de dados
	 *
	 * @return bool
	 */
	public function save()
    {
        $sqlStm = "INSERT INTO pessoas (nome, sobrenome, fk_enderecos)
                    VALUES (:nome, :sobrenome, :fk_enderecos)";
        $prepStm = $this->connection->prepare($sqlStm);

        $prepStm->bindValue(':nome', "$this->nome");
        $prepStm->bindValue(':sobrenome', "$this->sobrenome");
        $prepStm->bindValue(':fk_enderecos', ((!is_null($this->idEndereco)) ? $this->idEndereco : NULL));

        return $prepStm->execute();

    }

	/**
	 * Atualiza as informações de uma pessoa, conforme os atributos desta classe
	 *
	 * @return bool
	 */
    public function update()
    {
        $sqlStm = "UPDATE pessoas SET  nome = :nome, sobrenome = :sobrenome, fk_enderecos = :fk_enderecos WHERE id = :id";
        $prepStm = $this->connection->prepare($sqlStm);

        $prepStm->bindValue(':id', "$this->id");
        $prepStm->bindValue(':nome', "$this->nome");
        $prepStm->bindValue(':sobrenome', "$this->sobrenome");
        $prepStm->bindValue(':fk_enderecos', ((!is_null($this->idEndereco)) ? $this->idEndereco : NULL));

        return $prepStm->execute();

    }

	/**
	 * Exclui um registro de pessoa do banco, conforme os atributos desta classe
	 *
	 * @return bool
	 */
    public function delete()
    {
        $sqlStm = "DELETE FROM pessoas WHERE id = :id";
        $prepStm = $this->connection->prepare($sqlStm);
        $prepStm->bindValue(':id', "$this->id");
        return $prepStm->execute();
    }
}