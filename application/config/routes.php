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

// Contents
$route['usadmin/content'] = 'admin/content/list_content';
$route['usadmin/content/add'] = 'admin/content/add_content';
$route['usadmin/content/edit/(:num)'] = 'admin/content/edit_content/$1';
$route['usadmin/content/delete/(:num)'] = 'admin/content/delete_content/$1';
$route['usadmin/content/get_categories_ajax'] = 'admin/content/get_categories_ajax';

// Error
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Prizes
$route['usadmin/prizes'] = 'admin/prizes/list_prizes';
$route['usadmin/prizes/add'] = 'admin/prizes/add_prize';
$route['usadmin/prizes/edit/(:num)'] = 'admin/prizes/edit_prize/$1';
$route['usadmin/prizes/delete'] = 'admin/prizes/delete_prize';

// Quiz
$route['usadmin/quiz'] = 'admin/quiz/list_quiz';
$route['usadmin/quiz/add'] = 'admin/quiz/add_quiz';
$route['usadmin/quiz/edit/(:num)'] = 'admin/quiz/edit_quiz/$1';
$route['usadmin/quiz/delete/(:num)'] = 'admin/quiz/delete_quiz/$1';
$route['usadmin/quiz/question/list/(:num)'] = 'admin/quiz/list_quiz_question/$1';
$route['usadmin/quiz/question/add/(:num)'] = 'admin/quiz/add_quiz_question/$1';
$route['usadmin/quiz/question/edit/(:num)/(:num)'] = 'admin/quiz/edit_quiz_question/$1/$2';
$route['usadmin/quiz/question/delete/(:num)/(:num)'] = 'admin/quiz/delete_question/$1/$2';

// Goals
$route['usadmin/goals'] = 'admin/goals/list_goals';
$route['usadmin/goals/add'] = 'admin/goals/add_goal';
$route['usadmin/goals/edit/(:num)'] = 'admin/goals/edit_goal/$1';
$route['usadmin/goals/delete'] = 'admin/goals/delete_goal';

// Settings
$route['usadmin/settings'] = 'admin/settings/view_settings';

// Front End

//Landing page

$route['default_controller'] = 'landing';

// Child Logout
$route['child/logout'] = 'child/child_logout';
// Change Child Mode
$route['dashboard/child_mode/update'] = 'dashboard/change_child_mode';

$route['section/(:any)'] = 'child/section/$1';

// Child Forgotpassword
$route['child_forgotpassword'] = 'forgot_password/child_forgotpassword';