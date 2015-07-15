<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "admin_hepgezelim";
$route['404_override'] = '';
 


// URI like '/en/about' -> use controller 'about'
$route['^tr/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
 
// '/en' and '/fr' URIs -> use default controller
$route['^tr$'] = $route['default_controller'];
$route['^en$'] = $route['default_controller'];




