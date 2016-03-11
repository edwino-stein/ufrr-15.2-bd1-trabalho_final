<?php
namespace Application;

//Limpa o cache das aplicações
if(function_exists('opcache_reset')) opcache_reset();

//Inclue o autoloader
include_once(__DIR__.'/autoload.php');

/**
 * Classe base de uma aplicação, responsavel por gerenciar a instancia singleton da aplicação
 */
abstract class Application {

    /**
     * Método de inicialização da aplicação
     */
    abstract protected function init();

    /**
     * Instancia da aplicação
     * @var Application\Application
     */
    private static $instance;

    /**
     * Mapa de namespaces para o autoloader
     * @var array
     */
    private static $namespaces;

    /**
     * Executa a aplicação
     * @param  Application\Application $instance   Instancia da aplicação
     * @param  array      $namespaces Mapa de namespaces para o autoloader
     */
    public static function run(Application $instance, $namespaces){
        if(self::$instance !== null) return;
        self::$namespaces = $namespaces;
        self::$instance = $instance;
        self::$instance->init();
    }

    /**
     * Retorna a instancia singleton da aplicação
     * @return Application\Application
     */
    public static function app(){
        return self::$instance;
    }

    /**
     * Impletancação do autoloader customizado
     * @param  string $className Namespace da classe
     */
    public static function autoLoad($className){

        //Remove as barras invertidas
        $namespace = explode('\\', $className);

        //Pega a raiz do namespace
        $base = array_shift($namespace);

        //Se não tiver nada no resto do namespace, ignora
        if(empty($namespace)) return;

        //Verifica se o namespace foi registrado no mapa de namespaces
        if(!isset(self::$namespaces[$base]))
            throw new \Exception('O Namespace "'.$base.'\\'.implode('\\', $namespace).'" não foi registrado.', 1);

        //Inclue a classe requisitada
        require_once(self::$namespaces[$base].implode('/', $namespace).'.php');
    }

    /**
     * Procura e retorna o valor de um parâmetro GET ou POST.
     * @param  string $key     Nome do parâmetros
     * @param  mixin $default Valor padrão de retorno para caso não exista o parãmetro
     * @return string          Valor do parâmetro
     */
    public static function getParam($key, $default = null){

        //Verifica se existe nos parâmetros GET
        if(isset($_GET[$key]) and ! empty($_GET[$key]))
            return $_GET[$key];

        //Verifica se existe nos parâmetros POST
        if(isset($_POST[$key]) and ! empty($_POST[$key]))
            return $_POST[$key];

        return $default;
    }
}
