<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| ------------------------- URI ROUTING COMMON ---------------------------
| -------------------------------------------------------------------------
*/

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dang-nhap.html'] = 'CommonController/Login/index';
$route['login'] = 'CommonController/Login/login';

$route['dang-xuat.html'] = 'CommonController/Login/logout';

$route['dang-ky.html'] = 'CommonController/Register/index';
$route['register'] = 'CommonController/Register/register';

$route['404'] = 'CommonController/Common/error404';
$route['500'] = 'CommonController/Common/error500';

/*
| -------------------------------------------------------------------------
| ----------------------- START URI ROUTING USER --------------------------
*/

$route['trang-chu.html'] = 'UserController/Home/index';
$route['subscribe'] = 'UserController/Home/subscribe';

$route['the-loai/(:num)'] = 'UserController/Category/index';
$route['the-loai/(:num)/(:num)'] = 'UserController/Category/index';

$route['loai-tin/(:num)'] = 'UserController/Type/index';
$route['loai-tin/(:num)/(:num)'] = 'UserController/Type/index';

$route['bai-viet/(:num)'] = 'UserController/Posts/index';
$route['send-comment-post'] = 'UserController/Posts/comment';

$route['nhan-su.html'] = 'UserController/Employee/index';

$route['lien-he.html'] = 'UserController/Contact/index';

$route['seach-home-user/(:any)'] = 'UserController/Search/index';
$route['seach-home-user/(:any)/(:num)'] = 'UserController/Search/index';

$route['tai-khoan.html'] = 'UserController/Profile/index';
$route['user/update/account'] = 'UserController/Profile/edit';

/*
| ----------------------- END URI ROUTING ADMIN ---------------------------
| -------------------------------------------------------------------------
*/

/*
| -------------------------------------------------------------------------
| ----------------------- START URI ROUTING ADMIN -------------------------
*/

$route['admin/home'] = 'AdminController/Home/index';
$route['admin/dashboard/edit/(:any)'] = 'AdminController/Home/download';

$route['admin/user/list'] = 'AdminController/User/list';
$route['admin/user/add'] = 'AdminController/User/add';
$route['admin/user/create'] = 'AdminController/User/create';
$route['admin/user/edit/(:num)'] = 'AdminController/User/edit';
$route['admin/user/update'] = 'AdminController/User/update';
$route['admin/user/role/(:num)/(:any)'] = 'AdminController/User/role';
$route['admin/user/editRoleNumber/(:num)'] = 'AdminController/User/editRoleNumber';
$route['admin/user/updateRoleNumber'] = 'AdminController/User/updateRoleNumber';
$route['admin/user/editRoleName/(:num)'] = 'AdminController/User/editRoleName';
$route['admin/user/updateRoleName'] = 'AdminController/User/updateRoleName';
$route['admin/user/delete/(:num)'] = 'AdminController/User/delete';

$route['admin/category/list'] = 'AdminController/Category/list';
$route['admin/category/add'] = 'AdminController/Category/add';
$route['admin/category/create'] = 'AdminController/Category/create';
$route['admin/category/edit/(:num)'] = 'AdminController/Category/edit';
$route['admin/category/update'] = 'AdminController/Category/update';
$route['admin/category/delete/(:num)'] = 'AdminController/Category/delete';

$route['admin/type/list'] = 'AdminController/type/list';
$route['admin/type/add'] = 'AdminController/type/add';
$route['admin/type/create'] = 'AdminController/type/create';
$route['admin/type/edit/(:num)'] = 'AdminController/type/edit';
$route['admin/type/update'] = 'AdminController/type/update';
$route['admin/type/delete/(:num)'] = 'AdminController/type/delete';

$route['admin/post/list'] = 'AdminController/post/list';
$route['admin/post/add'] = 'AdminController/post/add';
$route['admin/post/create'] = 'AdminController/post/create';
$route['admin/post/edit/(:num)'] = 'AdminController/post/edit';
$route['admin/post/update'] = 'AdminController/post/update';
$route['admin/post/delete/(:num)'] = 'AdminController/post/delete';
$route['post/ajax/getTypesByCategory'] = 'AdminController/post/getTypesByCategory';

$route['admin/comment/edit/(:num)'] = 'AdminController/comment/edit';

$route['admin/position/list'] = 'AdminController/position/list';
$route['admin/position/update'] = 'AdminController/position/update';
$route['admin/position/delete/(:num)'] = 'AdminController/position/delete';

$route['admin/employee/list'] = 'AdminController/employee/list';
$route['admin/employee/add'] = 'AdminController/employee/add';
$route['admin/employee/create'] = 'AdminController/employee/create';
$route['admin/employee/edit/(:num)'] = 'AdminController/employee/edit';
$route['admin/employee/update'] = 'AdminController/employee/update';
$route['admin/employee/delete/(:num)'] = 'AdminController/employee/delete';

$route['admin/homepage/list'] = 'AdminController/homepage/list';
$route['admin/homepage/update'] = 'AdminController/homepage/update';

$route['admin/history/list'] = 'AdminController/history/list';
$route['admin/history/edit/(:num)'] = 'AdminController/history/edit';
$route['admin/history/update'] = 'AdminController/history/update';
$route['admin/history/delete/(:num)'] = 'AdminController/history/delete';

$route['admin/bin/list'] = 'AdminController/bin/list';
$route['admin/bin/edit/(:any)'] = 'AdminController/bin/edit';
$route['admin/bin/delete/(:any)'] = 'AdminController/bin/delete';

$route['admin/subscribe/list'] = 'AdminController/subscribe/list';
$route['admin/subscribe/edit/(:any)'] = 'AdminController/subscribe/edit';
$route['admin/subscribe/delete/(:any)'] = 'AdminController/subscribe/delete';

/*
| ----------------------- END URI ROUTING ADMIN ---------------------------
| -------------------------------------------------------------------------
*/