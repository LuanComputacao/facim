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
     *
     * @param $nome
     * @param null $sobrenome
     * @return array
     */
    public function getPessoas($nome = null, $sobrenome = null)
    {
        $sqlStm = 'SELECT * FROM pessoas p INNER JOIN enderecos e WHERE p.fk_enderecos = e.id ';
        $sqlStm .= (!is_null($nome)) ? ' AND nome LIKE :nome' : '';
        $sqlStm .= (!is_null($sobrenome)) ? ' AND sobrenome LIKE :sobrenome' : '';
        $prepSt = $this->connection->prepare($sqlStm);

        if (!is_null($nome)) $prepSt->bindValue(':nome', "%$nome%");
        if (!is_null($sobrenome)) $prepSt->bindValue(':sobrenome    ', "%$sobrenome%");

        $prepSt->execute();

        return $prepSt->fetchAll();
    }
}