<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in Produto
|--------------------------------------------------------------------------
*/

// MODULOS E PERMISSOES
$config['produto'] = '45';
$config['produto_novo'] = '46';
$config['produto_detalhes'] = '47';
//$config['portfolio_novo'] = '30';

/// UPLOAD DE PRODUTO
$config['allowed_types'] ="jpg|gif|png";
$config['max_size'] = "4000";
$config['max_width'] = "2000";
$config['max_height'] = "2000";
$config['path_upload_produto'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/upload/produto/";
//

// MENSAGEM ERROS
$config['folder_no_existe'] = 'Pasta não existente no servidor ou ser permissão.';


/* End of file cms.php */
/* Location: ./application/config/produto.php */