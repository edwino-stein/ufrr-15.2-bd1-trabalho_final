<?php
namespace WebService\Controllers;
use Application\Application;
use WebService\Models\Abastecimento;

class AbastecimentosController {

    /**
     * Realiza a leitura de todos os registros da tabela abastecimentos.
     */
    public function readAction(){

        try {
            //Pega todos os abastecimentos
            $result = Abastecimento::fetchAll(array(
                'orderby' => 'criadoEm',
                'direction' => Abastecimento::ORDER_DIRECTION_DESC
            ));
        }
        catch (\Exception $e){

            //Caso algo dê errado, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }

        //Converte as models para array
        $data = array();
        $total = 0;
        foreach ($result as $model){
            $data[] = $model->toArray();
            $total++;
        }

        //Retorna os dados encontrados
        return json_encode(array(
            'success' => true,
            'data' => $data,
            'total' => $total
        ));
    }

    /**
     * Cria novos registros para a tabela abastecimentos.
     */
    public function createAction(){

        //Mapeia a entradas de dados
        $inputMap = array('valorTotal', 'litros', 'precoLitro', 'quilometragem', 'data');
        $data = array();
        $erros = array();
        $value = null;

        //Procura os dados informados a partir do mapa de entrada
        foreach ($inputMap as $key) {
            $value = Application::getParam($key);
            if($value === null)
                $erros[] = $key;
            else
                $data[$key] = $value;
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
        $model = new Abastecimento();
        $model->setValorTotal($data['valorTotal']);
        $model->setLitros($data['litros']);
        $model->setPrecoLitro($data['precoLitro']);
        $model->setQuilometragem($data['quilometragem']);
        $model->setData($data['data']);
        $model->setCriadoEm(new \DateTime());

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

    /**
     * Atualiza os registros da tabela abastecimentos.
     */
    public function updateAction(){

        //Mapeia a entradas de dados
        $inputMap = array('id', 'valorTotal', 'litros', 'precoLitro', 'quilometragem', 'data');
        $data = array();
        $erros = array();
        $value = null;

        //Procura os dados informados a partir do mapa de entrada
        foreach ($inputMap as $key) {
            $value = Application::getParam($key);
            if($value === null)
                $erros[] = $key;
            else
                $data[$key] = $value;
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

        try {
            //Busta o registro especificado para a atualização
            $model = Abastecimento::findOneBy(array('id' => $data['id']));

        } catch (Exception $e) {

            //Em caso de erro, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => 'O abastecimento é inválido ou não existe.'
            ));
        }

        //Caso não a encontre, retorna uma menssagem de erro.
        if($model === null){
            return json_encode(array(
                'success' => false,
                'message' => 'O abastecimento é inválido ou não existe.'
            ));
        }

        //Atualiza os dados da model
        $model->setValorTotal($data['valorTotal']);
        $model->setLitros($data['litros']);
        $model->setPrecoLitro($data['precoLitro']);
        $model->setQuilometragem($data['quilometragem']);
        $model->setData($data['data']);

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

    /**
     * Remove registros da tabela abastecimentos.
     */
    public function deleteAction(){

        //Pega o id do abastecimento
        $id = Application::getParam('id');
        if($id === null){
            return json_encode(array(
                'success' => false,
                'message' => 'O abastecimento é inválido ou não existe.'
            ));
        }

        try {
            //Busta o registro especificado para a atualização
            $model = Abastecimento::findOneBy(array('id' => $id));

        } catch (Exception $e) {

            //Em caso de erro, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => 'O abastecimento é inválido ou não existe.'
            ));
        }

        //Caso não a encontre, retorna uma menssagem de erro.
        if($model === null){
            return json_encode(array(
                'success' => false,
                'message' => 'O abastecimento é inválido ou não existe.'
            ));
        }

        try{
            //Remove os dados do banco de dados
            $model->delete();
        }
        catch(\Exception $e){

            //Caso algo dê errado, retorna uma menssagem de erro
            return json_encode(array(
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }

        //Retorna os dados que foram removidos no banco de dados
        return json_encode(array(
            'success' => true,
            'data' => $model->toArray()
        ));
    }
}
