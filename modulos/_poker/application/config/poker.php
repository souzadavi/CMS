<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Website details
| These details are used in Poker
|--------------------------------------------------------------------------
*/

// MODULOS E PERMISSOES
$config['poker'] = '34';
$config['poker_torneio_novo'] = '35';
$config['poker_torneio_detalhes'] = '36';
$config['poker_torneio_inserir_jogador'] = '37';
//$config['portfolio_categoria'] = '28';
//$config['portfolio_categoria_editar'] = '29';
//$config['portfolio_novo'] = '30';

/// UPLOAD DA IMAGEM DO BANNER DO POKER
$config['poker_allowed_types'] ="jpg|gif|png";
$config['poker_max_size'] = "4000";
$config['poker_max_width'] = "2000";
$config['poker_max_height'] = "2000";

//UPLOAD PORTFOLIO
$config['path_upload_poker'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/upload/poker/";

// MENSAGEM ERROS
$config['folder_no_existe'] = 'Pasta não existente no servidor ou ser permissão ';

/* End of file cms.php */
/* Location: ./application/config/poker.php */