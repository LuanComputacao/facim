<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 01:00
 */
class Pessoas extends Model
{
    private $id = null;
    private $nome = null;
    private $sobrenome = null;
    private $endereco = null;


    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param null $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param null $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @param null $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * Obtem pessoas com endereço
     *
     * @param $nome
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

    public function save()
    {
        $sqlStm = "INSERT INTO pessoas (nome, sobrenome, fk_enderecos)
                    VALUES (:nome, :sobrenome, :fk_enderecos)";
        $prepStm = $this->connection->prepare($sqlStm);

        $prepStm->bindValue(':nome', "$this->nome");
        $prepStm->bindValue(':sobrenome', "$this->sobrenome");
        $prepStm->bindValue(':fk_enderecos', ((!is_null($this->endereco)) ? $this->endereco : NULL));

        return $prepStm->execute();

    }
}