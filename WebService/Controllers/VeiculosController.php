<?php
namespace WebService\Controllers;
use Application\Application;
use WebService\Models\Veiculo;

class VeiculosController {

    /**
     * Realiza a leitura de um registro da tabela veiculos.
     */
    public function readAction(){

        //Pega o id do veiculo
        $veiculo = Application::getParam('id');
        if($veiculo === null){
            return json_encode(array(
                'success' => false,
                'message' => 'Veiculo é inválido ou não existe.',
                'code' => 0
            ));
        }

        try {
            //Pega o veiculo solicitado
            $model = Veiculo::findOneBy(array('id' => $veiculo));
        }
        catch (\Exception $e){

            //Caso algo dê errado, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }

        //Retorna os dados encontrados
        return json_encode(array(
            'success' => true,
            'data' => array($model->toArray()),
            'total' => 1
        ));
    }

    /**
     * Cria novos registros para a tabela veiculos.
     */
    public function createAction(){

        //Mapeia a entradas de dados
        $inputMap = array('descricao', 'quilometragem');
        $data = array();
        $erros = array();
        $value = null;

        //Procura os dados informados a partir do mapa de entrada
        foreach ($inputMap as $key) {
            $value = Application::getParam($key);

            if($value === null) $erros[] = $key;
            else $data[$key] = $value;
        }

        //Retorna um erro para caso um campo tenha faltado
        if(!empty($erros)){
            return json_encode(array(
                'success' => false,
                'message' => 'Alguns campos estão vazios ou são inválidos.',
                'extra' => $erros,
                'code' => 0
            ));
        }

        //Instancia e inicializa uma model
        $model = new Veiculo();
        $model->setDescricao($data['descricao']);
        $model->setQuilometragem($data['quilometragem']);

        try{
            //Salva os dados no banco de dados
            $model->save();
        }
        catch(\Exception $e){

            //Caso algo dê errado, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }

        //Retorna os dados que foram pessistidos no banco de dados
        return json_encode(array(
            'success' => true,
            'data' => $model->toArray()
        ));
    }
}
