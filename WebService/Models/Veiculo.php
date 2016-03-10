<?php
namespace WebService\Models;
use DataBase\ModelBase;
use DataBase\Types;

/**
 * Model responsavel por mapear a tabela veiculos.
 *
 * @table veiculos
 */
class Veiculo extends ModelBase {

    /**
     * ID do veiculo.
     *
     * @var int
     * @column id
     * @id
     * @notnull
     */
    protected $id;

    /**
     * Breve descrição do veiculo.
     *
     * @var string
     * @notnull
     * @length 50
     */
    protected $descricao;

    /**
     * Quilometragem total do veiculo quando registrado.
     *
     * @var float
     * @notnull
     */
    protected $quilometragem;

    /* ******************** GETTERS ******************** */

    public function getId(){
        return $this->id;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getQuilometragem(){
        return $this->quilometragem;
    }

    /* ******************** SETTERS ******************** */

    public function setDescricao($descricao){
        $this->descricao = Types::casting($descricao, 'string');
        return $this;
    }

    public function setQuilometragem($quilometragem){
        $this->quilometragem = Types::casting($quilometragem, 'float');
        return $this;
    }
}
