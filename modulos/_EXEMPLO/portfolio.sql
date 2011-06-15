CREATE  TABLE IF NOT EXISTS `portfolio_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(250) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE  TABLE IF NOT EXISTS `portfolio` (
  `id` INT NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  `categoria_id` INT(11) NOT NULL ,
  `titulo` VARCHAR(250) NOT NULL ,
  `img_thumb` VARCHAR(150) NOT NULL ,
  `img_big` VARCHAR(150) NULL ,
  `descricao` TEXT NULL ,
  `publicacao` DATE NOT NULL ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_portfolio_portfolio_categoria1` (`categoria_id` ASC) ,
  INDEX `fk_portfolio_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_portfolio_portfolio_categoria1`
    FOREIGN KEY (`categoria_id` )
    REFERENCES `portfolio_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portfolio_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;