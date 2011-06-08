<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in Banner
|--------------------------------------------------------------------------
*/

// MODULOS E PERMISSOES
$config['banner'] = '31';
$config['banner_detalhes'] = '32';
$config['banner_novo'] = '33';

/// UPLOAD DE Banner
$config['conteudo_allowed_types'] ="jpg|gif|png|swf";
$config['max_size'] = "4000";
$config['max_width'] = "2000";
$config['max_height'] = "2000";

//UPLOAD PORTFOLIO
$config['path_upload_banner'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/novo/upload/banner/";
//

// MENSAGEM ERROS
$config['folder_no_existe'] = 'Pasta não existente no servidor ou ser permissão ';


/* End of file cms.php */
/* Location: ./application/config/banner.php */