/*
    Tabela de abastecimentos
 */
CREATE TABLE `minha_gasolina`.`abastecimentos` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'ID da tabela',
    `valor_total` FLOAT NOT NULL COMMENT 'Valor total gasto no abastecimento',
    `litros` FLOAT NOT NULL COMMENT 'Quantidade de combustível abastecido',
    `preco_litro` FLOAT NOT NULL COMMENT 'Valor por litro do combustivel',
    `quilometragem` FLOAT NOT NULL COMMENT 'Quilometragem do veiculo quando abastecido',
    `data` DATETIME NOT NULL COMMENT 'Data e hora do abastecimento',
    `criado_em` DATETIME NOT NULL COMMENT 'Campo que servira de ordem de criação',
    `veiculo_id` INT NOT NULL COMMENT 'Referencia do veiculo que foi abastecido',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Cria o relacionamento abastecimento_veliculo
ALTER TABLE `abastecimentos` ADD INDEX( `veiculo_id`);
ALTER TABLE `abastecimentos` ADD CONSTRAINT `abastecimento_veliculo`
    FOREIGN KEY (`veiculo_id`) REFERENCES `minha_gasolina`.`veiculos`(`id`)
    ON DELETE RESTRICT ON UPDATE RESTRICT;
