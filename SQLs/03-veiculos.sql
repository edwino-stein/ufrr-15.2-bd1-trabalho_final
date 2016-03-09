/*
    Tabela responsavel por armazenas os dados dos veiculos
 */
CREATE TABLE `minha_gasolina`.`veiculos` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'ID do veiculo',
    `descricao` VARCHAR(50) NOT NULL COMMENT 'Breve descrição do veiculo',
    `quilometragem` FLOAT NOT NULL COMMENT 'Quilometragem total do veiculo',
    PRIMARY KEY (`id`)
)ENGINE = InnoDB;
