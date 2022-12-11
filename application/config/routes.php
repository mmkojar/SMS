<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['users'] = 'auth';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['users/add'] = 'auth/create_user';
$route['profile/(:any)'] = 'auth/edit_user/$1';

$route['stocks'] = 'Stock/Listing';
$route['stocks/api'] = 'Stock/Listing/api';
$route['purchase'] = 'Stock/Purchase';
$route['purchase/add'] = 'Stock/Purchase/add';
$route['purchase/insert'] = 'Stock/Purchase/insert';
$route['purchase/vendorsApi'] = 'Stock/Purchase/VendorsApi';
$route['purchase/edit/(:any)'] = 'Stock/Purchase/edit/$1';
$route['purchase/delete/(:any)/(:any)/(:any)'] = 'Stock/Purchase/delete/$1/$2/$3';

$route['selling'] = 'Stock/Selling';
$route['selling/add'] = 'Stock/Selling/add';
$route['selling/insert'] = 'Stock/Selling/insert';
$route['selling/vapi'] = 'Stock/Selling/vendorsApi';
$route['selling/edit/(:any)'] = 'Stock/Selling/edit/$1';
$route['selling/delete/(:any)/(:any)/(:any)/(:any)'] = 'Stock/Selling/delete/$1/$2/$3/$4';

$route['instock'] = 'Stock/InStock';


$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
