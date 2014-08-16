<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['404_override'] = '';

$route['^tr/detay-(.+)$'] = 'offers/detail/$1';
$route['^en/detay-(.+)$'] = 'offers/detail/$1';
$route['^tr/detail-(.+)$']  = 'offers/detail/$1';
$route['^en/detail-(.+)$']  = 'offers/detail/$1';

$route['^tr/seyahat-(.+)$'] = 'offers/detailSearch/$1';
$route['^en/seyahat-(.+)$'] = 'offers/detailSearch/$1';
$route['^tr/travel-(.+)$']  = 'offers/detailSearch/$1';
$route['^en/travel-(.+)$']  = 'offers/detailSearch/$1';

$route['^tr/ara-seyahat-sonuc$']    = 'offers/search/$1';
$route['^en/ara-seyahat-sonuc$']    = 'offers/search/$1';
$route['^tr/search-travel-result$'] = 'offers/search/$1';
$route['^en/search-travel-result$'] = 'offers/search/$1';

$route['^tr/ara-seyahat$']    = 'main/offers/$1';
$route['^en/ara-seyahat$']    = 'main/offers/$1';
$route['^tr/search-travel$']  = 'main/offers/$1';
$route['^en/search-travel$']  = 'main/offers/$1';


// URI like '/en/about' -> use controller 'about'
$route['^tr/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
 
// '/en' and '/fr' URIs -> use default controller
$route['^tr$'] = $route['default_controller'];
$route['^en$'] = $route['default_controller'];




