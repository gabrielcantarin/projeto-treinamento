<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




$route['media/(:any)'] = 'Media/resize/$1';


$route['login'] = 'Usuario/login';
$route['register'] = 'Usuario/register';
$route['forget'] = 'Usuario/forget';
$route['logout'] = 'Usuario/logout';
$route['confirmation/(:any)'] = 'Usuario/confirmation/$1';

$route['timeline'] = 'Post/index';
$route['timeline/(:any)'] = 'Post/index/$1';
$route['post/(:any)'] = 'Post/getPost/$1';
$route['wave/(:any)'] = 'Post/wave/$1';

$route['follow/(:any)'] = 'Follow/followUser/$1';
$route['unfollow/(:any)'] = 'Follow/unfollowUser/$1';

$route['list-follow'] = 'Follow/listFollow';
$route['list-followed'] = 'Follow/listFollowed';

$route['config'] = 'Config/index';
$route['profile-photo'] = 'Config/profilePhoto';
$route['cover-photo'] = 'Config/coverPhoto';
$route['deactivate-account'] = 'Config/deactivateAccount';
$route['localization'] = 'Config/localization';

$route['like/(:any)'] = 'Like/likePost/$1';
$route['unlike/(:any)'] = 'Like/unlikePost/$1';

$route['(:any)/follow'] = 'Follow/listFollow/$1';
$route['(:any)/followed'] = 'Follow/listFollowed/$1';

$route['(:any)'] = 'Usuario/profile/$1';








