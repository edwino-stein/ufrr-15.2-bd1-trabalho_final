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

    }
}
