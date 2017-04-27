<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;





$route['login'] = 'Usuario/login';
$route['register'] = 'Usuario/register';
$route['forget'] = 'Usuario/forget';
$route['logout'] = 'Usuario/logout';

$route['timeline'] = 'Post/index';
$route['timeline/(:any)'] = 'Post/index/$1';

$route['follow/(:any)'] = 'Follow/followUser/$1';
$route['unfollow/(:any)'] = 'Follow/unfollowUser/$1';

$route['list-follow'] = 'Follow/listFollow';
$route['list-followed'] = 'Follow/listFollowed';

$route['config'] = 'Config/index';
$route['profile-photo'] = 'Config/profilePhoto';
$route['cover-photo'] = 'Config/coverPhoto';
$route['deactivate-account'] = 'Config/deactivateAccount';

$route['(:any)/follow'] = 'Follow/listFollow/$1';
$route['(:any)/followed'] = 'Follow/listFollowed/$1';

$route['(:any)'] = 'Usuario/profile/$1';








