<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

$route['default_controller'] 			= 'main';
$route['404_override'] 					= 'page/main';

/* Administration */
$route['admin/(login|logout)']			= 'admin/gateway/$1';
$route['admin/([^/]+)/(:any)']			= '$1/admin/$2';
$route['admin/([^/]+)/?']				= '$1/admin';

$route['admin']							= 'admin';