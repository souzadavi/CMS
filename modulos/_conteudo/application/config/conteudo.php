<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
| These details are used in Conteudo
|--------------------------------------------------------------------------
*/

// MODULOS E PERMISSOES
$config['conteudo'] = '1';

$config['conteudo_pagina'] = '2';
$config['conteudo_pagina_editar'] = '10';
$config['conteudo_pagina_novo'] = '';

$config['conteudo_noticia'] = '3';
$config['conteudo_noticia_novo'] = '';

/// UPLOAD DE CONTEUDO
$config['conteudo_path'] = $_SERVER['DOCUMENT_ROOT']."/produtoraweb/novo/upload/conteudo/";
$config['conteudo_allowed_types'] = 'jpg|jpeg|gif|png';
$config['conteudo_max_size'] = '2000';
$config['conteudo_max_width'] = '1800';
$config['conteudo_max_size'] = '2000';

// GALERIA DE IMAGENS ATIVADA
$config['conteudo_galeria_ativada'] = true;

/* End of file conteudo.php */
/* Location: ./application/config/conteudo.php */