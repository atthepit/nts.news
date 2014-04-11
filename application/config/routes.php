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

$route['default_controller'] = "front/noticias";
$route['404_override'] = '';

/*FRONT*/
$route[''] = 'noticias/index';
$route['noticias'] = 'front/noticias/index';
$route['noticia/(:num)'] = 'front/noticias/noticia_por_id/$1';
$route['noticia/(:any)'] = 'front/noticias/noticia/$1';
$route['noticias/(:any)'] = 'front/noticias/categoria/$1';

/* CMS */
$route['cms'] = 'cms/noticias/index';
$route['cms/noticias'] = 'cms/noticias';
$route['cms/noticias/nueva'] = 'cms/noticias/nueva';
$route['cms/noticia/(:num)/edit'] = 'cms/noticias/editar/$1';
$route['cms/noticia/(:num)/delete'] = 'cms/noticias/editar/$1';
$route['cms/categorias'] = 'cms/categorias';
$route['cms/categorias/nueva'] = 'cms/categorias/nueva';
$route['cms/categoria/(:num)/edit'] = 'cms/categorias/editar/$1';
$route['cms/categoria/(:num)/delete'] = 'cms/categorias/eliminar/$1';
$route['cms/session/login'] = 'cms/session/login';
$route['cms/session/logout'] = 'cms/session/logout';



/* End of file routes.php */
/* Location: ./application/config/routes.php */