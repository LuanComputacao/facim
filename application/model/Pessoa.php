<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 01:00
 */
class Pessoa extends Model
{
    private $id = null;
    private $nome = null;
    private $sobrenome = null;
    private $endereco = null;


    /**
     * Obtem pessoas com endereço
     * @param $nome
     * @param null $sobrenome
     * @return array
     */
    public function getPessoa($nome, $sobrenome = null)
    {
        $sqlStm = 'SELECT * FROM pessoas p INNER JOIN enderecos e WHERE p.fk_enderecos = e.id AND nome LIKE \'%:nome%\'';
        $sqlStm .= (!is_null($sobrenome)) ? 'AND sobrenome LIKE \'%:sobrenome\'' : '';
        var_dump($sqlStm);
        $prepSt = $this->connection->prepare($sqlStm);
        $prepSt->bindValue(':nome', $nome);

        return $prepSt->fetchAll();
    }
}