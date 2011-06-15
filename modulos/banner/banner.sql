CREATE  TABLE IF NOT EXISTS `banner_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id`, `nome`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `bdSites`.`banner` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `categoria_id` INT(11) NOT NULL ,
  `titulo` VARCHAR(250) NOT NULL ,
  `imagem` VARCHAR(250) NOT NULL ,
  `flash` VARCHAR(250) NULL ,
  `status` CHAR(1) NOT NULL DEFAULT '1' ,
  `tipo` VARCHAR(6) NOT NULL COMMENT '.swf\n.jpg\n.gif' ,
  `link` VARCHAR(250) NULL ,
  `date_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_banners_banners_categoria1` (`categoria_id` ASC) ,
  INDEX `fk_banners_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_banners_banners_categoria1`
    FOREIGN KEY (`categoria_id` )
    REFERENCES `bdSites`.`banner_categoria` (`id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_banners_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `metabonu_bd`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `bdSites`.`banner_stats` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `banner_id` INT(11) NOT NULL ,
  `tipo` CHAR(1) NOT NULL DEFAULT 0 COMMENT 'visualizacao=0\nclique=1' ,
  `ip` VARCHAR(150) NULL ,
  `url_referencia` VARCHAR(250) NULL ,
  `date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  INDEX `fk_banner_stats_banner1` (`banner_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_banner_stats_banner1`
    FOREIGN KEY (`banner_id` )
    REFERENCES `bdSites`.`banner` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (31,0,'0','Banner','banner',1);
insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (32,31,'1','Banner Detalhes','banner/detalhes',1);
insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`) values (33,31,'0','Novo Banner','banner/novo',1);