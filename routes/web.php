<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/admin', 'Frontend\IndexController@login')->name('admin.login');
Route::get('/vendor-registration', 'Auth\VendorRegController@vendor_reg' )->name('vendor.reg');
Route::get('/vendor-login', 'Auth\VendorRegController@vendorLoginForm' )->name('vendor.login.form');
Route::post('/vendor-login', 'Auth\VendorRegController@vendorLogin' )->name('vendor.login');
Route::post('/vendor-bypass-login', 'Auth\VendorRegController@byPassLogin' )->name('vendor.login.bypass');
Route::post('/beeee-a-vendor', 'Auth\VendorRegController@baVendor' )->name('vendor.create.bypass');
Route::post('/switch-to-vendor', 'Auth\VendorRegController@SwitvhToVendor' );
Route::get('/vendor/switch/to/user', 'Auth\VendorRegController@VendorSwitchToUser' )->name('vendor.switch.to.user');
Route::post('/admin-login-check', 'Auth\VendorRegController@AdminLogin' )->name('admin.login.check');
Route::post('/vendor-reg-ac', 'Auth\VendorRegController@vendor_reg_store')->name('vendor.registration.store');
Route::get('/vendor/forget-password', 'Auth\VendorRegController@forgetPassForm')->name('vendor.forget.pass');
Route::post('/vendor/forget-password/check', 'Auth\VendorRegController@forgetPassCheck')->name('vendor.forget.pass.check');
Route::get('/vendor/forget-password/verify', 'Auth\VendorRegController@forgetPassVerifyForm')->name('vendor.forget.pass.verify.form');
Route::post('/vendor/forget-password/verify', 'Auth\VendorRegController@forgetPassVerify')->name('vendor.forget.pass.verify');
Route::post('/vendor/new-password/store', 'Auth\VendorRegController@newPassStore')->name('vendor.new.pass.store');
Route::get('/vendor/otp', 'Auth\VendorRegController@otpForm')->name('vendor.otp');

//verification check and otp send rorute
Route::get('/check-verification-code', 'Frontend\VerificationController@CheckVerificationCode')->name('check-verification-code');
Route::get('/get-verification-code/{id}', 'Frontend\VerificationController@getVerificationCode')->name('get-verification-code');
Route::post('/get-verification-code-store', 'Frontend\VerificationController@verification')->name('get-verification-code.store');


//super admin route group..
Route::group(['middleware'=>['auth','admin']], function (){

    Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin',], function (){
          Route::resource('services-category', 'ServiceCategoryController');
          Route::resource('services-sub-category', 'ServiceSubCategoryController');
          Route::resource('services-manage', 'ServiceManageController');
          Route::resource('services-question', 'ServiceQuestionController');
          Route::resource('coupon', 'CouponController');
          Route::resource('payment-history', 'PaymentHistoryController');
          Route::resource('vendor-review', 'VendorReviewController');
          Route::resource('blog', 'BlogController');
          Route::resource('career', 'CareerController');
          Route::resource('slider', 'SliderController');
   });


        Route::get('admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');
        Route::get('admin/vendorList', 'Admin\VendorListController@index')->name('admin.vendorList');
        Route::get('admin/vendorchangeStatus/{id}', 'Admin\VendorListController@changeStatus')->name('admin.vendorchangeStatus');
        Route::get('admin/vendorStatusActive', 'Admin\VendorListController@activeStatus')->name('admin.vendorStatusActive');
        Route::get('admin/vendorStatusInActive', 'Admin\VendorListController@inActiveStatus')->name('admin.vendorStatusInActive');
//        Route::get('admin/vendorStatusSuspent', 'Admin\VendorListController@StatusSuspent')->name('admin.vendorStatusSuspent');
         Route::get('admin/coupon/status/{id}','Admin\CouponController@status')->name('admin.coupon.status');
        Route::get('admin/userList', 'Admin\VendorListController@userList')->name('admin.userList');

    Route::get('/admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');

    //Commission
    Route::get('/admin/commission','Admin\CommissionController@create')->name('admin.commission');
    Route::post('/admin/commission/store','Admin\CommissionController@store')->name('admin.commission.store');

    Route::get('/admin/vendorList', 'Admin\VendorListController@index')->name('admin.vendorList');
    Route::get('/admin/vendor-status-change-pending/{id}', 'Admin\VendorListController@changeStatusPending')->name('admin.vendor-status-change-pending');
    Route::get('/admin/vendor-status-change-approved/{id}', 'Admin\VendorListController@changeStatusApproved')->name('admin.vendor-status-change-approved');
    Route::get('/admin/vendor-delete/{id}', 'Admin\VendorListController@vendorDelete');
    Route::get('/admin/vendorStatusActive', 'Admin\VendorListController@activeStatus')->name('admin.vendorStatusActive');
    Route::get('/admin/vendorStatusInActive', 'Admin\VendorListController@inActiveStatus')->name('admin.vendorStatusInActive');
    Route::get('/admin/vendor/details/{id}', 'Admin\VendorListController@vendorDetails')->name('admin.vendor.details');

    Route::get('/admin/services-manage/ajax/{id}','Admin\ServiceManageController@ajaxSubCat')->name('admin.services.get.subcategory');
    Route::get('/admin/userList', 'Admin\VendorListController@userList')->name('admin.userList');
    Route::get('/admin/service-question/add/{id}', 'Admin\ServiceQuestionController@add')->name('admin.services-question.add');
    Route::get('/admin/service-question/list/{id}', 'Admin\ServiceQuestionController@list')->name('admin.services-question.list');
    Route::get('/admin/service-wise-question/list/{id}', 'Admin\ServiceQuestionController@serviceWiseQuestionList')->name('admin.services-wise-question.list');
    Route::get('/admin/service-wise-question/delete/{id}', 'Admin\ServiceQuestionController@serviceWiseQuestionDelete')->name('admin.services-wise-question.delete');
    Route::post('/admin/question-wise-option-store', 'Admin\ServiceQuestionOptionController@questionWiseOptionStore')->name('admin.question-wise-option.store');
    Route::post('/admin/question-option-updated', 'Admin\ServiceQuestionOptionController@questionOptionUpdate')->name('admin.question-option-update');

    //performance
    Route::get('/admin/config-cache', 'Admin\ArtisanController@ConfigCache')->name('admin.config.cache');
    Route::get('/admin/clear-cache', 'Admin\ArtisanController@CacheClear')->name('admin.cache.clear');
    Route::get('/admin/view-cache', 'Admin\ArtisanController@ViewCache')->name('admin.view.cache');
    Route::get('/admin/view-clear', 'Admin\ArtisanController@ViewClear')->name('admin.view.clear');
    Route::get('/admin/route-cache', 'Admin\ArtisanController@RouteCache')->name('admin.route.cache');
    Route::get('/admin/route-clear', 'Admin\ArtisanController@RouteClear')->name('admin.route.clear');
    Route::get('/admin/settings', 'Admin\ArtisanController@Settings')->name('admin.setting');
    //order related route
    Route::get('/admin/order/list', 'Admin\OrderController@OrderList')->name('admin.order.list');
    Route::get('/admin/order/list/accepted', 'Admin\OrderController@OrderListAccepted')->name('admin.order.list.accepted');
    Route::get('/admin/order/list/pending', 'Admin\OrderController@OrderListPending')->name('admin.order.list.pending');
    Route::get('/admin/order/list/onreview', 'Admin\OrderController@OrderListOnReview')->name('admin.order.list.onreview');
    Route::get('/admin/order/list/complete', 'Admin\OrderController@OrderListComplete')->name('admin.order.list.complete');
    Route::get('/admin/order/list/cancel', 'Admin\OrderController@OrderListCancel')->name('admin.order.list.cancel');
    Route::get('/admin/order/details/{id}', 'Admin\OrderController@OrderList')->name('admin.order.details');
    Route::get('/admin/order/assign-to-vendor/{id}', 'Admin\OrderController@OrderAssignToVendor')->name('admin.order.assign_to_vendor');
    Route::get('/admin/order/assign-to-vendor-store/{vendor_id}/{order_id}', 'Admin\OrderController@OrderAssignToVendorStore')->name('admin.order.assign_to_vendor_store');
    Route::get('/admin/order/details/{id}', 'Admin\OrderController@orderDetails')->name('admin.order.details');
    Route::get('/admin/review/view/{id}','Admin\VendorReviewController@view')->name('admin.review.view');
    Route::get('/admin/review','Admin\VendorReviewController@index')->name('admin.review.index');
    Route::post('/admin/review/update/{id}','Admin\VendorReviewController@reviewUpdate')->name('admin.review.update');
    Route::post('/admin/review/status', 'Admin\VendorReviewController@updateStatus')->name('admin.review.status');

    Route::get('/admin/vendors/withdraw/request','Admin\VendorController@withdrawRequest')->name('admin.vendor.withdraw.request');
    Route::get('/admin/vendors/payment/history','Admin\VendorController@paymentHistory')->name('admin.vendor.payment.history');
    Route::post('/admin/vendors/withdraw_payment_modal', 'Admin\VendorController@withdraw_payment_modal')->name('admin.vendors.withdraw_payment_modal');
    Route::post('/admin/vendors/pay_to_seller_commission', 'Admin\VendorController@pay_to_vendor_commission')->name('admin.vendor.commissions.pay_to_seller');


    //Dynamic Pages
    Route::get('admin/pages/settings','Admin\PageController@index')->name('admin.pages.index');
    Route::post('admin/page/data/update','Admin\PageController@pageDataUpdate');
    Route::post('admin/page/editor/show','Admin\PageController@editorShow')->name('admin.pages.editor.show');

    //CK editor
    Route::post('admin/ckeditor/upload', 'Admin\PageController@upload')->name('admin.ckeditor.upload');


});

Auth::routes();

Route::group(['middleware' => ['auth', 'vendor']], function(){
    Route::get('/vendor/dashboard','Vendor\VendorController@dashboard')->name('vendor.dashboard');
    Route::get('/vendor/update-profile/{id}','Vendor\VendorController@profileUpdate')->name('vendor.update.profile');
    Route::post('/vendor/change/password','Vendor\ProfileController@updatePassword')->name('vendor.change.password');
    Route::post('/vendor/profile/update','Vendor\ProfileController@updateProfile')->name('vendor.profile.update');
    Route::post('/vendor/gallery/image/add','Vendor\ProfileController@GalleryImageStore')->name('vendor.gallery.image.store');
    Route::get('/vendor/gallery/image/delete/{id}','Vendor\ProfileController@GalleryImageDelete')->name('vendor.gallery.image.delete');
    Route::post('/vendor/update-profile-ac','Vendor\VendorController@profileUpdateAc')->name('vendor.update.profile.ac');
    Route::post('/vendor/service-selected-by-vendor','Vendor\VendorController@VendorServices')->name('vendor.service-selected-by-vendor');
    Route::get('/vendor/service-delete-by-vendor/{id}','Vendor\VendorController@VendorServicesDelete')->name('vendor.service-delete-by-vendor');
    Route::put('/vendor/service-updated-by-vendor/{id}','Vendor\VendorController@VendorServicesUpdated')->name('vendor.service-updated-by-vendor');
    Route::get('/vendor/services-manage/ajax/{id}','Vendor\VendorController@ajaxSubCat')->name('vendor.services.get.subcategory');
    Route::get('/vendor/subcategory-wise-service/ajax/{id}','Vendor\VendorController@ajaxSubCatWiseService')->name('vendor.subcategory-wise-service.get');
    Route::get('/vendor/request/order/list','Vendor\OrderRequestController@showList')->name('vendor.request_order_list');
    Route::post('/vendor/request/order/accept','Vendor\OrderRequestController@orderAccept')->name('vendor.request_order_accept');
    Route::post('/vendor/order/detail/communication/accept','Vendor\OrderRequestController@orderDetailCommunicationAccept')->name('vendor.order_detail_communication_accept');
    Route::post('/vendor/request/order/status/change/{id}','Vendor\OrderRequestController@orderStatusChange')->name('vendor.request_order__status_change');
    //Route::post('/vendor/order/detail/communication/status/change/{id}','Vendor\OrderRequestController@orderDetailCommunicationAprroveStatusChange')->name('vendor.order_detail_communication_status_change');
    Route::get('/vendor/request/order/payment/{id}','Vendor\OrderRequestController@orderPayment')->name('vendor.order.payment');
    Route::get('/vendor/request/order/details/{id}','Vendor\OrderRequestController@orderDetails')->name('vendor.request_order_details');
    Route::get('/vendor/request/quotation/details/{id}','Vendor\OrderRequestController@quotation')->name('vendor.request.quotation');
    Route::get('/vendor/notification/all/clear/{id}','Vendor\NotificationController@clearAllNotification')->name('vendor.clearAll.notification');
    Route::get('/vendor/notification/read/{id}','Vendor\NotificationController@readNotification')->name('vendor.read.notification');
    Route::get('/vendor/notification/ajax/{id}','Vendor\NotificationController@getNotification')->name('vendor.get.notification');
    Route::get('/vendor/customer/review','Vendor\ReviewController@customerReview')->name('vendor.customer.review');

    Route::get('/vendor/money/withdraw','Vendor\PaymentController@money')->name('vendor.money.withdraw');
    Route::post('/vendor/money/withdraw/store','Vendor\PaymentController@store')->name('vendor.withdraw-request.store');
    Route::get('/vendor/withdraw/request','Vendor\VendorController@withdrawRequest')->name('vendor.withdraw.request');
    Route::get('/vendor/payment/history','Vendor\VendorController@paymentHistory')->name('vendor.payment.history');

});

//Auth::routes();
//
//
Route::get('{AnyRoute}', function () {
   return view('home');
})->where('AnyRoute','.*');
