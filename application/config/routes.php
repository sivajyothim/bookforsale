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
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup']='Welcome/signup';
$route['login']='Welcome/signup';

/*
admin routes start here
*/
$route['master/login']='master/Welcome/login';
$route['master/logout']='master/Welcome/logout';

/*
admin routes end here
*/

/*User module section code start */
$route['profile']='User';
$route['logout']='User/logout';
$route['changepassword']='User/changepassword';
$route['orders']='Orders';
$route['orderdetails/(:any)/(:any)']='Orders/orderdetails';
$route['transactions']='Orders/transactions';
$route['bookingorders']='Orders/sellerOrders';

/*User module section code end */

/*Books module section code start */
$route['addnewbook']='User/addnewbook';
$route['managebooks']='User/managebooks';
$route['editbook/(:any)/(:any)']='User/editBook';


/*Books module section code end */


/*Front Books realated routes section */
$route['menu/(:any)/(:any)']='Frontbooks/menurelatedBooks/$1/$2';
$route['submenu/(:any)/(:any)']='Frontbooks/submenurelatedBooks/$1/$2';
$route['search/(:any)']='Frontbooks/searchbooks/$1';
/*Front Books realated routes section end*/
$route['addtocart']='Cart/addToCart';
$route['checkout']='Cart/cartitems';
$route['shipping']='Cart/shippingDetails';
$route['details/(:any)/(:any)']='Frontbooks/bookdetails/$1/$2';

$route['clearcart']='Cart/deleteCart';
$route['deletecart/(:any)']='Cart/deletecartitem/$1';

/*CMS pages */
$route['contactus']='Cms/contactus';
$route['aboutus']='Cms/aboutus';
$route['terms']='Cms/terms';
$route['privacypolicy']='Cms/privacy';
$route['requestbook']='Cms/requestbook';
/*CMS pages emd*/
