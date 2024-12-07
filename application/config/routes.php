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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['auth_petugas'] = 'auth_petugas/index';
$route['auth_petugas/login'] = 'auth_petugas/login';
$route['auth_petugas/logout'] = 'auth_petugas/logout';
$route['auth_siswa'] = 'auth_siswa/index';
$route['auth_siswa/login'] = 'auth_siswa/login';
$route['auth_siswa/logout'] = 'auth_siswa/logout';
$route['guru/index'] = 'guru/index'; // Rute untuk halaman guru
$route['admin/index'] = 'admin/index'; // Rute untuk halaman admin
$route['siswa/index'] = 'siswa/index';
$route['pages/(:any)'] = 'pages/view/$1';
$route['pages2/(:any)'] = 'pages2/view/$1';
$route['pages3/(:any)'] = 'pages3/view/$1';
$route['pengaduan/updateStatus'] = 'pengaduan/updateStatus';
$route['default_controller'] = 'pertama'; // Halaman login sebagai default
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
