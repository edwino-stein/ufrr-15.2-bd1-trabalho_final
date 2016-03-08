<?php
/**
 * Implementação da função de callback para carregamentos de classes
 * @param  string $className Namespace da classe a ser carregada
 */
function __autoload($className) {
    //chama o método estático de autoload da aplicação
    Application\Application::autoLoad($className);
}
