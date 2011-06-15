<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in Portfolio
|--------------------------------------------------------------------------
*/

// MODULOS E PERMISSOES
$config['portfolio'] = '27';
$config['portfolio_categoria'] = '28';
$config['portfolio_categoria_editar'] = '29';
$config['portfolio_novo'] = '30';

/// UPLOAD DE PORTFOLIO
$config['conteudo_allowed_types'] ="jpg|gif|png";
$config['max_size'] = "4000";
$config['max_width'] = "2000";
$config['max_height'] = "2000";

//UPLOAD PORTFOLIO
$config['path_upload_portfolio'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/novo/upload/portfolio/";
//

// MENSAGEM ERROS
$config['folder_no_existe'] = 'Pasta não existente no servidor ou ser permissão ';


/* End of file cms.php */
/* Location: ./application/config/portfolio.php */