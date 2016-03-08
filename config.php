<?php
/**
 * Arquivo de configuração da aplicação
 */
return array(
    //Parâmetros para a conexão do banco de dados
    'dataBase' => array(
        'driver' => 'mysql',
        'dbname' => 'minha_gasolina',
        'user' => 'minha_gasolina',
        'password' => 'HHzacfV2fWeaWs2U'
    ),

    //controllers registrados para a aplicação
    'controllers' => array(
        'abastecimentos' => 'WebService\Controllers\AbastecimentosController'
    )
);
