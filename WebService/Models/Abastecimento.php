<?php
namespace WebService\Models;
use DataBase\ModelBase;
use DataBase\Types;

/**
 * Model responsavel por mapear a tabela abastecimentos.
 *
 * @table abastecimentos
 */
class Abastecimento extends ModelBase {

    /**
     * ID do abastecimento.
     *
     * @var int
     * @id
     * @column id
     * @notnull
     */
    protected $id;

    /**
     * Valor total do Abastecimento.
     *
     * @var float
     * @column valor_total
     * @notnull
     */
    protected $valorTotal;

    /**
     * Quantidade total de combustivel.
     *
     * @var float
     * @column litros
     * @notnull
     */
    protected $litros;

    /**
     * Valor por litro do combustivel.
     *
     * @var float
     * @column preco_litro
     * @notnull
     */
    protected $precoLitro;

    /**
     * Quilometragem do veiculo quando foi abastecido.
     * @var float
     * @column quilometragem
     * @notnull
     */
    protected $quilometragem;

    /**
     * Data e hora do abastecimento.
     *
     * @var DateTime
     * @column data
     * @notnull
     */
    protected $data;

    /**
     * Data e hora real do registro do abastecimento.
     *
     * @var DateTime
     * @column criado_em
     * @notnull
     */
    protected $criadoEm;

    /**
     * Referencia do veiculo do abastecimento.
     * @var int
     * @column veiculo_id
     * @notnull
     */
    protected $veiculo;

    /* ******************** GETTERS ******************** */

    public function getId(){
        return $this->id;
    }

    public function getValorTotal(){
        return $this->valorTotal;
    }

    public function getLitros(){
        return $this->litros;
    }

    public function getPrecoLitro(){
        return $this->precoLitro;
    }

    public function getQuilometragem(){
        return $this->quilometragem;
    }

    public function getData(){
        return $this->data;
    }

    public function getCriadoEm(){
        return $this->criadoEm;
    }

    public function getVeiculo(){
        return $this->veiculo;
    }

    /* ******************** SETTERS ******************** */

    public function setValorTotal($valorTotal){
        $this->valorTotal = Types::casting($valorTotal, 'float');
        return $this;
    }

    public function setLitros($litros){
        $this->litros = Types::casting($litros, 'float');
        return $this;
    }

    public function setPrecoLitro($precoLitro){
        $this->precoLitro = Types::casting($precoLitro, 'float');
        return $this;
    }

    public function setQuilometragem($quilometragem){
        $this->quilometragem = Types::casting($quilometragem, 'float');
        return $this;
    }

    public function setData($data){
        $this->data = Types::casting($data, 'datetime');
        return $this;
    }

    public function setCriadoEm($criadoEm){
        $this->criadoEm = Types::casting($criadoEm, 'datetime');
        return $this;
    }

    public function setVeiculo($veiculo){
        $this->veiculo = Types::casting($veiculo, 'int');
        return $this;
    }
}
