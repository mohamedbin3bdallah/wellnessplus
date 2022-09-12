<?php

use App\FaqStudent;
use App\FaqInstructor;
use App\User;
use App\Setting;
use App\CourseClass;

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

Route::get('/handle/specialty/tag/{tag}', 'HomeController@handleSpecialtyTags')->name('handle.specialty.tag');

Route::post('/user/getusers', 'UserController@getusers');
Route::get('/find/tutor/slots', 'FindTutorController@getTutorSlots');
Route::get('/find/tutor/content', 'FindTutorController@getTutorContent');

Route::get('/api/{apiName}', 'Common\AjaxController@index');
Route::post('/api/{apiName}', 'Common\AjaxController@index');

Route::get('/Login', function () {
    return view('frontend.login-tutor');
});

Route::get('/studentRegistration', function () {
    return view('frontend.sign-student');
});


Route::get('/tutor-frequently-faq', 'FaqInstructorController@getFrontFaq');


Route::view('/ipblock','ipblock')->name('ip.block');


Route::middleware(['web' ,'switch_languages', 'ip_block'])->group(function () {

    	


    // Auth Routes
Route::get('auth/{provider}/{type}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback/{type}', 'Auth\AuthController@handleProviderCallback');


    Route::middleware(['web','is_verified'])->group(function () {

        // Route::get('/', function () {
        //     return view('home');
        // });
		Route::get('/registration', function () {
			if(Session::has('therapist_register_step_2')) return view('frontend.sign-tutor-2');
			else return view('frontend.sign-tutor');
		})->name('registration');
		Route::post('/registration/therapist_register_step_1', 'Auth\RegisterController@registerStep1')->name('therapist-register-Step-1');
		Route::post('/registration/therapist_register_step_2', 'Auth\RegisterController@registerStep2')->name('therapist-register-Step-2');

        Route::get('/', 'HomeController@index');

        Route::get('/home', 'HomeController@index')->name('home');
                Route::get('/package', 'PackageController@index')->name('package');

        Route::get('/find/therapist', 'FindTutorController@index')->name('findTutor');
        Route::get('/find/therapist', 'FindTutorController@search')->name('findTutor.search');
		
		Route::get('/find/tutor', 'FindTutorController@index')->name('findTutor');
        Route::get('/find/tutor', 'FindTutorController@search')->name('findTutor.search');

        Route::get('/tutor/page/{id}', 'FindTutorController@tutorProfile');



    });

    Route::middleware(['web', 'is_verified', 'auth'])->group(function () {
		
		Route::get('/handle/redirection/verifiesEmail', 'HomeController@handleRedirectionVerifiesEmail')->name('handle.redirection.verifiesEmail');

        /*Route::get('/flutterwave/payment/1', 'AppointmentController@paymentCallback')->name('payment-callback');
        Route::get('/flutterwave/payment/2', 'AppointmentController@paymentCallbackdashboard')->name('payment-callback-dashboard');*/
        Route::get('/payment/frontend', 'AppointmentController@paymentCallback')->name('payment-callback');
		Route::get('/payment-slots/frontend', 'AppointmentController@paymentSlotsCallback')->name('payment-slots-callback');
        Route::get('/payment/dashboard', 'AppointmentController@paymentCallbackdashboard')->name('payment-callback-dashboard');
		Route::get('/payment-slots/dashboard', 'AppointmentController@paymentCallbackdashboard')->name('payment-callback-dashboard');


		/*
		* Reports
		*/
		Route::get('/report/users_country', 'ReportController@users_country')->name('reports.users.country');
		Route::get('/report/tutors_organization', 'ReportController@tutors_organization')->name('reports.tutors.organization');
		Route::post('/report/tutors_organization', 'ReportController@get_tutors_organization');
		
		Route::post('/payment/makePayment', 'PaymentController@makePayment');
		Route::get('/payment/fail/{page}', 'PaymentController@failDashboard');
		Route::get('/payment/fail/{page}/{id}', 'PaymentController@fail');
		Route::get('/payment/success', 'PaymentController@success');
		
		Route::post('/payment-slots/makePayment', 'PaymentSlotsController@makePayment');
		Route::get('/payment-slots/fail/{page}', 'PaymentSlotsController@failDashboard');
		Route::get('/payment-slots/fail/{page}/{id}', 'PaymentSlotsController@fail');
		Route::get('/payment-slots/success', 'PaymentSlotsController@success');

        Route::get('/user/favourites/{id}', 'FindTutorController@favourites');
        Route::get('/user/notifcations/mark-read', 'NotificationController@markRead')->name('mark.user.notifications.read');


        Route::get('/tutor/profile', 'InstructorController@getTutorProfile');
        Route::post('/tutor/profile/update', 'InstructorController@updateTutorProfile')->name('tutor.profile.update');
        Route::post('/tutor/certificate/update', 'InstructorController@updateTutorCertificate')->name('tutor.certificate.update');
        Route::post('/tutor/experience/update', 'InstructorController@updateTutorExperience')->name('tutor.experience.update');
        Route::post('/tutor/education/update', 'InstructorController@updateTutorEducation')->name('tutor.education.update');

        Route::get('/tutor/education/delete/{id}', 'InstructorController@deleteTutorEducation');
        Route::get('/tutor/experience/delete/{id}', 'InstructorController@deleteTutorExperience');
        Route::get('/tutor/certificate/delete/{id}', 'InstructorController@deleteTutorCertificate');


        Route::get('/tutor/Unsubscribe', 'InstructorController@Unsubscribe');
        Route::get('/tutor/registration/steps', 'UserController@step1')->name('registration.steps');
        Route::get('/student/Unsubscribe', 'UserProfileController@notificationsUnsubscribe');

        Route::resource('reviewrating', 'ReviewratingController');

        Route::get('/student/package/cart/{tutor_id}/{package_id}', 'PackagesController@purchasePackage')->name('student.package.add');



        Route::prefix('bigblue')->group(function (){
            Route::view('setting','bbl.setting')->name('bbl.setting');
            Route::post('setting','BigBlueController@setting')->name('bbl.update.setting');
            Route::get('meetings','BigBlueController@index')->name('bbl.all.meeting');
            Route::view('meeting/create','bbl.create')->name('bbl.create');
            Route::post('meeting/store','BigBlueController@store')->name('bbl.store');
            Route::get('meeting/edit/{meetingid}','BigBlueController@edit')->name('bbl.edit');
            Route::post('meeting/update/{meetingid}','BigBlueController@update')->name('bbl.update');
            Route::delete('meeting/delete/{id}','BigBlueController@delete')->name('bbl.delete');
            Route::get('api/create/meeting/{id}','BigBlueController@apiCreate')->name('api.create.meeting');
            /*Route::get('api/callback',function (){
                return redirect('/')->with('success','Meeting Ended Successfully !');
            });*/
			Route::get('api/callback','BigBlueController@endMeeting')->name('api.end.meeting');

            Route::get('recordings','BigBlueController@getRecordingsAnchor')->name('bbl.all.recordings');


        });


    });


    Auth::routes(['verify' => true]);

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


    Route::prefix('admins')->group(function (){
        Route::get('/', 'AdminController@index')->name('admin.index');
    });

	/**
	* add routes of the is_partner middleware
	**/
	Route::middleware(['web', 'is_active', 'auth', 'is_partner', 'switch_languages'])->group(function () {
		Route::prefix('user')->group(function (){
			Route::get('/','UserController@viewAllUser')->name('user.index');
			Route::get('/adduser','UserController@create')->name('user.add');
			Route::post('/insertuser','UserController@store')->name('user.store');
			Route::get('edit/{id}','UserController@edit')->name('user.edit');
			Route::put('/edit/{id}','UserController@update')->name('user.update');
            Route::post('/edit/{id}','UserController@update')->name('user.update');

			Route::delete('delete/{id}','UserController@destroy')->name('user.delete');
		});
		
		Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');
	});

  Route::middleware(['web', 'is_active', 'auth', 'is_admin', 'switch_languages'])->group(function () {

    /*
	** Users EmailVerify
	*/
	Route::get('emailVerify', 'UserController@emailVerifyPage')->name('users.email.verify');
	Route::post('getEmailVerify', 'UserController@emailVerifyPageData')->name('get.email.verify');
	Route::post('sendEmailVerify', 'UserController@sendEmailVerify')->name('send.email.verify');
	
	/*
	** Appointments
	*/
	Route::get('appointments', 'AppointmentController@appointments')->name('appointments.index');
	Route::post('get-appointments', 'AppointmentController@getAppointments')->name('get.appointments');
	
	/*
	** Users
	*/
	Route::get('students', 'StudentController@students')->name('all.students.users');
	Route::post('get-students-users', 'StudentController@getStudents')->name('get.students.users');
	Route::post('change-students-users', 'StudentController@changeStudentData')->name('change.students.users');
	Route::get('tutors', 'InstructorController@tutors')->name('all.tutors.users');
	Route::post('get-tutors-users', 'InstructorController@getTutors')->name('get.tutors.users');
	Route::post('get-detail-tutors-users', 'InstructorController@getTutorDetail')->name('get.detail.tutors.users');
	Route::post('change-tutors-users', 'InstructorController@changeTutorData')->name('change.tutors.users');
	
	/*
	** Total
	*/
	Route::get('students-total', 'TotalController@studentsTotal')->name('students-total');
	Route::post('get-students-total', 'TotalController@getStudentsTotal')->name('get-students-total');
	Route::get('tutors-total', 'TotalController@tutorsTotal')->name('tutors-total');
	Route::post('get-tutors-total', 'TotalController@getTutorsTotal')->name('get-tutors-total');
	Route::post('get-total-appointments-details', 'TotalController@getAppointmentsDetailsTotal')->name('get-total-appointments-details');
	Route::post('get-total-meetings-details', 'TotalController@getMeetingsDetailsTotal')->name('get-total-meetings-details');
	Route::post('get-total-dealwiths-details', 'TotalController@getDealwithsDetailsTotal')->name('get-total-dealwiths-details');
	Route::post('get-total-favourites-details', 'TotalController@getFavouritesDetailsTotal')->name('get-total-favourites-details');
	Route::post('get-total-messages-details', 'TotalController@getMessagesDetailsTotal')->name('get-total-messages-details');
	Route::post('get-total-packages-details', 'TotalController@getPackagesDetailsTotal')->name('get-total-packages-details');
	Route::post('get-total-coupons-details', 'TotalController@getCouponsDetailsTotal')->name('get-total-coupons-details');
	Route::post('get-total-balance-logs-details', 'TotalController@getBalanceLogsDetailsTotal')->name('get-total-balance-logs-details');
	 
	/*
	** Messages
	*/
	Route::get('admin-messages', 'MessagesController@allMessages')->name('all.messages');
	Route::post('get-messages', 'MessagesController@getMessages')->name('get.messages');
	
	/*
	**Tutor Packages
	*/
	Route::get('admins/tutor-packages', 'TutorPackageController@index')->name('show.tutor.packages');
    Route::get('admins/tutor-package/create', 'TutorPackageController@create')->name('create.tutor.packages');
    Route::post('admins/tutor-package/store', 'TutorPackageController@store')->name('store.tutor.packages');
    Route::get('admins/tutor-package/edit/{id}', 'TutorPackageController@edit')->name('edit.tutor.packages');
    Route::put('admins/tutor-package/{id}','TutorPackageController@update')->name('update.tutor.packages');
    Route::delete('admins/tutor-package/delete/{id}','TutorPackageController@destroy')->name('delete.tutor.packages');
	Route::post('admins/tutor-package/change', 'TutorPackageController@change')->name('change.tutor.packages');
	
	/*
	**Tutor Country Prices Per Hour
	*/
	Route::get('admins/tutor-country-pricePerHour', 'TutorCountryPricePerHourController@index')->name('show.tutor.country.pricePerHour');
    Route::get('admins/tutor-country-pricePerHour/create', 'TutorCountryPricePerHourController@create')->name('create.tutor.country.pricePerHour');
    Route::post('admins/tutor-country-pricePerHour/store', 'TutorCountryPricePerHourController@store')->name('store.tutor.country.pricePerHour');
    Route::get('admins/tutor-country-pricePerHour/edit/{id}', 'TutorCountryPricePerHourController@edit')->name('edit.tutor.country.pricePerHour');
    Route::put('admins/tutor-country-pricePerHour/{id}','TutorCountryPricePerHourController@update')->name('update.tutor.country.pricePerHour');
    Route::delete('admins/tutor-country-pricePerHour/delete/{id}','TutorCountryPricePerHourController@destroy')->name('delete.tutor.country.pricePerHour');
	Route::post('admins/tutor-country-pricePerHour/change', 'TutorCountryPricePerHourController@change')->name('change.tutor.country.pricePerHour');
	Route::post('admins/tutor-country-pricePerHour/get', 'TutorCountryPricePerHourController@get')->name('get.tutor.country.pricePerHour');
	
	/*
	**Organization Links
	*/
	Route::get('admins/organizations', 'OrganizationsController@index')->name('show.organizations');
    Route::get('admins/organizations/create', 'OrganizationsController@create')->name('create.organizations');
    Route::post('admins/organizations/store', 'OrganizationsController@store')->name('store.organization');
    Route::get('admins/organization/edit/{id}', 'OrganizationsController@edit')->name('edit.organization');
    Route::put('admins/organization/{id}','OrganizationsController@update')->name('organization.update');
    Route::delete('admins/organization/delete/{id}','OrganizationsController@destroy')->name('organization.delete');
	
	Route::post('/partner/addpackage', 'PackagesController@partneraddpackage')->name('partner.package.add');
	
	/**
	* add routes of partner tutors assignment
	**/
	Route::get('assign','PartnerController@assignpage')->name('assign.page');
    Route::post('assign/store','PartnerController@assignstore')->name('assign.store');
	
	// Player Settings
    Route::get('/admins/playersetting','PlayerSettingController@get')->name('player.set');
    Route::post('/admins/playersetting/update','PlayerSettingController@update')->name('player.update');


//    Route::get('admins/ads','AdsController@getAds')->name('ads');
//    Route::post('admins/ads/insert','AdsController@store')->name('ad.store');

//    Route::get('admins/ads/setting','AdsController@getAdsSettings')->name('ad.setting');

//    Route::put('admins/ads/timer','AdsController@updateAd')->name('ad.update');

//    Route::put('admins/ads/pop','AdsController@updatePopAd')->name('ad.pop.update');

//    Route::delete('admins/ads/delete/{id}','AdsController@delete')->name('ad.delete');

//    Route::get('admins/ads/create','AdsController@create')->name('ad.create');

//    Route::get('admins/ads/edit/{id}','AdsController@showEdit')->name('ad.edit');

//    Route::put('admins/ads/edit/{id}','AdsController@updateADSOLO')->name('ad.update.solo');

//    Route::put('admins/ads/video/{id}','AdsController@updateVideoAD')->name('ad.update.video');

//    Route::post('admins/ads/bulk_delete', 'AdsController@bulk_delete');

    Route::post('/quickupdate/course/{id}','QuickUpdateController@courseQuick')->name('course.quick');
    Route::post('/quickupdate/user/{id}','QuickUpdateController@userQuick')->name('user.quick');
    Route::post('/quickupdate/slider/{id}','QuickUpdateController@sliderQuick')->name('slider.quick');
    Route::post('/quickudate/course/{id}','QuickUpdateController@courseabc')->name('course.featured');
    Route::post('/quickupdate/category/{id}','QuickUpdateController@categoryQuick')->name('category.quick');
    Route::post('/quickupdate/language/{id}','QuickUpdateController@languageQuick')->name('language.quick');
    Route::post('/quickupdate/pag/{id}','QuickUpdateController@pageQuick')->name('page.quick');
    Route::post('/quickupdate/what/{id}','QuickUpdateController@whatQuick')->name('what.quick');
    Route::post('/quickupdate/ansr/{id}','QuickUpdateController@ansrQuick')->name('ansr.quick');
    Route::post('/quickupdate/Chapter/{id}','QuickUpdateController@ChapterQuick')->name('Chapter.quick');
    Route::post('/quickupdate/testimonial/{id}','QuickUpdateController@testimonialQuick')->name('testimonial.quick');
    Route::post('/quickupdate/subcategory/{id}','QuickUpdateController@subcategoryQuick')->name('subcategory.quick');
    Route::post('/quickupdate/childcategory/{id}','QuickUpdateController@childcategoryQuick')->name('childcategory.quick');
    Route::post('/quickupdate/y/{id}','QuickUpdateController@categoryfQuick')->name('categoryf.quick');
    Route::post('/quickupdate/blog_status/{id}','QuickUpdateController@blog_statusQuick')->name('blog.status.quick');
    Route::post('/quickupdate/blog_approved/{id}','QuickUpdateController@blog_approvedQuick')->name('blog.approved.quick');
    Route::post('/quickupdate/status/{id}','QuickUpdateController@reviewstatusQuick')->name('reviewstatus.quick');
    Route::post('/quickupdate/approved/{id}','QuickUpdateController@reviewapprovedQuick')->name('reviewapproved.quick');
    Route::post('/quickupdate/featured/{id}','QuickUpdateController@reviewfeaturedQuick')->name('reviewfeatured.quick');
    Route::post('/quickupdate/faq/{id}','QuickUpdateController@faqQuick')->name('faq.quick');
    Route::post('/quickupdate/faqinstructor/{id}','QuickUpdateController@faqInstructorQuick')->name('faqInstructor.quick');

    Route::post('/quickupdate/order/{id}','QuickUpdateController@orderQuick')->name('order.quick');

    Route::prefix('user')->group(function (){
    Route::get('/','UserController@viewAllUser')->name('user.index');
    Route::get('/adduser','UserController@create')->name('user.add');
    Route::post('/insertuser','UserController@store')->name('user.store');
    Route::get('edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/edit/{id}','UserController@update')->name('user.update');
    Route::delete('delete/{id}','UserController@destroy')->name('user.delete');
    });

    Route::resource("admins/country","CountryController");
    Route::resource("admins/state","StateController");
    Route::resource("admins/city","CityController");

    Route::resource('page','PageController');
    Route::resource('/testimonial','TestimonialController');
    Route::resource('slider','SliderController');
    Route::resource('trusted','TrustedController');


    Route::post('mailsetting/update','SettingController@updateMailSetting')->name('update.mail.set');
    Route::get('settings','SettingController@genreal')->name('gen.set');
	Route::post('setting/store','SettingController@store')->name('setting.store');
    Route::post('setting/paymentGetway','SettingController@paymentGetway')->name('setting.payment.getway');
    Route::post('setting/seo','SettingController@updateSeo')->name('seo.set');
    Route::post('setting/addcss','SettingController@storeCSS')->name('css.store');
    Route::post('setting/addjs','SettingController@storeJS')->name('js.store');
    Route::post('setting/sociallogin/fb','SettingController@slfb')->name('sl.fb');
    Route::post('setting/sociallogin/gl','SettingController@slgl')->name('sl.gl');
    Route::post('setting/sociallogin/git','SettingController@slgit')->name('sl.git');
    Route::post('setting/sociallogin/amazon','SettingController@slamazon')->name('sl.amazon');
    Route::post('setting/sociallogin/linkedin','SettingController@sllinkedin')->name('sl.linkedin');
    Route::post('setting/sociallogin/twitter','SettingController@sltwitter')->name('sl.twitter');

    Route::get('/admins/api','ApiController@setApiView')->name('api.setApiView');
    Route::post('admins/api','ApiController@changeEnvKeys')->name('api.update');
    Route::put('/review/update/{id}','ReviewratingController@update')
    ->name('review.update');

    Route::resource('facts', 'SliderfactsController');
    Route::get('coursetext', 'CoursetextController@show');
    Route::put('coursetext/update', 'CoursetextController@update');
    Route::get('getstarted', 'GetstartedController@show');
    Route::put('getstarted/update', 'GetstartedController@update');
    Route::resource('hometext', 'HomeTextController');
    Route::get('terms', 'TermsController@show')->name('termscondition');
    Route::put('termscondition', 'TermsController@update');
    Route::get('policy', 'TermsController@showpolicy')->name('policy');
    Route::put('privacypolicy', 'TermsController@updatepolicy');

    Route::resource('reports','ReportReviewController');

    Route::get('aboutpage', 'AboutController@show')->name('about.page');
    Route::put('aboutupdate', 'AboutController@update');
    Route::get('comingsoon', 'ComingSoonController@show')->name('comingsoon.page');
    Route::put('comingsoonupdate', 'ComingSoonController@update');
    Route::get('careers', 'CareersController@show')->name('careers.page');
    Route::put('careers/update', 'CareersController@update');
    Route::resource('faq','FaqController');
    Route::resource('faqinstructor','FaqInstructorController');
    Route::resource('carts', 'CartController');

    Route::get('currency', 'CurrencyController@show');
    Route::put('currency/update', 'CurrencyController@update');


    Route::get('widget', 'WidgetController@edit')->name('widget.setting');
    Route::put('widget/update', 'WidgetController@update');
    Route::post('admins/class/{id}/addsubtitle','SubtitleController@post')->name('add.subtitle');
    Route::post('admins/class/{id}/delete/subtitle','SubtitleController@delete')->name('del.subtitle');

    Route::get('frontslider', 'CategorySliderController@show')->name('category.slider');
    Route::put('frontslider/update', 'CategorySliderController@update');

    Route::resource('requestinstructor', 'InstructorRequestController');

    Route::resource('coupon','CouponController');
    Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');
	Route::get('requestinstructor/edit/{page}/{id}', 'InstructorRequestController@edit')->name('edit.instructor');
	Route::put('requestinstructor/update/{page}/{id}', 'InstructorRequestController@update')->name('update.instructor');
    Route::get('all/instructors/paymentInfo', 'InstructorRequestController@getPaymentInfo')->name('getPaymentInfo');
    Route::get('view/order/admins/{id}', 'OrderController@vieworder')->name('view.order');

    Route::resource('user/course/report','CourseReportController');

    Route::get('banktransfer', 'BankTransferController@show')->name('bank.transfer');
    Route::put('banktransfer/update', 'BankTransferController@update');

    Route::get('admins/lang', 'LanguageController@showlang')->name('show.lang');

    Route::get('admins/frontstatic/{local}', 'LanguageController@frontstaticword')->name('frontstatic.lang');

    Route::post('/admins/update/{lang}/frontTranslations/content','LanguageController@frontupdate')->name('static.trans.update');

    Route::get('admins/adminstatic/{local}', 'LanguageController@adminstaticword')->name('adminstatic.lang');

    Route::post('/admins/update/{lang}/adminTranslations/content','LanguageController@adminupdate')->name('admin.static.update');
	
	Route::get('admins/{file}/{local}', 'LanguageController@store_trans')->name('store.trans.lang');
    Route::post('/admins/update/{file}/{lang}/content','LanguageController@update_trans')->name('update.trans.lang');

    Route::get('admins/tax', 'TaxController@index')->name('show.tax');
    Route::get('admins/email-templates', 'EmailTemplateController@index')->name('email.templates');
    Route::put('admins/email-templates/update', 'EmailTemplateController@update')->name('email.templates.update');

    Route::get('admins/filter-log', 'FilterLogController@index')->name('filter.log');
    Route::get('admins/tax/create', 'TaxController@create')->name('create.tax');

    Route::post('admins/tax/store', 'TaxController@store')->name('store.tax');

    Route::get('admins/tax/edit/{id}', 'TaxController@edit')->name('edit.tax');

    Route::put('admins/tax/{id}','TaxController@update')->name('lang.update');

    Route::delete('admins/tax/delete/{id}','TaxController@destroy')->name('tax.delete');

    Route::get('admins/packages', 'PackagesController@index')->name('show.packages');

    Route::get('admins/packages/create', 'PackagesController@create')->name('create.packages');

    Route::post('admins/packages/store', 'PackagesController@store')->name('store.package');

    Route::get('admins/package/edit/{id}', 'PackagesController@edit')->name('edit.package');

    Route::put('admins/package/{id}','PackagesController@update')->name('package.update');

    Route::delete('admins/package/delete/{id}','PackagesController@destroy')->name('package.delete');



    Route::get('admins/pwa', 'PwaSettingController@index')->name('show.pwa');

    Route::post('/admins/pwa/update/manifest','PwaSettingController@updatemanifest')->name('manifest.update');

    Route::post('/admins/pwa/update/sw','PwaSettingController@updatesw')->name('sw.update');

    Route::post('/admins/pwa/update/icons','PwaSettingController@updateicons')->name('icons.update');

    Route::post('/admins/manualcity','CityController@addcity')->name('city.manual');

    Route::post('/admins/manualstate','StateController@addstate')->name('state.manual');

    Route::resource('user/question/report','QuestionReportController');

    // adsense routes
    Route::get('/admins/adsensesetting/','AdsenseController@index')->name('adsense');
    Route::put('/admins/adsensesetting','AdsenseController@update')->name('adsense.update');





  });

  //Route::middleware(['web', 'is_active', 'auth', 'admin_instructor', 'switch_languages'])->group(function () {
  Route::middleware(['web', 'is_active', 'auth', 'switch_languages', 'cors'])->group(function () {



   if(\DB::connection()->getDatabaseName()){
     if(env('IS_INSTALLED') == 1){
        $zoom_enable = Setting::first()->zoom_enable;

        $bbl_enable  = Setting::first()->bbl_enable;

        if(isset($zoom_enable) && $zoom_enable == 1){

            Route::prefix('zoom')->group(function (){
                Route::get('setting','ZoomController@setting')->name('zoom.setting');
                Route::get('dashboard','ZoomController@dashboard')->name('zoom.index');
                Route::post('token/update','ZoomController@updateToken')->name('updateToken');
                Route::get('create/meeting','ZoomController@create')->name('meeting.create');
                Route::delete('delete/meeting/{id}','ZoomController@delete')->name('zoom.delete');
                Route::post('store/new/meeting','ZoomController@store')->name('zoom.store');
                Route::get('edit/meeting/{meetingid}','ZoomController@edit')->name('zoom.edit');
                Route::post('update/meeting/{meetingid}','ZoomController@updatemeeting')->name('zoom.update');
                Route::get('show/meeting/{meetingid}','ZoomController@show')->name('zoom.show');
            });
        }




     }
    }

    Route::prefix('user')->group(function (){
      Route::get('edit/{id}','UserController@edit')->name('user.edit');
      Route::put('/edit/{id}','UserController@update')->name('user.update');
    });

    Route::resource('category','CategoriesController');
    Route::get('/category/{slug}','CategoriesController@show')->name('category.show');
    Route::resource('subcategory','SubcategoryController');
    Route::resource('childcategory','ChildcategoryController');
    Route::resource('course','CourseController');
    Route::resource('courseinclude','CourseincludeController');
    Route::resource('coursechapter','CoursechapterController');
    Route::resource('whatlearns','WhatlearnsController');
    Route::resource('relatedcourse','RelatedcourseController');
    Route::resource('questionanswer','QuestionanswerController');
    Route::resource('courseanswer', 'AnswerController');
    Route::resource('courseclass','CourseclassController');
//    Route::resource('reviewrating','ReviewratingController');
    Route::resource('announsment','AnnounsmentController');
    Route::get('/course/create/{id}','CourseController@showCourse')->name('course.show');
    Route::post('/category/insert','CategoriesController@categoryStore')->name('cat.store');
    Route::post('/subcategory/insert','SubcategoryController@SubcategoryStore')->name('child.store');
    Route::put('/course/include/{id}','CourseController@testup')->name('corinc.update');
    Route::put('/course/whatlearns/{id}','CourseController@test')->name('what.update');
    Route::put('/course/coursechapter/{id}','CourseController@tes')->name('chapter.update');
    Route::get('send', 'CourseclassController@store')->name('notification');
    Route::resource('courselang','CourseLanguageController');
    Route::get("admins/dropdown","CourseController@upload_info");
    Route::get("admins/gcat","CourseController@gcato");


    Route::get('instructor', 'InstructorController@index')->name('instructor.index');
    Route::resource('userenroll', 'InstructorEnrollController');
    Route::resource('instructorquestion', 'InstructorQuestionController');
    Route::resource('instructoranswer', 'InstructorAnswerController');
    Route::get('coursereview', 'CourseReviewController@index');

    Route::resource('instructor/announcement', 'InstructorAnnouncementController');
    Route::resource('usermessage', 'ContactUsController');
    Route::resource('languages', 'LanguageController');

    Route::get('reposition/category', 'CategoriesController@reposition')->name('category_reposition');

    Route::post('reposition/class', 'CourseclassController@sort')->name('class-sort');

    Route::get('reposition/slider', 'SliderController@reposition')->name('slider_reposition');

    Route::resource('admins/quiztopic', 'QuizTopicController');

    Route::resource('/admins/questions', 'QuizController');

    Route::resource('blog', 'BlogController');

    Route::resource('order', 'OrderController');

    Route::resource('featurecourse', 'FeatureCourseController');

    Route::post('/paywithpaytm', 'FeatureCourseController@order')->name('paywithpaytm');
    Route::get('/featurepayment/status', 'FeatureCourseController@paymentCallback');

    Route::post('featuredwithpaypal', 'FeatureCourseController@payWithpaypal')->name('featuredWithpaypal');
    Route::get('getfeaturedstatus', 'FeatureCourseController@getPaymentStatus')->name('featured');

    Route::resource('bundle', 'BundleCourseController');

    Route::resource('assignment', 'AssignmentController');

    Route::resource('appointment', 'AppointmentController');


      Route::post('appointment/delete/{id}', 'AppointmentController@delete');

      Route::post('paywithflutterwave', 'FeatureCourseController@payWithFlutterWave')->name('payWithFlutterWave');
      Route::get('getpaymentstatus', 'FeatureCourseController@getPaymentStatus')->name('featured');


        Route::post('/paywithrave', 'RaveController@initialize')->name('paywithrave');
        Route::post('/rave/callback', 'RaveController@callback')->name('callback');
        Route::post('/rave/callback/free', 'RaveController@freeCallback')->name('free-callback');
		Route::post('/slots-free', 'RaveController@freeSlots')->name('slots-free');
        Route::get('/rave/callback', 'RaveController@callback');
        Route::post('/refund', 'RaveController@refund')->name('refund');






  });

    Route::get('course/appointment/{id}/{date}/{time}', 'AppointmentController@request')->name('appointment.request');
    Route::post('course/appointment/{id}/{date}/{time}', 'AppointmentController@request')->name('appointment.request');
	Route::get('slots/appointment', 'AppointmentController@bookSlots')->name('book.appointment.slots');

  Route::middleware(['web','switch_languages', 'is_verified'])->group(function () {

	Route::post('/balance','BalanceController@update')->name('balance.update');
	Route::post('/slots-balance','BalanceController@updateSlots')->name('balance.update.slots');
	
    Route::post('rating/show/{id}','ReviewratingController@rating')->name('course.rating');
    Route::post('reports/insert/{id}','ReportReviewController@store')->name('report.review');
    Route::get('/course/{id}/{slug}','CourseController@CourseDetailPage')->name('user.course.show');
    Route::get('all/blog','BlogController@blogpage')->name('blog.all');
    Route::get('about/show','AboutController@aboutpage')->name('about.show');
    Route::get('show/comingsoon','ComingSoonController@comingsoonpage')
    ->name('comingsoon.show');
    Route::get('show/careers','CareersController@careerpage')->name('careers.show');
    Route::get('detail/blog/{id}','BlogController@blogdetailpage')->name('blog.detail');
    Route::get('gotomycourse', 'CourseController@mycoursepage')->name('mycourse.show');

    Route::get('show/help', function(){
    $data = FaqStudent::first();
    $item = FaqInstructor::first();
    return view('front.help.faq',compact('data', 'item'));
    })->name('help.show');

    Route::get('pages/{slug}','PageController@showpage')->name('page.show');

    Route::post('show/wishlist/{id}','WishlistController@wishlist');
    Route::post('remove/wishlist/{id}','WishlistController@removewishlist');

    Route::get('enroll/show/{id}', 'EnrollmentController@enroll')->name('show.enroll');

    Route::get('show/coursecontent/{id}', 'CourseController@CourseContentPage');

    Route::post('addquestion/{id}','QuestionanswerController@question');
    Route::post('addanswer/{id}','AnswerController@answer');

    Route::get('all/wishlist', 'WishlistController@wishlistpage')->name('wishlist.show');
    Route::post('delete/wishlist/{id}', 'WishlistController@deletewishlist');

    Route::post('addtocart', 'CartController@addtocart')->name('addtocart');

    Route::post('removefromcart/{id}','CartController@removefromcart')
      ->name('remove.item.cart');

    Route::get('all/cart', 'CartController@cartpage')->name('cart.show');

    Route::post('gotocheckout', 'CheckoutController@checkoutpage');

    Route::get('notifications/{id}', 'NotificationController@markAsRead')
    ->name('markAsRead');
    Route::get('delete/notifications', 'NotificationController@delete')
    ->name('deleteNotification');

    Route::get('/view', 'DownloadController@getDownload');

    Route::get('/download/{id}', 'DownloadController@getDownload')->name('downloadPdf')->middleware('auth');

    Route::post('review/helpful/{id}', 'ReviewHelpfulController@store')->name('helpful');
    Route::post('review/delete/{id}', 'ReviewHelpfulController@destroy')
    ->name('helpful.delete');

    Route::get('gotocategory/page/{id}', 'CategoriesController@categorypage')->name('category.page');
    Route::get('gotosubcategory/page/{id}', 'CategoriesController@subcategorypage')->name('subcategory.page');
    Route::get('gotochildcategory/page/{id}', 'CategoriesController@childcategorypage')->name('childcategory.page');

    Route::post('apply/instructor', 'InstructorRequestController@instructor')
    ->name('apply.instructor');

    Route::get('search', 'SearchController@index')->name('search');

    Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}','TimeHistoryController@movie_time');

    Route::get('all/purchase', 'OrderController@purchasehistory')->name('purchase.show');
    Route::get('invoice/show/{id}', 'OrderController@invoice')->name('invoice.show');


    Route::get('profile/show/{id}', 'UserProfileController@userprofilepage')->name('profile.show');

    Route::get('facebookDisconnect/{id}', 'UserProfileController@facebookDisconnect');
    Route::get('googleDisconnect/{id}', 'UserProfileController@googleDisconnect');


    Route::get('mylessons/{id}', 'UserProfileController@myLessonsPage')->name('myLessons.show');

    Route::post('mylessons/{id}', 'UserProfileController@lessonsFiltering')->name('myLessons.filter');

    Route::get('lesson/reschedule/{id}', 'UserProfileController@RescheduleLesson')->name('myLessons.reschedule');

    Route::get('myteachers/{id}', 'UserProfileController@myTeachersPage')->name('myTeachers.show');

    Route::post('myteachers/{id}', 'UserProfileController@myTeachersFiltering')->name('myTeachers.filter');


    Route::get('tutor/lessons/{id}', 'InstructorController@tutorLessons')->name('tutorLessons.show');

    Route::post('tutor/lessons/{id}', 'InstructorController@tutorLessonsFiltering')->name('tutorLessons.filter');

    Route::get('myStudents/{id}', 'InstructorController@myStudents')->name('myStudents.show');

    Route::post('myStudents/{id}', 'InstructorController@myStudentsFiltering')->name('myStudents.filter');

    Route::get('myCalendar/{id}', 'InstructorController@myCalendar')->name('myCalendar.show');

    Route::get('availabilityTime/{id}', 'InstructorController@myAvailabilityTime')->name('myAvailabilityTime.show');

    Route::post('availabilityTime/{id}', 'InstructorController@updateAvailabilityTime')->name('myAvailabilityTime.updare');

    Route::post('scheduleNewLesson/{id}', 'InstructorController@scheduleNewLesson')->name('scheduleNewLesson');

    Route::post('addTimeOff/{id}', 'InstructorController@addTimeOff')->name('addTimeOff');

    Route::get('statistics/{id}', 'InstructorController@myStatistics')->name('myStatistics.show');


    Route::put('/edit/{id}','UserProfileController@userprofile')->name('user.profile');

    Route::post('course/reports/{id}','CourseReportController@store')->name('course.report');

    Route::get('watch/course/{id}', 'WatchController@watch')->name('watchcourse');
    Route::get('watch/courseclass/{id}', 'WatchController@watchclass')->name('watchcourseclass');
    Route::get('audio/courseclass/{id}', 'WatchController@audioclass')->name('audiocourseclass');

    Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

    Route::get("country/dropdown","CountryController@upload_info");
    Route::get("country/gcity","CountryController@gcity");

    Route::view('terms_condition', 'terms_condition');
    Route::view('privacy_policy', 'privacy_policy');

    Route::get('detail/faq/{id}','HelpController@faqstudentpage')->name('faq.detail');
    Route::get('faqinstructor/detail/{id}','HelpController@faqinstructorpage')->name('faqinstructor.detail');

    Route::view('user_contact', 'front.contact');
    Route::post('contact/user', 'ContactUsController@usermessage')
    ->name('contact.user');

    Route::get('tabcontent/{id}','TabController@show');

    Route::post('paywithpaypal', 'PaypalController@payWithpaypal')->name('payWithpaypal');
    Route::get('getpaymentstatus', 'PaypalController@getPaymentStatus')->name('status');

    Route::get('event', 'InstaMojoController@index');
    Route::post('pay', 'InstaMojoController@pay');
    Route::get('pay-success', 'InstaMojoController@success');

    Route::get('stripe', 'StripePaymentController@stripe');
    Route::post('paytostripe', 'StripePaymentController@payStripe')->name('stripe.pay');

    Route::get('payment/braintree', 'BraintreeController@get_bt');
    Route::post('payment/braintree', 'BraintreeController@payment');

    Route::get('razorpay', 'RazorpayController@pay')->name('pay');
    Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

    Route::post('/paywithpaystack', 'PayStackController@redirectToGateway')->name('paywithpaystack');
    Route::get('callback', 'PayStackController@handleGatewayCallback');
    Route::get('chat/{user_id}', 'ChatController@getChat')->name('get.chat')->middleware('auth');
    Route::post('send/message', 'ChatController@sendMessage')->name('send.message')->middleware('auth');

    Route::post('apply/coupon', 'ApplyCouponController@applycoupon');
	Route::post('apply/slots-coupon', 'ApplyCouponController@applyslotscoupon');

    Route::post('removecoupon/{id}','ApplyCouponController@remove')
      ->name('remove.coupon');

    Route::post('/paywithpayment', 'PaytmController@order')->name('paywithpayment');
    Route::post('payment/status', 'PaytmController@paymentCallback');

    Route::post('process/banktransfer', 'BankTransferController@banktransfer');

    Route::get('watchcourse/in/frame/{url}/{course_id}', 'WatchController@view')->name('watchinframe');

    Route::get('start_quiz/{id}', 'QuizStartController@quizstart')->name('start_quiz');

    Route::post('/start_quiz/store/{id}','QuizStartController@store')->name('start.quiz.store');

    Route::get('finish/{id}','QuizStartController@show')->name('start.quiz.show');



    Route::get('invoice/download/{id}', 'OrderController@pdfdownload')->name('invoice.download');

    Route::get('watch/lightbox/{id}', 'WatchController@lightbox')->name('lightbox');

    Route::post('question/reports/{id}','QuestionReportController@store')->name('question.report');

    Route::get('cirtificate/{id}', 'CertificateController@show')->name('cirtificate.show');

    Route::get('cirtificate/download/{id}', 'CertificateController@pdfdownload')->name('cirtificate.download');

    Route::get('answersheet/{id}', 'QuizTopicController@delete')->name('answersheet');

    Route::get('tryagain/{id}', 'QuizStartController@tryagain')->name('tryagain');

    Route::get('admins/instructor/settings', 'InstructorSettingController@view')->name('instructor.settings');

    Route::post('admins/instructor/update', 'InstructorSettingController@update')->name('instructor.update');

    Route::get('instructor/details', 'InstructorSettingController@instructor')->name('instructor.pay');

    Route::post('instructor/payout/{id}', 'InstructorSettingController@settings')->name('instructor.payout');

    Route::get('pending/payout', 'PayoutController@pending')->name('pending.payout');

    Route::get('admins/instructor', 'AdminPayoutController@index')->name('admin.instructor');

    Route::get('admins/pending/{id}', 'AdminPayoutController@pending')->name('admin.pending');
    Route::get('admins/paid/{id}', 'AdminPayoutController@paid')->name('admin.paid');

    Route::post('admins/payout/bulk_payout/{id}', 'AdminPayoutController@bulk_payout');

    Route::post('admins/paypal/{id}', 'PaymentController@paypal')->name('admin.paypal');
    Route::post('admins/banktransfer/{id}', 'PaymentController@banktransfer')->name('admin.banktransfer');
    Route::post('admins/paytm/{id}', 'PaymentController@paytm')->name('admin.paytm');

    Route::get('admins/completed/payout', 'CompletedPayoutController@show')->name('admin.completed');
    Route::get('payout/completed/view/{id}', 'CompletedPayoutController@view')->name('completed.view');

    Route::get('admins/meeting/show', 'MeetingController@index')->name('meeting.show');
    Route::delete('destroy/meeting/{id}','MeetingController@destroy')->name('zoom.destroy');

    Route::post('course/checked/{id}', 'CourseProgressController@checked');

    Route::post('bundle/cart/{id}', 'BundleCourseController@addtocart')->name('bundlecart');
    Route::get('bundle/detail/{id}', 'BundleCourseController@detailpage')->name('bundle.detail');
    Route::get('bundle/enroll/{id}', 'BundleCourseController@enroll')->name('bundle.enroll');

    Route::get('bbl/detail/{id}', 'BigBlueController@detailpage')->name('bbl.detail');

    Route::get('join/meeting/{meetingid}','BigBlueController@joinview')->name('bbluserjoin');
    Route::post('api/join/meeting','BigBlueController@apiJoin')->name('bbl.api.join');


    Route::post('course/assignment/{id}', 'AssignmentController@submit')->name('assignment.submit');
    Route::post('assignment/delete/{id}', 'AssignmentController@delete');

    Route::get('instructor/{id}', 'InstructorSettingController@instructorprofile')->name('instructor.profile');




  });

});


Route::get("allcountry/dropdown","AllCountryController@upload_info");
Route::get("allcountry/gcity","AllCountryController@gcity");

Route::get('/activestatus', 'WatchCourseController@active');

Route::get('active/courses', 'WatchCourseController@watchlist')->name('active.courses');
Route::post('active/delete/{id}', 'WatchCourseController@delete')->name('active.delete');

Route::get('admins/ipblock', 'IPBlockController@view')->name('ipblock.view');

Route::post('admins/ipblock/update', 'IPBlockController@update')->name('ipblock.update');

Route::get('all/assignment', 'AssignmentController@view')->name('assignment.view');
Route::get('view/assignment/{id}', 'AssignmentController@assignment')->name('list.assignment');



Route::group(['prefix' => 'messages', 'before' => 'auth'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
    Route::get('unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::post('/student', ['as' => 'messages.student', 'uses' => 'MessagesController@studentMessage']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

//*****My fatoorah api */
Route::get('payment', [\App\Http\Controllers\MyFatoorahController::class, 'index']);
Route::get('payment/callback', [\App\Http\Controllers\MyFatoorahController::class, 'callback']);
Route::get('payment/error', [\App\Http\Controllers\MyFatoorahController::class, 'error']);
