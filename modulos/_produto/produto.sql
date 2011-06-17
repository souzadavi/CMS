CREATE  TABLE IF NOT EXISTS `produto_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `produto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `categoria_id` INT(11) NOT NULL ,
  `galeria_id` INT(11) NULL DEFAULT 0 ,
  `nome` VARCHAR(45) NOT NULL ,
  `status` CHAR(1) NOT NULL DEFAULT 0 ,
  `imagem` VARCHAR(250) NULL ,
  `valor` DECIMAL(11,2) NULL ,
  `resumo` TEXT NULL ,
  `descricao` TEXT NULL ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_produto_users1` (`users_id` ASC) ,
  INDEX `fk_produto_produto_categoria1` (`categoria_id` ASC) ,
  INDEX `fk_produto_conteudo_galeria1` (`galeria_id` ASC) ,
  CONSTRAINT `fk_produto_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `linknac_sitedb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_produto_categoria1`
    FOREIGN KEY (`categoria_id` )
    REFERENCES `produto_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_conteudo_galeria1`
    FOREIGN KEY (`galeria_id` )
    REFERENCES `conteudo_galeria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (45,0,'0','Produtos','produto',1);
insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (46,45,'0','Novo Produto','produto/novo',1);
insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (47,45,'1','Produto Detalhes','produto/detalhes',1);
