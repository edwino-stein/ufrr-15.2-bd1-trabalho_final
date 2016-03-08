<?php
namespace WebService;
require_once('Libs/Application/Application.php');
use Application\Application;

/**
 * Classe raiz da aplicação que é responsavel por carregar e inicializar a
 * aplicação utilizado uma implementação MVC.
 */
class WebService extends Application {

    /**
     * Configurações para a conexão com o banco de dados
     * @var array
     */
    protected $dataBaseCfg;

    /**
     * Mapa de controllers que podem ser utilizados pela aplicação
     * @var array
     */
    protected $controllers;

    public function __construct($config){
        $this->dataBaseCfg = isset($config['dataBase']) ? $config['dataBase'] : array();
        $this->controllers = array();
        foreach ($config['controllers'] as $key => $namespace)
            $this->controllers[strtolower($key)] = $namespace;
    }

    /**
     * Metodo de inicialização da aplicação
     */
    protected function init(){

        //Pega o controller e a action
        $controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : null;
        $action = isset($_GET['action']) ? strtolower($_GET['action']) : null;

        //Verifica se o controller foi registrado na aplicação
        if($controller === null || !isset($this->controllers[$controller])){
            throw new \Exception("Nenhum controller foi encontrado.", 1);
        }

        $controller = new $this->controllers[$controller];
        $action = $action.'Action';

        //Verifica se a action existe no controller
        if(!method_exists($controller, $action)){
            throw new \Exception("Nenhuma action foi encontrado.", 1);
        }

        //Executa a action e captura algum possivel valor de retorno
        $result = $controller->$action();
        if(is_string($result)) echo $result;
    }
}
