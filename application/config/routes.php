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
$route['default_controller'] = 'Welcome/index';
$route['Web/Web'] = 'Web/index';
$route['Web/affiliate'] = 'Web/affiliate';
$route['Web/affiliate-signup/(:any)'] = 'Web/affiliate_register/$1';
$route['Web/affiliate-signup'] = 'Web/affiliate_register';
$route['Web/affiliate-login'] = 'Web/affiliate_login';
$route['payment-method'] = 'Web/payment_method';
$route['bank-wire-payment'] = 'Web/bankWirePayment';
$route['login'] = 'Web/login';
$route['ewallet-payment'] = 'Web/ewallet_payment';
$route['listaschool'] = 'Web/listaschool';
$route['listaschool/(:any)'] = 'Web/listaschool/$1';
$route['shopcart'] = 'Web/shopcart';
$route['checkout'] = 'Web/checkout';
/*$route['product'] = 'Web/product';*/
$route['shop'] = 'Web/shop';
$route['services'] = 'Web/services';

$route['about-us'] = 'Web/aboutUs';
$route['send-email'] = 'Web/send_email';
$route['contact-us'] = 'Web/contactUs';
$route['products'] = 'Web/productlist';
$route['product/(:any)'] = 'Web/singleproduct/$1';
$route['productlist/(:any)'] = 'Web/productlist/$1';
$route['servicelist/(:any)'] = 'Web/servicelist/$1';
$route['service/(:any)'] = 'Web/serviceproduct/$1';
$route['join-us'] = 'Web/register';
$route['join-us/(:any)'] = 'Web/register/$1';
$route['i3-empire-launches-new-wellness-program'] = 'Web/WelnessProgram';
$route['community-spotlight'] = 'Web/communitySpotlight';
$route['i3-empires-commitment-to-sustainability'] = 'Web/sustainability';
$route['unlocking-financial-freedom-with-i3-empire'] = 'Web/FinancialFreedom';
$route['dashboard'] = 'Web/dashboard';
$route['google_meet'] = 'Web/googlemeet';
$route['payments'] = 'Web/payments';
$route['orders'] = 'Web/orders';
$route['expertbooking'] = 'Web/expertbooking';
$route['profile'] = 'Web/profile';
$route['sessions'] = 'Web/sessions';
$route['experts'] = 'Web/experts';
$route['addmoney'] = 'Web/addmoney';
$route['product_add'] = 'Web/product_add';
$route['product_store'] = 'Web/product_store';
$route['webgooglemeet/index_google'] = 'Web/index_google';
$route['meetvideo'] = 'Web/meetvideo';
$route['expert/approve/(:any)'] = 'Web/approve/$1';
$route['meetvideo/(:any)'] = 'Web/room/$1';
$route['webgooglemeet/callback'] = 'Web/callback';
$route['webgooglemeet/createMeeting/(:any)'] = 'Web/createMeeting/$1';
$route['location/get_states'] = 'Web/get_states';
$route['location/get_cities'] = 'Web/get_cities';
$route['calendar/save_event'] = 'Web/save_event';
$route['calendar/fetch_events'] = 'Web/fetch_events';
$route['calendar/customer_calendar_events'] = 'Web/customer_calendar_events';
$route['meeting/send_request'] = 'Web/send_request';
$route['meeting/reject/(:num)'] = 'Web/meeting_reject/$1';

$route['calendar/get_event/(:num)'] = 'Web/get_event/$1';
$route['calendar/delete_event/(:num)'] = 'Web/delete_event/$1';
$route['calendar/get_expert_events/(:num)'] = 'Web/get_expert_events/$1';
$route['calendar/book_event'] = 'Web/book_event';
$route['calendar/cancel_booking'] = 'Web/cancel_booking';
$route['paypal/create_order'] = 'Web/create_order';
$route['paypal/capture_order/(:any)'] = 'Web/capture_order/$1';

$route['invoice'] = 'Web/invoice';
$route['logout'] = 'Web/logout';
$route['Affiliate'] = 'Affiliate/index';
$route['Admin'] = 'Admin/index';
$route['company'] = 'company/index';
$route['company/save'] = 'company/save';
$route['googlemeet'] = 'GoogleMeet/index';
$route['googlemeet/callback'] = 'GoogleMeet/callback';
$route['googlemeet/createMeeting'] = 'GoogleMeet/createMeeting';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

