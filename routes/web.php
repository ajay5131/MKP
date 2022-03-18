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

// Route::get('/', function () {
//     return view('welcome');
// });

// Public home  routes
Route::group(['namespace' => 'Publichome'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('/update-overview', 'HomeController@updateOverview')->name('update.overview');
    Route::get("/add-more-overview", function(){ return View::make("public.home.add_more.overview"); })->name('add.more.overview.lang');
    Route::get("/add-more-service-title", function(){ return View::make("public.home.add_more.service_title"); })->name('add.more.service.title.lang');
    Route::get("/add-more-service", function(){ return View::make("public.home.add_more.service"); })->name('add.more.service.lang');

    Route::post('/service', 'HomeController@getService')->name('get.service');
    Route::post('/update-service', 'HomeController@updateService')->name('update.service.detail');


    Route::get('/news', 'HomeController@news')->name('news');
    Route::get('/news/{slug}', 'HomeController@newsDetail')->name('news.detail');
    
    Route::get('/meet-our-team', 'HomeController@meetOurTeam')->name('meet.our.team');
    Route::get('/meet-out-team/{slug}', 'HomeController@meetOurTeamDetail')->name('meet.our.team.detail');
    
    Route::get('/terms-and-condition', 'HomeController@termsCondition')->name('terms.and.condition');
    Route::get('/terms-of-service', 'HomeController@termsService')->name('terms.of.service');
    Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy.policy');
    
    Route::get('/testimonial', 'HomeController@testimonial')->name('testimonial');
    Route::get('/faq', 'HomeController@faq')->name('faq');
    
    Route::get('/contact-us', 'HomeController@contact')->name('contact');
    Route::post('/contact-us', 'HomeController@emailContact')->name('contact');
    Route::get('/contact-us-thanks', 'HomeController@thanksContact')->name('contact.thanks');
    
    Route::post('/change-language', 'HomeController@changeLanguage')->name('change.language');
});

// registration and login routes

Route::group(['namespace' => 'Publichome'], function() {
    
    
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@save')->name('register');
    Route::get('/verify-email', 'RegisterController@verifyEmail')->name('verification.verify');
    
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('reset.password');
    Route::post('/password/reset', 'ResetPasswordController@reset');


    Route::get('get-state', 'CommonController@getState')->name('get.state');
    Route::get('get-city', 'CommonController@getCity')->name('get.city');
    Route::post('upload-profile-picture', 'CommonController@uploadProfilePicture')->name('upload.profile.picture');
    Route::post('unique-email', 'CommonController@uniqueEmail')->name('unique.email');
    Route::post('unique-handlename', 'CommonController@uniqueHandleName')->name('unique.handlename');
});

// Frontend Routes
/* 
-Note: If want to skip function from authentication then you need to update the UserAuthorized middleware
*/

Route::group(['namespace' => 'Frontend', 'middleware' => ['user_auth:user']], function() {
    Route::get('/setting', 'SettingController@index')->name('setting');
    Route::post('/setting', 'SettingController@update')->name('setting');
    // Route::post('/unique-handlename', 'SettingController@uniqueHandlename')->name('unique.handlename');
    
    Route::get('/main-profile/{slug}', 'ProfilesController@main')->name('main');
    Route::get('/musician-singer-profile/{slug}', 'ProfilesController@musicianSingerProfile')->name('musician.singer');
    Route::get('/model-actor-profile/{slug}', 'ProfilesController@modelActorProfile')->name('model.actor');
    Route::get('/dancer-athlete-profile/{slug}', 'ProfilesController@dancerAthleteProfile')->name('dancer.athlete');
    Route::get('/writer-director-profile/{slug}', 'ProfilesController@writerDirectorProfile')->name('writer.director');
    Route::get('/artist-designer-profile/{slug}', 'ProfilesController@artistDesignerProfile')->name('artist.designer');
    Route::get('/freelancer-profile/{slug}', 'ProfilesController@freelancerProfile')->name('freelancer');
    Route::get('/property-profile/{slug}', 'ProfilesController@propertyProfile')->name('property');
    Route::get('/company-profile/{slug}', 'ProfilesController@companyProfile')->name('company');
    Route::get('/marketplace/{slug}', 'ProfilesController@marketplace')->name('marketplace');
    
    Route::get('/add-music', 'ProfilesController@addMusic')->name('add.music');
    Route::post('/add-music', 'ProfilesController@saveMusic')->name('add.music');
    Route::get('/get-profile-music', 'ProfilesController@getProfileMusic')->name('get.profile.music');
    Route::get('/edit-music', 'ProfilesController@editMusic')->name('edit.music');
    Route::post('/edit-music', 'ProfilesController@saveMusic')->name('edit.music');
    
    Route::get('/edit-profile', 'ProfilesController@editProfile')->name('edit.profile');
    Route::post('/update-profile', 'ProfilesController@updateProfile')->name('update.profile');
    
    Route::get('/edit-profile-picture', 'ProfilesController@editProfilePicture')->name('edit.profile.picture');
    Route::post('/update-profile-picture', 'ProfilesController@updateProfilePicture')->name('update.profile.picture');

    Route::post('/get-profile-overview', 'ProfilesController@getProfileOverview')->name('get.profile.overview');
    Route::post('/update-profile-overview', 'ProfilesController@updateProfileOverview')->name('update.profile.overview');
    
    Route::post('/get-profile-basic-info', 'ProfilesController@getProfileBasicInfo')->name('get.profile.basic.info');
    Route::post('/update-profile-basic-info', 'ProfilesController@updateProfileBasicInfo')->name('update.profile.basic.info');

    Route::get('/get-profile-image-media', 'ProfilesController@getProfileImageMedia')->name('get.profile.image.media');
    Route::get('/get-profile-video-media', 'ProfilesController@getProfileVideoMedia')->name('get.profile.video.media');
    Route::get('/get-profile-audio-media', 'ProfilesController@getProfileAudioMedia')->name('get.profile.audio.media');
    
    Route::post('/update-profile-media', 'ProfilesController@updateProfileMedia')->name('update.profile.media');
    

    Route::get('/get-profile-media', 'ProfilesController@getProfileMedia')->name('get.profile.media');
    Route::get('/get-profile-archive-media', 'ProfilesController@getProfileArchiveMedia')->name('get.profile.archive.media');
    Route::post('/delete-profile-media', 'ProfilesController@deleteMedia')->name('delete.profile.media');
    
    
    
    Route::post('/like-profile-media', 'ProfilesController@likeMedia')->name('like.profile.media');
    Route::post('/play-media-count', 'ProfilesController@playMediaCount')->name('play.profile.media');
    
    Route::get('/update-visible', 'ProfilesController@getVisibleModal')->name('update.visible');
    Route::post('/update-visible', 'ProfilesController@updateVisible')->name('update.visible');

    
    Route::post('/update-social-media', 'ProfilesController@updateSocialMedia')->name('update.social.media');
    
    Route::post('/update-follower', 'ProfilesController@updateFollower')->name('update.follower');
    Route::post('/delete-follower', 'ProfilesController@deleteFollower')->name('delete.follower');
    
    Route::post('/report-profile', 'ProfilesController@reportProfile')->name('report.profile');

    Route::post('/users-review', 'ProfilesController@usersReview')->name('users.review');
    Route::get('/add-review', 'ProfilesController@addReview')->name('add.review');
    Route::post('/add-review', 'ProfilesController@updateReview')->name('add.review');
    Route::post('/delete-review', 'ProfilesController@deleteReview')->name('delete.review');

    
    Route::get('/keylist', 'KeylistController@index')->name('keylist');

    Route::get('/add-to-keylist', 'KeylistController@add_to_keylist')->name('add.to.keylist');
    Route::get('/add-keylist-title', 'KeylistController@add_keylist_title_modal')->name('add.keylist.title');
    Route::post('/add-keylist-title', 'KeylistController@add_keylist_title')->name('add.keylist.title');

    Route::get('/edit-keylist-title', 'KeylistController@edit_keylist_title_modal')->name('edit.keylist.title');
    Route::post('/edit-keylist-title', 'KeylistController@edit_keylist_title')->name('edit.keylist.title');
    
    Route::post('/delete-keylist', 'KeylistController@deleteKeylist')->name('delete.keylist');
    Route::post('/delete-keylist-media', 'KeylistController@deleteKeylistMedia')->name('delete.keylist.media');
    
    Route::post('/save-to-keylist', 'KeylistController@save_to_keylist')->name('save.to.keylist');
    
    Route::get('/add-pin-media', 'KeylistController@addPinMedia')->name('add.pin.media');
    Route::post('/save-pin-media', 'KeylistController@savePinMedia')->name('save.pin.media');

    Route::get('/deal-list', 'DeallistController@list')->name('deal.list');
    Route::get('/send-deal', 'DeallistController@sendDeal')->name('send.deal');
    Route::post('/send-deal', 'DeallistController@saveSendDeal')->name('profile.send.deal');
    
    Route::get('/reply-deal', 'DeallistController@replyDeal')->name('reply.deal');
    Route::post('/reply-deal', 'DeallistController@saveReplyDeal')->name('reply.deal');
    
    Route::post('/send-request', 'KeypeopleController@sendRequest')->name('send.keypeople.request');

    
    Route::get('/load-media', 'MediaPopupController@loadMedia')->name('load.media');
    Route::post('/archive-profile-media', 'MediaPopupController@archiveMedia')->name('archive.profile.media');
    Route::post('/delete-media', 'MediaPopupController@deleteMedia')->name('delete.media');
    Route::post('/update-profile-media-description', 'MediaPopupController@updateProfileMediaDescription')->name('update.profile.media.description');
    
    Route::get('/search-media-location', 'MediaPopupController@searchMediaLocation')->name('search.media.location');
    Route::post('/update-media-location', 'MediaPopupController@updateMediaLocation')->name('update.media.location');
    Route::post('/like-media', 'MediaPopupController@likeMedia')->name('like.media');
    Route::post('/update-media-tagged-user', 'MediaPopupController@updateMediaTaggedUser')->name('update.tagged.user');

    Route::get('/search', 'SearchController@index')->name('search');

    Route::get('/keypeople', 'KeypeopleController@index')->name('keypeople');
    Route::get('/add-key-people', 'KeypeopleController@add_keypeople_title_modal')->name('add.key.people');
    Route::post('/add-key-people', 'KeypeopleController@add_keypeople_title')->name('add.keylist.people');    
    Route::post('/update-keypeople-category', 'KeypeopleController@updateCategory')->name('update.keypeople.category');    
    Route::post('/delete-keypeople', 'KeypeopleController@deleteKeypeople')->name('delete.keypeople');
    
    Route::post('/post-comments', 'ProfilesController@postComments')->name('post.comment');
    Route::post('/delete-comments', 'ProfilesController@deleteComment')->name('delete.comment');
    
    Route::get('/get-comments', 'ProfilesController@getAllComments')->name('get.comments');


    //Project

    Route::get('/project-category-listings', 'ProjectController@projectCategoryList')->name('project.category.list');
    Route::get('/project-listings', 'ProjectController@index')->name('project.list');
    Route::get('/project-details/{id}', 'ProjectController@projectDetails')->name('project.details');
    Route::get('/project-add', 'ProjectController@addProject')->name('project.add');
    Route::get('/project-edit/{id}', 'ProjectController@editProject')->name('project.edit');
    Route::PUT('/project-update/{id}', 'ProjectController@updateProject')->name('project.update');
    Route::post('/fetch-states', 'ProjectController@fetchState')->name('fetch.states');
    Route::post('/fetch-cities', 'ProjectController@fetchCity')->name('fetch.cities');
    Route::post('/store-projects', 'ProjectController@storeProject')->name('store.projects');

    // Messages
    Route::get('/messages', 'MessagesController@index')->name('messages.list');
    Route::get('/messages/{id}/{type}', 'MessagesController@chatDetails')->name('messages.chat');
    Route::post('/delete-messages', 'MessagesController@deleteMessage')->name('delete.messages');

    Route::post('/add-media', 'ProjectController@addMedia')->name('project.add.media');
    Route::post('/update-media', 'ProjectController@updateMedia')->name('project.update.media');
    Route::post('/delete-media', 'ProjectController@deleteMedia')->name('project.delete.media');

    Route::post('/add-role', 'ProjectController@addRole')->name('project.add.role.media');
    Route::post('/update-added-form', 'ProjectController@updateAddedForm')->name('project.update.added.form');
    Route::post('/edit-role-form', 'ProjectController@editRoleProject')->name('project.edit.role.form');


    // Travel
    Route::get('/travel-listings', 'TravelController@index')->name('travel.list');
    Route::get('/travel-details/{id}', 'TravelController@travelDetails')->name('travel.details');
    Route::get('/travel-add', 'TravelController@addTravel')->name('travel.add');
    Route::post('/store-travels', 'TravelController@storeTravel')->name('store.travels');
    Route::get('/travel-edit/{id}', 'TravelController@editTravel')->name('travel.edit');
    Route::PUT('/travel-update/{id}', 'TravelController@updateTravel')->name('travel.update');
    Route::post('/fetch-cities', 'TravelController@fetchCity')->name('fetch.cities');
    Route::post('/travel-add-media', 'TravelController@addMedia')->name('travel.add.media');
    Route::post('/add-itinerary', 'TravelController@addItinerary')->name('travel.add.itinerary');
    Route::post('/itinerary-edit-form', 'TravelController@editItinerary')->name('itinerary.edit.form');
    Route::post('/update-itinerary', 'TravelController@updateItinerary')->name('travel.update.itinerary');
    Route::post('/delete-itinerary', 'TravelController@deleteItinerary')->name('travel.delete.itinerary');

   

});

//     Route::post('/send-message', 'MessagesController@sendMessage')->name('send.message');
// });