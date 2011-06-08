/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) collate utf8_bin NOT NULL default '0',
  `ip_address` varchar(16) collate utf8_bin NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `ci_sessions` */

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(250) collate utf8_unicode_ci NOT NULL,
  `empresa` varchar(250) collate utf8_unicode_ci default NULL,
  `dt_nascimento` date NOT NULL,
  `correio` varchar(250) collate utf8_unicode_ci NOT NULL,
  `celular` varchar(9) collate utf8_unicode_ci NOT NULL,
  `celular_dd` char(2) collate utf8_unicode_ci NOT NULL,
  `ip` varchar(150) collate utf8_unicode_ci default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `sms` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `clientes` */


/*Table structure for table `contato` */

DROP TABLE IF EXISTS `contato`;

CREATE TABLE `contato` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(45) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(250) collate utf8_unicode_ci NOT NULL,
  `telefone` varchar(18) collate utf8_unicode_ci default NULL,
  `mensagem` text collate utf8_unicode_ci NOT NULL,
  `departamento` varchar(100) character set utf8 default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `ip` varchar(120) collate utf8_unicode_ci NOT NULL default '',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contato` */

/*Table structure for table `conteudo` */

DROP TABLE IF EXISTS `conteudo`;

CREATE TABLE `conteudo` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_grupo` int(11) default NULL,
  `titulo` varchar(255) collate utf8_unicode_ci NOT NULL,
  `status` char(1) collate utf8_unicode_ci default '0',
  `texto` text collate utf8_unicode_ci,
  `imagem` varchar(120) collate utf8_unicode_ci default NULL,
  `legenda` varchar(150) collate utf8_unicode_ci default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `arquivo` varchar(100) collate utf8_unicode_ci default NULL COMMENT 'Possui arquivo para download? Se sim verificar se é restrito e trazer todos os downloads por arquivos .php',
  `restrito` char(1) collate utf8_unicode_ci default '0' COMMENT 'Conteúdo para área restrita alterar o valor aqui.',
  PRIMARY KEY  (`id`),
  KEY `fk_conteudo_users1` (`users_id`),
  KEY `fk_conteudo_conteudo_categoria1` (`id_cat`),
  KEY `fk_conteudo_galeria_grupo1` (`id_grupo`),
  CONSTRAINT `fk_conteudo_conteudo_categoria1` FOREIGN KEY (`id_cat`) REFERENCES `conteudo_categoria` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_galeria_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `galeria_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Para desabilitar a imagem ou o texto do conteúdo deixe o cam';

/*Data for the table `conteudo` */

insert  into `conteudo`(`id`,`users_id`,`id_cat`,`id_grupo`,`titulo`,`status`,`texto`,`imagem`,`legenda`,`data_add`,`arquivo`,`restrito`) values (6,20,3,NULL,'agência','1','<h1 class=\"tituloAgencia\">Criatividade com mais qualidade de vida.</h1> \r\n        <p>&nbsp;</p> \r\n        <p>A Alta Brasil possui as unidades de Ribeirão Preto e São Paulo. </p> \r\n        <p>Formados por profissionais vindos de São Paulo\r\n          e de toda a região, na Alta Ribeirão estão concentrados os núcleos de criação, produção, atendimento, planejamento e mídia.<br /> \r\n        </p> \r\n        <p>&nbsp;</p> \r\n        <p>Com essa estratégia, associada à velocidade da internet e o apoio da unidade da capital, a agência consegue atender clientes do Brasil inteiro com criatividade ampliada pela qualidade de vida.</p> ',NULL,NULL,'2010-12-16 16:08:15',NULL,'0');

/*Table structure for table `conteudo_categoria` */

DROP TABLE IF EXISTS `conteudo_categoria`;

CREATE TABLE `conteudo_categoria` (
  `id_cat` int(11) NOT NULL auto_increment,
  `nome` varchar(150) collate utf8_unicode_ci NOT NULL,
  `status` char(1) collate utf8_unicode_ci default '0',
  `imagem` varchar(150) collate utf8_unicode_ci default NULL,
  `pai_cat` int(11) default '0',
  PRIMARY KEY  (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteudo_categoria` */

insert  into `conteudo_categoria`(`id_cat`,`nome`,`status`,`imagem`,`pai_cat`) values (3,'Geral','0',NULL,0);

/*Table structure for table `conteudo_tags` */

DROP TABLE IF EXISTS `conteudo_tags`;

CREATE TABLE `conteudo_tags` (
  `id_tag` int(11) NOT NULL auto_increment,
  `nome` varchar(150) collate utf8_unicode_ci NOT NULL,
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteudo_tags` */

/*Table structure for table `conteudo_youtube` */

DROP TABLE IF EXISTS `conteudo_youtube`;

CREATE TABLE `conteudo_youtube` (
  `id` int(11) NOT NULL auto_increment COMMENT '						',
  `users_id` int(11) NOT NULL,
  `titulo` varchar(45) collate utf8_unicode_ci NOT NULL,
  `youtubeID` varchar(100) collate utf8_unicode_ci NOT NULL,
  `url` varchar(150) collate utf8_unicode_ci default NULL,
  `views` int(11) default NULL,
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_conteudo_youtube_users1` (`users_id`),
  CONSTRAINT `fk_conteudo_youtube_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `conteudo_youtube` */

insert  into `conteudo_youtube`(`id`,`users_id`,`titulo`,`youtubeID`,`url`,`views`,`data`) values (2,20,'Alta Comunicazione - Trabalhos 3D 2010','i65BnVFDEV4','http://www.youtube.com/watch?v=i65BnVFDEV4',NULL,'2011-01-13 11:20:22');

/*Table structure for table `curriculo` */

DROP TABLE IF EXISTS `curriculo`;

CREATE TABLE `curriculo` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(255) collate utf8_unicode_ci NOT NULL,
  `correio` varchar(150) collate utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` char(1) collate utf8_unicode_ci NOT NULL,
  `estado_civil` varchar(45) collate utf8_unicode_ci NOT NULL,
  `cpf` varchar(20) collate utf8_unicode_ci NOT NULL,
  `rg` varchar(18) collate utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) collate utf8_unicode_ci NOT NULL,
  `cep` varchar(10) collate utf8_unicode_ci NOT NULL,
  `bairro` varchar(45) collate utf8_unicode_ci NOT NULL,
  `cidade` varchar(45) collate utf8_unicode_ci NOT NULL,
  `estado` char(2) collate utf8_unicode_ci NOT NULL,
  `complemento` varchar(100) collate utf8_unicode_ci default NULL,
  `telefone` varchar(20) collate utf8_unicode_ci NOT NULL,
  `observacao` text collate utf8_unicode_ci NOT NULL,
  `arquivo` char(150) collate utf8_unicode_ci NOT NULL default '',
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `curriculo` */

/*Table structure for table `galeria` */

DROP TABLE IF EXISTS `galeria`;

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `src` varchar(255) collate utf8_unicode_ci NOT NULL,
  `legenda` varchar(255) collate utf8_unicode_ci default NULL,
  `link` varchar(150) collate utf8_unicode_ci default NULL,
  `ordem` varchar(5) collate utf8_unicode_ci default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_galeria_galeria_tipo1` (`id_tipo`),
  KEY `fk_galeria_galeria_grupo1` (`id_grupo`),
  KEY `fk_galeria_users1` (`users_id`),
  CONSTRAINT `fk_galeria_galeria_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `galeria_grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_galeria_galeria_tipo1` FOREIGN KEY (`id_tipo`) REFERENCES `galeria_tipo` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_galeria_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `galeria` */

/*Table structure for table `galeria_grupo` */

DROP TABLE IF EXISTS `galeria_grupo`;

CREATE TABLE `galeria_grupo` (
  `id_grupo` int(11) NOT NULL auto_increment,
  `nome` varchar(45) default NULL,
  `observacao` text,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='SEMPRE QUE FOR DELETAR UMA CATEGORIA, EFETUAR UM SELECT E DE';

/*Data for the table `galeria_grupo` */

insert  into `galeria_grupo`(`id_grupo`,`nome`,`observacao`,`data_add`) values (18,'Galeria',NULL,'2010-12-16 18:30:22'),(19,'teste',NULL,'2011-01-09 17:15:42');

/*Table structure for table `galeria_tipo` */

DROP TABLE IF EXISTS `galeria_tipo`;

CREATE TABLE `galeria_tipo` (
  `id_tipo` int(11) NOT NULL auto_increment,
  `tipo` varchar(150) collate utf8_unicode_ci default NULL,
  `codigo` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `galeria_tipo` */

insert  into `galeria_tipo`(`id_tipo`,`tipo`,`codigo`) values (1,'Imagem',NULL),(2,'Flash',NULL);

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL auto_increment,
  `ip_address` varchar(40) collate utf8_bin NOT NULL,
  `login` varchar(50) collate utf8_bin NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `login_attempts` */

/*Table structure for table `newsletter` */

DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE `newsletter` (
  `id_news` int(11) NOT NULL auto_increment,
  `nome_news` varchar(80) collate utf8_unicode_ci NOT NULL,
  `correio_news` varchar(150) collate utf8_unicode_ci NOT NULL,
  `ip_news` varchar(100) collate utf8_unicode_ci NOT NULL,
  `date_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_news`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `newsletter` */

/*Table structure for table `noticia` */

DROP TABLE IF EXISTS `noticia`;

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL,
  `id_grupo` int(11) default '0',
  `id_cat` int(11) NOT NULL,
  `status` tinyint(1) default '0',
  `imagem` varchar(250) default NULL,
  `titulo` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `ip` varchar(120) NOT NULL,
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  `destaque` tinyint(1) default '0',
  `capa` tinyint(1) default '0',
  `views` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `fk_noticia_users1` (`users_id`),
  KEY `fk_noticia_noticia_categoria1` (`id_cat`),
  KEY `fk_noticia_galeria_grupo1` (`id_grupo`),
  CONSTRAINT `fk_noticia_galeria_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `galeria_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_noticia_categoria1` FOREIGN KEY (`id_cat`) REFERENCES `noticia_categoria` (`id_cat`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

/*Data for the table `noticia` */

insert  into `noticia`(`id`,`users_id`,`id_grupo`,`id_cat`,`status`,`imagem`,`titulo`,`descricao`,`ip`,`data`,`destaque`,`capa`,`views`) values (70,20,19,24,1,NULL,'Alta Comunicazione 7 Anos','<p>Teste do texto da Alta Comunicazione.</p>','187.72.129.81','2010-12-16 18:30:06',1,0,0);

/*Table structure for table `noticia_categoria` */

DROP TABLE IF EXISTS `noticia_categoria`;

CREATE TABLE `noticia_categoria` (
  `id_cat` int(11) NOT NULL auto_increment,
  `nome` varchar(250) collate utf8_unicode_ci NOT NULL,
  `pai` int(11) default '0',
  PRIMARY KEY  (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `noticia_categoria` */

insert  into `noticia_categoria`(`id_cat`,`nome`,`pai`) values (24,'Geral',0);

/*Table structure for table `produtos` */

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `id_prod` int(11) NOT NULL auto_increment,
  `nome_prod` varchar(200) collate utf8_unicode_ci NOT NULL,
  `descricao_prod` text collate utf8_unicode_ci NOT NULL,
  `img_prod` varchar(150) collate utf8_unicode_ci default NULL,
  `status_prod` char(1) collate utf8_unicode_ci default '0',
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY  (`id_prod`,`id_cat`),
  KEY `fk_produtos_produtos_categoria1` (`id_cat`),
  CONSTRAINT `fk_produtos_produtos_categoria1` FOREIGN KEY (`id_cat`) REFERENCES `produtos_categoria` (`id_cat`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produtos` */

/*Table structure for table `produtos_categoria` */

DROP TABLE IF EXISTS `produtos_categoria`;

CREATE TABLE `produtos_categoria` (
  `id_cat` int(11) NOT NULL auto_increment,
  `nome_cat` varchar(200) collate utf8_bin NOT NULL,
  `descricao_cat` text collate utf8_bin NOT NULL,
  `img_cat` varchar(150) collate utf8_bin default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `pai_cat` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `produtos_categoria` */

/*Table structure for table `receitas` */

DROP TABLE IF EXISTS `receitas`;

CREATE TABLE `receitas` (
  `id_rece` int(11) NOT NULL auto_increment,
  `img_rece` varchar(40) collate utf8_unicode_ci default NULL,
  `nome_rece` varchar(250) collate utf8_unicode_ci NOT NULL,
  `ingredientes_rece` text collate utf8_unicode_ci NOT NULL,
  `preparo_rece` text collate utf8_unicode_ci NOT NULL,
  `visitas_rece` int(11) NOT NULL default '1' COMMENT 'Gravar o número de visitas da receita.',
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_rece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `receitas` */

/*Table structure for table `receitas_has_tags` */

DROP TABLE IF EXISTS `receitas_has_tags`;

CREATE TABLE `receitas_has_tags` (
  `id_rece` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL,
  PRIMARY KEY  (`id_rece`,`id_tags`),
  KEY `fk_receitas_has_receita_tags_receitas` (`id_rece`),
  KEY `fk_receitas_has_receita_tags_receita_tags1` (`id_tags`),
  CONSTRAINT `fk_receitas_has_receita_tags_receita_tags1` FOREIGN KEY (`id_tags`) REFERENCES `receitas_tags` (`id_tags`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `receitas_has_tags_ibfk_1` FOREIGN KEY (`id_rece`) REFERENCES `receitas` (`id_rece`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `receitas_has_tags` */

/*Table structure for table `receitas_tags` */

DROP TABLE IF EXISTS `receitas_tags`;

CREATE TABLE `receitas_tags` (
  `id_tags` int(11) NOT NULL auto_increment,
  `nome_tags` varchar(250) collate utf8_unicode_ci NOT NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `receitas_tags` */

/*Table structure for table `receitas_view` */

DROP TABLE IF EXISTS `receitas_view`;

CREATE TABLE `receitas_view` (
  `id_rece` int(11) NOT NULL default '0',
  `nome_rece` varchar(250) collate utf8_unicode_ci NOT NULL,
  `id_tags` int(11) default NULL,
  `nome_tags` varchar(250) collate utf8_unicode_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `receitas_view` */

/*Table structure for table `social_logs` */

DROP TABLE IF EXISTS `social_logs`;

CREATE TABLE `social_logs` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `descricao` text collate utf8_unicode_ci NOT NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_social_logs_social_users1` (`id_user`),
  CONSTRAINT `fk_social_logs_social_users1` FOREIGN KEY (`id_user`) REFERENCES `social_users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `social_logs` */

/*Table structure for table `social_mensagens` */

DROP TABLE IF EXISTS `social_mensagens`;

CREATE TABLE `social_mensagens` (
  `id` int(11) NOT NULL auto_increment,
  `mensagem` text,
  `id_user` int(11) NOT NULL,
  `id_net` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_social_mensagens_social_users1` (`id_user`),
  KEY `fk_social_mensagens_social_redes1` (`id_net`),
  CONSTRAINT `fk_social_mensagens_social_redes1` FOREIGN KEY (`id_net`) REFERENCES `social_redes` (`id_net`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_social_mensagens_social_users1` FOREIGN KEY (`id_user`) REFERENCES `social_users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `social_mensagens` */

/*Table structure for table `social_redes` */

DROP TABLE IF EXISTS `social_redes`;

CREATE TABLE `social_redes` (
  `id_net` int(11) NOT NULL auto_increment,
  `rede` varchar(200) collate utf8_unicode_ci NOT NULL,
  `url` varchar(200) collate utf8_unicode_ci NOT NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_net`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `social_redes` */

/*Table structure for table `social_users` */

DROP TABLE IF EXISTS `social_users`;

CREATE TABLE `social_users` (
  `id_user` int(11) NOT NULL auto_increment,
  `id_net` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1' COMMENT 'Se o usuario deixar de seguir ou de ser amigo o status tem q mudar para false.',
  `email` varchar(250) collate utf8_unicode_ci NOT NULL,
  `nome` varchar(250) collate utf8_unicode_ci NOT NULL,
  `foto` varchar(250) collate utf8_unicode_ci default NULL,
  `link_profile` varchar(250) collate utf8_unicode_ci default NULL,
  `data_add` timestamp NULL default CURRENT_TIMESTAMP,
  `data_saida` datetime default NULL,
  PRIMARY KEY  (`id_user`),
  KEY `fk_social_users_social_redes1` (`id_net`),
  CONSTRAINT `fk_social_users_social_redes1` FOREIGN KEY (`id_net`) REFERENCES `social_redes` (`id_net`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `social_users` */

/*Table structure for table `user_autologin` */

DROP TABLE IF EXISTS `user_autologin`;

CREATE TABLE `user_autologin` (
  `key_id` char(32) collate utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_autologin` */

/*Table structure for table `user_profiles` */

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) collate utf8_bin default NULL,
  `country` varchar(20) collate utf8_bin default NULL,
  `website` varchar(255) collate utf8_bin default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_profiles` */

insert  into `user_profiles`(`id`,`user_id`,`name`,`country`,`website`) values (19,20,NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) collate utf8_bin NOT NULL,
  `password` varchar(255) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL default '1',
  `banned` tinyint(1) NOT NULL default '0',
  `ban_reason` varchar(255) collate utf8_bin default NULL,
  `new_password_key` varchar(50) collate utf8_bin default NULL,
  `new_password_requested` datetime default NULL,
  `new_email` varchar(100) collate utf8_bin default NULL,
  `new_email_key` varchar(50) collate utf8_bin default NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`activated`,`banned`,`ban_reason`,`new_password_key`,`new_password_requested`,`new_email`,`new_email_key`,`last_ip`,`last_login`,`created`,`modified`) values 
(20,'d.souza','$P$BK5/qUi/54t051sw531evxb3R6C8XE0','d.souza@altacomunicazione.com.br',1,0,NULL,NULL,NULL,NULL,NULL,'187.72.129.81','2011-01-13 10:02:55','2010-12-14 18:02:19','2011-01-13 10:02:55');

/*Table structure for table `users_has_rules` */

DROP TABLE IF EXISTS `users_has_rules`;

CREATE TABLE `users_has_rules` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL,
  `users_rules_id` int(11) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `data` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_roles_to_users_users1` (`users_id`),
  KEY `fk_users_has_rules_users_rules1` (`users_rules_id`),
  CONSTRAINT `fk_roles_to_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_rules_users_rules1` FOREIGN KEY (`users_rules_id`) REFERENCES `users_rules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

/*Data for the table `users_has_rules` REGRAS NECESSÁRIAS PARA ATIVAR CMS */

insert  into `users_has_rules`(`id`,`users_id`,`users_rules_id`,`ip`,`data`) values 
(1,20,4,'192','2010-12-16 16:01:50'),
(2,20,5,'192','2010-12-16 16:01:54'),
(3,20,6,'192','2010-12-16 16:01:58'),
(4,20,7,'192','2010-12-16 16:02:02'),
(5,20,8,'192','2010-12-16 16:02:06'),
(6,20,9,'192','2010-12-16 16:02:10'),
(7,20,12,'192','2010-12-16 16:02:20');

/* QUASE TODAS PERMISSÔES */
/*
insert  into `users_has_rules`(`id`,`users_id`,`users_rules_id`,`ip`,`data`) values 
(66,20,1,'192','2010-12-16 16:01:33'),
(67,20,2,'192','2010-12-16 16:01:39'),
(68,20,3,'192','2010-12-16 16:01:44'),
(69,20,4,'192','2010-12-16 16:01:50'),
(70,20,5,'192','2010-12-16 16:01:54'),
(71,20,6,'192','2010-12-16 16:01:58'),
(72,20,7,'192','2010-12-16 16:02:02'),
(73,20,8,'192','2010-12-16 16:02:06'),
(74,20,9,'192','2010-12-16 16:02:10'),
(75,20,10,'192','2010-12-16 16:02:14'),
(76,20,11,'192','2010-12-16 16:02:17'),
(77,20,12,'192','2010-12-16 16:02:20'),
(78,20,13,'192','2010-12-16 16:02:24'),
(79,20,14,'192','2010-12-16 16:02:28'),
(80,20,15,'192','2010-12-16 16:02:31'),
(85,20,16,'192','2011-02-25 15:28:36'),
(89,20,17,'192','2011-03-10 15:13:57'),
(88,20,18,'192','2011-03-10 15:13:55'),
(87,20,19,'192','2011-02-28 17:59:36'),
(116,20,20,'192','2011-04-01 15:36:28'),
(91,20,21,'192','2011-03-21 11:11:53');
*/


/*Table structure for table `users_rules` */

DROP TABLE IF EXISTS `users_rules`;

CREATE TABLE `users_rules` (
  `id` int(11) NOT NULL auto_increment,
  `pai` int(11) default '0',
  `hidden` char(1) collate utf8_unicode_ci default '0',
  `nome` varchar(150) collate utf8_unicode_ci NOT NULL,
  `url` varchar(150) collate utf8_unicode_ci NOT NULL,
  `moduloAtivado` tinyint(1) default '0',
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `users_rules` */

insert  into `users_rules`(`id`,`pai`,`hidden`,`nome`,`url`,`moduloAtivado`,`data`) values 
(1,0,'0','Conteúdo','conteudo',0,'2010-10-07 02:29:13'),
(2,1,'0','Listar Conteúdo','conteudo',0,'2010-10-07 02:31:46'),
(3,1,'0','Conteúdo Detalhes','conteudo/detalhes',0,'2010-10-07 02:32:20'),
(4,0,'0','Usuários','usuario',0,'2010-10-07 03:12:42'),
(5,4,'0','Usuários Cadastrados','usuario',0,'2010-10-07 03:12:58'),
(6,4,'1','Alterar Status Usuário','usuario/status',0,'2010-10-08 00:49:50'),
(7,4,'0','Cadastrar Usuário','usuario/novo',0,'2010-10-08 02:45:22'),
(8,4,'0','Trocar minha senha','usuario/senha',0,'2010-10-09 04:23:32'),
(9,4,'1','Alterar Permissão do Usuário','usuario/permissao',0,'2010-10-14 00:22:17'),
(10,2,'1','Listar Galeria em Conteúdo','conteudo/detalhes',0,'2010-10-14 23:18:07'),
(11,1,'0','Editar Galeria','galeria/detalhes',0,'2010-10-19 03:11:15'),
(12,4,'1','Editar usuários','usuarios/detalhes',0,'2010-10-26 05:42:01'),
(13,0,'0','Notícias','noticias',0,'2010-11-13 11:46:12'),
(14,13,'1','Editar Categorias','noticias/categoriaEditar',0,'2010-11-13 16:26:14'),
(15,0,'0','Video','video',0,'2010-11-15 14:31:29'),
(16,0,'0','Clientes','cliente',0,'2011-02-25 10:58:03'),
(17,16,'0','Cadastrar Clientes','cliente/novo',0,'2011-02-25 15:08:05'),
(18,16,'1','Alterar Clientes','cliente/detalhes',0,'2011-02-28 12:13:25'),
(19,16,'0','Atualizar Meta Bônus','metabonus',0,'2011-02-28 17:59:24'),
(20,0,'0','Mensagem','mensagem',0,'2011-03-11 14:43:53'),
(21,16,'1','Enviar Extrato','cliente/extrato',0,'2011-03-21 11:08:39'),
(22,0,'0','Contato','contato',0,'2011-03-21 11:08:39'),
(23,0,'0','NewsLetter','newsletter',0,'2011-03-21 11:08:39'),
(24,0,'0','Galeria','galeria',0,'2011-03-21 11:08:39'),
(25,0,'0','Listar Clientes','cliente/listar',0,'2011-03-21 11:08:39'),
(26,0,'0','Gerenciar Vídeos','videos/editar',0,'2011-03-21 11:08:39');




/*Table structure for table `users_rules_logs` */

DROP TABLE IF EXISTS `users_rules_logs`;

CREATE TABLE `users_rules_logs` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(150) NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_rules_id` int(11) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `data` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;


/*Table structure for table `youtube_has_tags` 
MODULO SUBSITUIDO PELO MODULO DE VIDEOS.
*/

DROP TABLE IF EXISTS `youtube_has_tags`;

CREATE TABLE `youtube_has_tags` (
  `conteudo_youtube_id` int(11) NOT NULL,
  `conteudo_tags_id_tag` int(11) NOT NULL,
  PRIMARY KEY  (`conteudo_youtube_id`,`conteudo_tags_id_tag`),
  KEY `fk_conteudo_youtube_has_conteudo_tags_conteudo_youtube1` (`conteudo_youtube_id`),
  KEY `fk_conteudo_youtube_has_conteudo_tags_conteudo_tags1` (`conteudo_tags_id_tag`),
  CONSTRAINT `fk_conteudo_youtube_has_conteudo_tags_conteudo_tags1` FOREIGN KEY (`conteudo_tags_id_tag`) REFERENCES `conteudo_tags` (`id_tag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conteudo_youtube_has_conteudo_tags_conteudo_youtube1` FOREIGN KEY (`conteudo_youtube_id`) REFERENCES `conteudo_youtube` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `youtube_has_tags` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;



DROP TABLE IF EXISTS `video_grupo`;

CREATE  TABLE IF NOT EXISTS `video_grupo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(250) NOT NULL ,
  `observacao` TEXT NULL ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB

DROP TABLE IF EXISTS `video`;

CREATE  TABLE IF NOT EXISTS `video` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `users_id` INT(11) NOT NULL ,
  `video_grupo_id` INT(11) NOT NULL ,
  `legenda` VARCHAR(250) NOT NULL ,
  `id_video` VARCHAR(250) NOT NULL ,
  `tipo` VARCHAR(45) NOT NULL COMMENT 'youtube, vimeo' ,
  `ip` VARCHAR(150) NULL ,
  `views` INT(11) NULL ,
  `data_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_video_users1` (`users_id` ASC) ,
  INDEX `fk_video_video_grupo1` (`video_grupo_id` ASC) ,
  CONSTRAINT `fk_video_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_video_grupo1`
    FOREIGN KEY (`video_grupo_id` )
    REFERENCES `video_grupo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB