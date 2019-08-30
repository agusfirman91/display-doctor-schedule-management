<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['main/doctor-of-duty'] = 'main/duty_doctor';
$route['main/specialist-doctor'] = 'main/specialist_doctor';
$route['main/doctor-of-duty'] = 'main/duty_doctor';
$route['main/pic-nurse'] = 'main/pic_nurse';
$route['main/nurse-of-duty'] = 'main/nurse_of_duty';
$route['main/doctor-of-duty'] = 'main/duty_doctor';
$route['main/doctor-room'] = 'main/doctor_room';
$route['main/doctor-schedule'] = 'main/doctor_schedule';
$route['main/image-slide'] = 'main/image_slide';
$route['main/display-management'] = 'main/display_management';
$route['main/jam-besuk'] = 'main/jam_besuk';
$route['main/nurse-spv'] = 'main/nurse_spv';
$route['main/change-password'] = 'main/change_password';
$route['main/access-permission'] = 'main/access_permission';
$route['main/add-access-permission'] = 'main/access_permission_add';
$route['main/edit-access-permission/(:num)'] = 'main/access_permission_edit/$1';
$route['display/(:any)'] = 'display/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
