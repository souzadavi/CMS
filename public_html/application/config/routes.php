<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';


// CMS
$route['cms'] = "cms/home";
$route[$this->config->item('base_cms').'inicial'] = $this->config->item('base_cms')."home";

//$route['labmin/auth/logout'] = "auth/logout";
/*
$route[$this->config->item('base_cms').'curriculos/page/:num'] = $this->config->item('base_cms')."curriculos/index/page/$1";
$route[$this->config->item('base_cms').'contato/page/:num'] = "labmin/contato/index/page/$1";
$route[$this->config->item('base_cms').'newsletter/page/:num'] = $this->config->item('base_cms')."newsletter/index/page/$1";

$route[$this->config->item('base_cms').'noticias'] = $this->config->item('base_cms')."noticia";

//$route['labmin/curriculos/:any/:any/:any/page/'] = "labmin/curriculos/index/page/test/teste/teste/test";
$route[$this->config->item('base_cms').'curriculos/page'] = $this->config->item('base_cms')."curriculos/index/page";
$route[$this->config->item('base_cms').'contato/page'] = $this->config->item('base_cms')."contato/index/page";
$route[$this->config->item('base_cms').'newsletter/page'] = $this->config->item('base_cms')."newsletter/index/page";
//$route['labmin/curriculos/busca/:any/:any/page/(:num)'] = "labmin/curriculos/index/busca/$1/$2/page/$3";
$route[$this->config->item('base_cms').'curriculos/deletar/(:num)'] = $this->config->item('base_cms')."curriculos/deletar/$1";
$route[$this->config->item('base_cms').'curriculos/detalhes/(:num)'] = $this->config->item('base_cms')."curriculos/detalhes/$1";

$route[$this->config->item('base_cms').'galeria/(:num)'] = $this->config->item('base_cms')."galeria/index/$1";
*/
//$route[$this->config->item('base_cms').'youtube/(:any)'] = $this->config->item('base_cms')."youtube/index/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */