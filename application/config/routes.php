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
$route['default_controller'] = 'welcome';
//$route['usadmin'] = 'welcome';
/**
 * ADMIN PANEL
 */
// Login
$route['usadmin/login'] = 'admin/login/index';
$route['usadmin/logout'] = 'admin/logout';

// Profile
$route['usadmin/profile'] = 'admin/profile/index';

// Dashboard
$route['usadmin'] = 'admin/dashboard';
$route['usadmin/dashboard'] = 'admin/dashboard';

// Users
$route['usadmin/users'] = 'admin/users/list_users';
$route['usadmin/users/add'] = 'admin/users/add_user';
$route['usadmin/users/edit/(:num)'] = 'admin/users/edit_user/$1';
$route['usadmin/users/view/(:num)'] = 'admin/users/view_user/$1';
$route['usadmin/users/delete'] = 'admin/users/delete_user';
$route['usadmin/child/view/(:num)'] = 'admin/users/view_child/$1';
$route['usadmin/child/add/(:num)'] = 'admin/users/add_child/$1';
$route['usadmin/child/edit/(:num)'] = 'admin/users/edit_child/$1';
$route['usadmin/child/delete'] = 'admin/users/delete_child';

// Age Group
$route['usadmin/age-groups'] = 'admin/age_groups/list_age_groups';
$route['usadmin/age-groups/add'] = 'admin/age_groups/add_age_group';
$route['usadmin/age-groups/delete'] = 'admin/age_groups/delete_age_group';
$route['usadmin/age-groups/edit/(:num)'] = 'admin/age_groups/edit_age_group/$1';

// Subscription Plan
$route['usadmin/subscription'] = 'admin/subscription/list_subscription_plans';
$route['usadmin/subscription/add'] = 'admin/subscription/add_subscription';
$route['usadmin/subscription/save'] = 'admin/subscription/save_subscription';
$route['usadmin/subscription/edit/(:num)'] = 'admin/subscription/edit_subscription/$1';
$route['usadmin/subscription/update/(:num)'] = 'admin/subscription/update_subscription/$1';
$route['usadmin/subscription/delete/(:num)'] = 'admin/subscription/delete_subscription/$1';

// Sections
$route['usadmin/section'] = 'admin/section/list_section';
$route['usadmin/section/add'] = 'admin/section/add_section';
$route['usadmin/section/edit/(:num)'] = 'admin/section/edit_section/$1';
$route['usadmin/section/delete'] = 'admin/section/delete_section';

// Categories
$route['usadmin/categories'] = 'admin/categories/list_categories';
$route['usadmin/categories/add'] = 'admin/categories/add_category';
$route['usadmin/categories/edit/(:num)'] = 'admin/categories/edit_category/$1';
$route['usadmin/categories/delete'] = 'admin/categories/delete_category';

// Error
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
