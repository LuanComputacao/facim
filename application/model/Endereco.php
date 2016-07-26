<?php


class Endereco extends Model
{
    private $id = null;
    private $rua = null;
    private $numero = null;
    private $bairro = null;
    private $cidade = null;
    private $uf = null;

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param null $rua
     */
    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    /**
     * @param null $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param null $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @param null $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @param null $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getEndereco()
    {
        return array(
            'id' => $this->id,
            'rua' => $this->rua,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf
        );

    }

    public function save()
    {
        $sqlStm = "INSERT INTO enderecos (rua, numero, bairro, cidade, uf)
                    VALUES ( :rua, :numero, :bairro, :cidade, :uf)";

        $prepStm = $this->connection->prepare($sqlStm);

        $prepStm->bindValue(':rua'    , ((!is_null($this->rua))?    $this->rua     :NULL));
        $prepStm->bindValue(':numero' , ((!is_null($this->numero))? $this->numero  :NULL));
        $prepStm->bindValue(':bairro' , ((!is_null($this->bairro))? $this->bairro  :NULL));
        $prepStm->bindValue(':cidade' , ((!is_null($this->cidade))? $this->cidade  :NULL));
        $prepStm->bindValue(':uf'     , ((!is_null($this->uf))?     $this->uf      :NULL));

        if(!(is_null($this->rua) && is_null($this->numero) && is_null($this->bairro) && is_null($this->cidade) && is_null($this->uf))) {
            $prepStm->execute();
            $this->id = $this->connection->lastInsertId();
        }


    }

    public function update ()
    {
        $sqlStm = "UPDATE enderecos SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id = :id";

        $prepStm = $this->connection->prepare($sqlStm);

        $prepStm->bindValue(':id'     , $this->id);
        $prepStm->bindValue(':rua'    , ((!is_null($this->rua))?    $this->rua     :NULL));
        $prepStm->bindValue(':numero' , ((!is_null($this->numero))? $this->numero  :NULL));
        $prepStm->bindValue(':bairro' , ((!is_null($this->bairro))? $this->bairro  :NULL));
        $prepStm->bindValue(':cidade' , ((!is_null($this->cidade))? $this->cidade  :NULL));
        $prepStm->bindValue(':uf'     , ((!is_null($this->uf))?     $this->uf      :NULL));

        if(!(is_null($this->rua) && is_null($this->numero) && is_null($this->bairro) && is_null($this->cidade) && is_null($this->uf))) {
            $prepStm->execute();
            $this->id = $this->connection->lastInsertId();
        }
    }

    public function delete()
    {
        $sqlStm = "DELETE FROM enderecos WHERE id = :id";
        $prepStm = $this->connection->prepare($sqlStm);
        $prepStm->bindValue(':id', "$this->id");
        return $prepStm->execute();
    }
}