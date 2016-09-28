<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
// FrontEnd
$route['404_override'] = 'frontend/show_404';

$route['default_controller'] = 'frontend/index';
$route['home'] = 'frontend/index';
$route['about'] = 'frontend/about';

$route['rooms-and-reservations'] = 'frontend/reservation';
$route['rooms-and-reservations/check'] = 'frontend/checkReservation';
$route['rooms-and-reservations/checkout'] = 'frontend/makeReservation';
$route['rooms-and-reservations/process'] = 'frontend/checkoutReservation';

$route['rooms-and-reservations/process/success'] = 'frontend/paymentSuccess';

$route['rooms-and-reservations/process/cancel'] = 'frontend/paymentCancel';

$route['rooms-and-reservations/process/notify'] = 'frontend/paymentIPN';

$route['rooms-and-reservations/payment'] = 'frontend/paymentStatus';


$route['transportation-service'] = 'frontend/transportation';
$route['transportation-service/check'] = 'frontend/checkTransportation';
$route['transportation-service/checkout'] = 'frontend/checkoutTransportation';


$route['vehicle-parking'] = 'frontend/parking';
$route['booking'] = 'frontend/booking';
$route['booking/(:any)'] = 'frontend/booking/$1';
$route['gym-and-fitness'] = 'frontend/gym';
$route['event-hall'] = 'frontend/hall';
$route['restaurant-and-menu'] = 'frontend/restaurant';
$route['restaurant-and-menu/check'] = 'frontend/checkRestaurant';
$route['restaurant-and-menu/book'] = 'frontend/bookRestaurant';
$route['restaurant-and-menu/book/confirm'] = 'frontend/confirmBookingRestaurant';
$route['laundry-service'] = 'frontend/laundry';
$route['contact'] = 'frontend/contact';

$route['register'] = 'frontend/register';

$route['my-account'] = 'frontend/dashboard';
$route['my-account/(:any)'] = 'frontend/dashboard';

//Common
$route['login'] = 'login/index';
$route['login/success'] = 'login/success';
$route['logout'] = 'login/logout';

//Backend
$route['dashboard'] = "welcome";
$route['admin'] = 'welcome';
$route['migrate'] = 'migration';
$route['room-type'] = "room_type";
$route['room-type/(:any)'] = "room_type/$1";
$route['company'] = 'company';


/* End of file routes.php */
/* Location: ./application/config/routes.php */