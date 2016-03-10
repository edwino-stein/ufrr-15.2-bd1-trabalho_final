/*
    Usuário para conexão com o banco de dados
    - login: minha_gasolina
    - senha: HHzacfV2fWeaWs2U
 */

-- Cria o usuário
CREATE USER 'minha_gasolina'@'%' IDENTIFIED WITH mysql_native_password;

-- Define limites do usuário
GRANT USAGE ON *.* TO 'minha_gasolina'@'%' REQUIRE NONE WITH
    MAX_QUERIES_PER_HOUR 0
    MAX_CONNECTIONS_PER_HOUR 0
    MAX_UPDATES_PER_HOUR 0
    MAX_USER_CONNECTIONS 0;

-- Define uma senha para o usuário
SET PASSWORD FOR 'minha_gasolina'@'%' = PASSWORD('HHzacfV2fWeaWs2U');

-- Define as permissões do usuário para todas as tabelas de minha_gasolina
GRANT ALL PRIVILEGES ON `minha_gasolina`.* TO 'minha_gasolina'@'%';
