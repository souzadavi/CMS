CREATE  TABLE IF NOT EXISTS `conteudo_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `pai` INT(11) NULL DEFAULT 0 ,
  `nome` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


CREATE  TABLE IF NOT EXISTS `conteudo_tags` (
  `id_tag` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id_tag`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `conteudo_galeria_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `conteudo_galeria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `galeria_categoria_id` INT(11) NOT NULL ,
  `tipo_id` VARCHAR(6) NOT NULL COMMENT '.swf\n.jpg\n.gif' ,
  `src` VARCHAR(255) NOT NULL ,
  `legenda` VARCHAR(255) NULL ,
  `link` VARCHAR(255) NULL ,
  `ordem` VARCHAR(8) NULL DEFAULT 0 ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_conteudo_galeria_users1` (`users_id` ASC) ,
  INDEX `fk_conteudo_galeria_conteudo_galeria_categoria1` (`galeria_categoria_id` ASC) ,
  CONSTRAINT `fk_conteudo_galeria_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_galeria_conteudo_galeria_categoria1`
    FOREIGN KEY (`galeria_categoria_id` )
    REFERENCES `conteudo_galeria_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `conteudo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `galeria_categoria_id` INT(11) NULL ,
  `status` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '2' COMMENT '0 - pendente\n1 - publicado\n2 - rascunho\n3 - backup' ,
  `visibilidade` CHAR(1) NOT NULL DEFAULT '1' COMMENT '0- Privado\n1- Público\n2- Privado\n3- Destaque' ,
  `tipo` CHAR(1) NOT NULL COMMENT '0-Page\n1-Noticias' ,
  `titulo` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `descricao` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL ,
  `resumo` VARCHAR(255) NULL ,
  `ip` VARCHAR(120) NOT NULL ,
  `imagem` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `legenda` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_conteudo_users12` (`users_id` ASC) ,
  INDEX `fk_conteudo_conteudo_galeria_categoria1` (`galeria_categoria_id` ASC) ,
  CONSTRAINT `fk_conteudo_users12`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_conteudo_galeria_categoria1`
    FOREIGN KEY (`galeria_categoria_id` )
    REFERENCES `conteudo_galeria_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Para desabilitar a imagem ou o texto do conteúdo deixe vazio';


CREATE  TABLE IF NOT EXISTS `conteudo_tags_x` (
  `tag_id` INT(11) NOT NULL ,
  `conteudo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`tag_id`, `conteudo_id`) ,
  INDEX `fk_conteudo_tags_has_conteudo_conteudo1` (`conteudo_id` ASC) ,
  CONSTRAINT `fk_conteudo_tags_has_conteudo_conteudo_tags1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `conteudo_tags` (`id_tag` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_tags_has_conteudo_conteudo1`
    FOREIGN KEY (`conteudo_id` )
    REFERENCES `conteudo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


CREATE  TABLE IF NOT EXISTS `conteudo_categoria_x` (
  `conteudo_categoria_id` INT(11) NOT NULL ,
  `conteudo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`conteudo_categoria_id`, `conteudo_id`) ,
  INDEX `fk_conteudo_categoria_has_conteudo_conteudo1` (`conteudo_id` ASC) ,
  CONSTRAINT `fk_conteudo_categoria_has_conteudo_conteudo_categoria1`
    FOREIGN KEY (`conteudo_categoria_id` )
    REFERENCES `conteudo_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_categoria_has_conteudo_conteudo1`
    FOREIGN KEY (`conteudo_id` )
    REFERENCES `conteudo` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

