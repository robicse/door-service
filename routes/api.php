<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/checkout/ssl/pay', 'API\PublicSslCommerzPaymentController@index');
Route::POST('/success', 'API\PublicSslCommerzPaymentController@success');
Route::POST('/fail', 'API\PublicSslCommerzPaymentController@fail');
Route::POST('/cancel', 'API\PublicSslCommerzPaymentController@cancel');
Route::POST('/ipn', 'API\PublicSslCommerzPaymentController@ipn');
Route::get('/ssl/redirect/{status}','API\PublicSslCommerzPaymentController@status');
Route::get('/web/payment/{status}','API\PublicSslCommerzPaymentController@statusWeb');

Route::post('login', 'Api\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('otp', 'API\UserController@otp');
Route::post('getotpCode', 'API\UserController@getotpCode');
Route::post('reset/password', 'API\UserController@reset_pass_check_mobile');
Route::post('reset/password/confirmation', 'API\UserController@check_verification');
Route::middleware('auth:api')->post('/user/profile/update', 'API\UserController@profile_edit');
Route::middleware('auth:api')->post('/user/profile/update/image', 'API\UserController@pro_pic');
Route::middleware('auth:api')->post('/user/order/request/submit', 'API\UserController@order_submit');
Route::middleware('auth:api')->post('/user/order/grand-total/change', 'API\UserController@grand_total_change');
Route::middleware('auth:api')->get('/user/order/request/get/all', 'API\UserController@order_get_all');
Route::middleware('auth:api')->post('/user/order/request/get/details', 'API\UserController@order_details');
Route::middleware('auth:api')->post('/user/order/request/list/vendor/details', 'API\UserController@order_vendor');
Route::middleware('auth:api')->post('/user/order/book', 'API\UserController@book_order');
Route::middleware('auth:api')->post('/user/order/review', 'API\UserController@reviewStore');
Route::middleware('auth:api')->post('/user/vendor/average/rating', 'API\UserController@vendor_average_rating');

//Route::middleware('auth:api')->post('/user/order/again/request/submit', 'API\UserController@order_again_request_submit');
Route::post('/user/order/again/request/submit', 'API\UserController@order_again_request_submit');
Route::post('/user/order/all/vendor/request/count', 'API\UserController@order_all_vendor_request_count');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/order/coupon', 'API\UserController@coupon');
route::get('/category','Api\Frontend\CategoryController@category');
route::get('/home-category','Api\Frontend\CategoryController@categoryHome');
route::get('/subCategory','Api\Frontend\CategoryController@subCategory');
route::get('/category/subcategory/service/all','Api\Frontend\CategoryController@categorySubcategoryService');
route::post('/get-subcategory','Api\Frontend\CategoryController@categoryFind');
route::post('/category-add','Api\Frontend\CategoryController@categoryAdd');
route::get('/search/all/services','Api\Frontend\CategoryController@allService');

route::post('/service','Api\Frontend\ServiceController@service');
route::post('/service-details','Api\Frontend\ServiceController@details');
route::post('/service-question-find','Api\Frontend\ServiceController@questionFind');
route::post('/career/store','Api\Frontend\CareerController@CareerStore');
route::post('/service-order','Api\Frontend\ServiceController@order');
route::get('/get/twelve/service','Api\Frontend\ServiceController@get12Services');
route::post('/vendor-location-checker','Api\Frontend\LocationManageController@VendorLocationChecker');

route::get('/all-blog','Api\Frontend\BlogController@allBlog');
route::post('/category-all-blog','Api\Frontend\BlogController@categoryAllBlog');
route::post('/blog-details','Api\Frontend\BlogController@blogDetails');
route::get('/all-career','Api\Frontend\CareerController@careerList');

//pages
route::get('/pages/{type}','Api\Frontend\PageController@pages');

//question option and price
route::post('/service-wise-question-option','Api\Frontend\QuestionOptionController@serviceWiseQuestionOption');


//Category wise service
route::get('/service-by-category/{id}','Api\Frontend\ServiceController@serviceByCategory');
route::get('/service-filter/{type}','Api\Frontend\ServiceController@serviceFilter');



// apps start
Route::post('login-app', 'Api\UserController@loginApp');
Route::post('register-app', 'Api\UserController@registerApp');
Route::post('otp-resend', 'Api\UserController@otpResend');
Route::post('reset-pass-check-mobile-app', 'Api\UserController@reset_pass_check_mobile_app');
Route::post('changed-pass-check-mobile-app', 'Api\UserController@changed_pass_check_mobile_app');
Route::post('user-switch-vendor', 'Api\UserController@SwitchToVendor' );
Route::middleware('auth:api')->post('/user/order/request/submit-app', 'API\UserController@order_submit_app');
//Route::middleware('auth:api')->post('/user/profile/image/update', 'API\UserController@userImageUpload');
Route::post('/user/profile/image/update', 'Api\UserController@userImageUpload');
Route::post('/user/firebase/token/update', 'Api\UserController@userFbTokenUpdate');
Route::post('/user/profile/update-app', 'Api\UserController@profile_update');
Route::get('/user/order/list/{id}', 'Api\Frontend\OrderController@userOrderList');
Route::get('/user/order/ongoing-list/{id}', 'Api\Frontend\OrderController@userOrderOngoingList');
Route::get('/user/order/detail/list/{id}', 'Api\Frontend\OrderController@userOrderDetailList');
//Route::post('/common/category/services', 'API\UserController@profile_update');
route::get('/categories-app','Api\Frontend\CategoryController@category_list_app');
route::post('/contact-submit-app','Api\Frontend\PageController@contactSubmit');

route::get('/chat-id/order_id={order_id}/vendor_id={vendor_id}','Api\Frontend\OrderController@getChatId');
route::get('/user/order/request/vendor/list/{order_id}','Api\OrderController@userOrderRequestVendorList');
Route::post('/vendor/request/order/payment/{id}','Api\OrderController@orderPayment');

route::get('/sliders','Api\Frontend\PageController@sliderList');


//Vendor Backend
//Route::middleware('auth:api')->group(function () {
route::get('vendor/dashboard/vendor_id={vendor_id}','Api\Vendor\VendorController@dashboard');
route::get('vendor/ongoing-requested-order/list/{id}','Api\Vendor\OrderController@ongoingOrderList');
route::get('vendor/completed-requested-order/list/{id}','Api\Vendor\OrderController@completedOrderList');
route::get('vendor/delivery-status/list','Api\Vendor\OrderController@deliveryStatusList');
route::post('vendor/delivery-status/update','Api\Vendor\OrderController@deliveryStatusUpdate');
route::post('vendor/order-accept/order_id={order_id}/vendor_id={vendor_id}','Api\Vendor\OrderController@orderAccept');
route::get('vendor/review/vendor_id={vendor_id}','Api\Vendor\VendorController@review');
route::get('vendor/withdraw-request/history/vendor_id={vendor_id}','Api\Vendor\VendorController@withdrwRequestHistory');
route::post('vendor/withdraw-request/vendor_id={vendor_id}','Api\Vendor\VendorController@withdrwRequest');
route::post('vendor/personal-info/update/vendor_id={vendor_id}','Api\Vendor\VendorController@personalInfoUpdate');
route::post('vendor/document-image/update/vendor_id={vendor_id}','Api\Vendor\VendorController@documentUpdate');
route::get('vendor/document-image/delete/image_id={image_id}','Api\Vendor\VendorController@documentDelete');
route::get('vendor/get-service-info/vendor_id={vendor_id}','Api\Vendor\VendorController@getserviceInfo');
route::post('vendor/service-info/create/vendor_id={vendor_id}','Api\Vendor\VendorController@serviceInfoCreate');
route::post('vendor/service-info/update/vendor_id={id}','Api\Vendor\VendorController@serviceInfoUpdate');
route::post('vendor/business-info/update/vendor_id={id}','Api\Vendor\VendorController@businessInfoUpdate');
route::get('vendor/get-business-info/vendor_id={id}','Api\Vendor\VendorController@getBusinessInfo');

route::get('vendor/is_profile_complete/vendor_id={id}','Api\Vendor\VendorController@is_profile_complete');
route::post('/password-check','Api\UserController@passwordCheck');

route::get('/all-categories','Api\Frontend\CategoryController@getCategories');
route::get('/sub-categories/{id}','Api\Frontend\CategoryController@getSubcategories');
route::get('/service/{id}','Api\Frontend\CategoryController@getService');
route::post('/search/service','Api\Frontend\ServiceController@searchServices');
route::post('/notification/submit','Api\Frontend\NotificationController@notificationSubmit');
route::get('/notification/{id}','Api\Frontend\NotificationController@notificationList');
route::get('/notification/notification_id={id}','Api\Frontend\NotificationController@notificationStatus');







//});
// apps end
