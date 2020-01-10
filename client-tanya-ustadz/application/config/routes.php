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
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['multi/daftar'] = 'multi/LoginController/register';
$route['multi/postRegister'] = 'multi/LoginController/postRegister';
$route['multi/masuk'] = 'multi/LoginController/index';
$route['multi/cekMasuk'] = 'multi/LoginController/setLogin';
$route['multi/keluar'] = 'multi/LoginController/setLogout';

$route['multi/beranda'] = 'multi/BerandaController/index';
$route['multi/beranda/search'] = 'multi/BerandaController/searchData';

$route['user/pertanyaan-saya'] = 'users/UsersController/index';
$route['user/post-my-question'] = 'users/UsersController/postMyQuestion';
$route['user/my-question'] = 'users/UsersController/getMyQuestion';
$route['user/delete-my-question/(:num)'] = 'users/UsersController/deleteMyQuestion/$1';
$route['user/belum-terjawab/(:num)'] = 'users/UsersController/similarMyQuestion/$1';
$route['user/sudah-terjawab/(:num)/(:num)'] = 'users/UsersController/similarMyQuestion/$1/$2';

$route['ustadz/pertanyaan-masuk'] = 'ustadz/UstadzController/index';
$route['ustadz/jawaban-saya/(:num)'] = 'ustadz/UstadzController/myAnswer/$1';
$route['ustadz/jawaban-saya/(:num)/(:num)'] = 'ustadz/UstadzController/myAnswer/$1/$2';
$route['ustadz/jawaban-saya'] = 'ustadz/UstadzController/myAnswer';
$route['ustadz/post-my-answer'] = 'ustadz/UstadzController/postMyAnswer';
$route['ustadz/put-my-answer'] = 'ustadz/UstadzController/putMyAnswer';
$route['ustadz/delete-my-answer/(:num)/(:num)'] = 'ustadz/UstadzController/deleteMyAnswer/$1/$2';
$route['ustadz/getQuestionEnteredById/(:num)'] = 'ustadz/UstadzController/getQuestionEnteredById/$1';
$route['ustadz/jawaban-saya/editorDetail/(:num)'] = 'ustadz/UstadzController/getDetailEditor/$1';

$route['editor/jawaban-siap-publis/(:num)'] = 'editors/EditorsController/index/$1';
$route['editor/jawaban-siap-publis'] = 'editors/EditorsController/index';
$route['editor/post-published-answer'] = 'editors/EditorsController/postPublishedAnswer';
$route['editor/put-published-answer'] = 'editors/EditorsController/putPublishedAnswer';
$route['editor/delete-published-answer/(:num)/(:num)/(:any)'] = 'editors/EditorsController/deletePublishedAnswer/$1/$2/$3';
$route['editor/jawaban-terpublis/(:num)'] = 'editors/EditorsController/getPublishedAnswers/$1';
$route['editor/jawaban-terpublis'] = 'editors/EditorsController/getPublishedAnswers';

$route['super/data-akun'] = 'super/SuperController/index';
$route['super/akun-nonaktif'] = 'super/SuperController/nonactiveAccount';
$route['super/postAccount'] = 'super/SuperController/postAccount';
$route['super/delete-akun/(:num)'] = 'super/SuperController/deleteAccount/$1';

$route['multi/single-post/(:num)'] = 'multi/BerandaController/getSinglePost/$1';
$route['multi/single-post/(:num)/(:num)'] = 'multi/BerandaController/getSinglePost/$1/$2';
$route['multi/single-post/detail-ustadz/(:num)'] = 'multi/BerandaController/getDetailUstadz/$1';