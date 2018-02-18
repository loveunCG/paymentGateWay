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

$route['default_controller'] = "intro";
//$route['default_controller'] = "admin/administrator";

//$route['admin/general_settings'] = "admin/settings/general_settings";
//$route['default_controller']= "admin/settings/general_settings";
//$route['session.html/(:any)']= "admin/session/manage_session/$1";
//$route['session.html']= "admin/session/manage_session";
$route['agentlogin'] = "agentlogin/index";
$route['intro'] = "intro/index";
//$route['product_catalog'] = "intro/product_catalog";
$route['catalog_1'] = "intro/product_catalog/1";
$route['catalog_2'] = "intro/product_catalog/2";
$route['catalog_3'] = "intro/product_catalog/3";
//$route['product_catalog/(:any)'] = "intro/product_catalog/1";
$route['business_1'] = "intro/business_access/1";
$route['business_2'] = "intro/business_access/2";
$route['business_3'] = "intro/business_access/3";
$route['business_4'] = "intro/business_access/4";
$route['business_5'] = "intro/business_access/5";
$route['about_1'] = "intro/about_us/1";
$route['about_2'] = "intro/about_us/2";
$route['about_3'] = "intro/about_us/3";
$route['contact_1'] = "intro/contact_us/1";
$route['flogin'] = "login";
$route['signup'] = "register";
$route['verify_val'] = "flogin/verify_val";
$route['botdetect/captcha-handler'] = 'botdetect/captcha_handler/index';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
