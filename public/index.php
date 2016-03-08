<?php

/**
 * O index.php é utilizado apenas como bootstrap e output da aplicação.
 * Os arquivos da aplicação se encontram no diretório "WebService/".
 */

//Muda o diretório para a raiz da aplicação
chdir(dirname(__DIR__));

//Inclue a classe raiz da aplicação
require_once('WebService.php');

//Instancia e executa a aplicação
Application\Application::run(
    new WebService\WebService(include('config.php')),
    include('namespaces.php')
);
