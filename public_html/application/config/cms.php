<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in CMS
|--------------------------------------------------------------------------
*/

/// GERAL
$config['nomeSite'] = 'SITE CMS';
$config['path_temp'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/upload/temp/";
$config['path_upload'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/upload/";
/// habilitar redimensionamento automatico para caber na tela
/*$config['resizeAuto'] = true;
$config['resizeMaxWidht'] = '890';
$config['resizeMaxHeight'] = '890';
*/


/// CONFIGURACOES DE SERVICOS DE E-MAIL
$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['wordwrap'] = false;
$config['mailtype'] = "html";
$config['smtp_host'] = "mail.alertaazul.com.br";
$config['smtp_user'] = "site@alertaazul.com.br";
$config['smtp_pass'] = "y+{FfoB=zdGn";


/// E-mail padrão para recebimento de mensagens
$config['email'] = "d.souza@altacomunicazione.com.br";

/// ENVIO DE LOGS DE PERMISSÕES POR E-MAIL?
$config['logs_email'] = true;// não implementado, apenas salva no banco.
/*
/// NOTICIAS
$config['noticias_path'] = $_SERVER['DOCUMENT_ROOT']."/upload/noticias/";
$config['noticias_widthMin'] = "497";
$config['noticias_heightMin'] = "251";
$config['noticias_allowed_types'] = 'jpg|jpeg|gif|png';
$config['noticias_max_size'] = '2000';
$config['noticias_max_width'] = '1800';
$config['noticias_max_height'] = '1900';

/// GALERIA
$config['galeria_path'] = $_SERVER['DOCUMENT_ROOT']."/upload/galeria/";
$config['galeria_widthMin'] = "470";
$config['galeria_heightMin'] = "330";
$config['galeria_max_size'] = '2000';
$config['galeria_max_width'] = '1800';
$config['galeria_max_height'] = '1900';
$config['galeria_resize_width'] = '800';
$config['galeria_resize_height'] = '600';
$config['galeria_allowed_types'] = 'jpg|jpeg|gif|png';


///Conteudo
$config['conteudo_path'] = $_SERVER['DOCUMENT_ROOT']."/upload/conteudo/";
$config['conteudo_allowed_types'] = 'jpg|jpeg|gif|png';
$config['conteudo_max_size'] = '2000';
$config['conteudo_max_width'] = '1800';
$config['conteudo_max_size'] = '2000';
*/
/* End of file cms.php */
/* Location: ./application/config/cms.php */