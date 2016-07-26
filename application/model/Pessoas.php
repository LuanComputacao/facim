<?php


class Pessoas extends Model
{
    private $id = null;
    private $nome = null;
    private $sobrenome = null;
    private $idEndereco = null;


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
     * @param null $idEndereco
     */
    public function setIdEndereco($idEndereco)
    {
        $this->idEndereco = $idEndereco;
    }

    /**
     * @return null
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
        $prepStm->bindValue(':fk_enderecos', ((!is_null($this->idEndereco)) ? $this->idEndereco : NULL));

        return $prepStm->execute();

    }

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

    public function delete()
    {
        $sqlStm = "DELETE FROM pessoas WHERE id = :id";
        $prepStm = $this->connection->prepare($sqlStm);
        $prepStm->bindValue(':id', "$this->id");
        return $prepStm->execute();
    }
}