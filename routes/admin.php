<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/


/* 
|-------------------------------------------------
|-------- Always user prefix as admin ------------
|------------------------------------------------- 
*/


/* 
Login and logout routes
*/
Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function () {    
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/validate', 'LoginController@login')->name('validate.login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');

    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset');
});

// all routes inside the group
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function() {
    Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

    // Country Route
    Route::get('/countries','CountryController@index')->name('admin.country');
    Route::get('/country-list','CountryController@list')->name('admin.list.country');
    Route::get('/add-country','CountryController@add')->name('admin.add.country');
    Route::get('/edit-country/{id}','CountryController@edit')->name('admin.edit.country');
    Route::post('/save-country','CountryController@save')->name('admin.save.country');
    Route::post('/update-country','CountryController@update')->name('admin.update.country');
    Route::delete('/delete-country','CountryController@delete')->name('admin.delete.country');
    
    // State Route
    Route::get('/states','StateController@index')->name('admin.state');
    Route::get('/state-list','StateController@list')->name('admin.list.state');
    Route::get('/add-state','StateController@add')->name('admin.add.state');
    Route::get('/edit-state/{id}','StateController@edit')->name('admin.edit.state');
    Route::post('/save-state','StateController@save')->name('admin.save.state');
    Route::post('/update-state','StateController@update')->name('admin.update.state');
    Route::delete('/delete-state','StateController@delete')->name('admin.delete.state');
    
    // city Route
    Route::get('/cities','CityController@index')->name('admin.city');
    Route::get('/city-list','CityController@list')->name('admin.list.city');
    Route::get('/add-city','CityController@add')->name('admin.add.city');
    Route::get('/edit-city/{id}','CityController@edit')->name('admin.edit.city');
    Route::post('/save-city','CityController@save')->name('admin.save.city');
    Route::post('/update-city','CityController@update')->name('admin.update.city');
    Route::delete('/delete-city','CityController@delete')->name('admin.delete.city');
    
    // slider Route
    Route::get('/sliders','SliderController@index')->name('admin.slider');
    Route::get('/slider-list','SliderController@list')->name('admin.list.slider');
    Route::get('/add-slider','SliderController@add')->name('admin.add.slider');
    Route::get('/edit-slider/{id}','SliderController@edit')->name('admin.edit.slider');
    Route::post('/save-slider','SliderController@save')->name('admin.save.slider');
    Route::post('/update-slider','SliderController@update')->name('admin.update.slider');
    Route::delete('/delete-slider','SliderController@delete')->name('admin.delete.slider');
    Route::get("/add_more_slider", function(){ return View::make("backend.slider.add_more"); })->name('add.more.slider.lang');

    
    // news Route
    Route::get('/news','NewsController@index')->name('admin.news');
    Route::get('/news-list','NewsController@list')->name('admin.list.news');
    Route::get('/add-news','NewsController@add')->name('admin.add.news');
    Route::get('/edit-news/{id}','NewsController@edit')->name('admin.edit.news');
    Route::post('/save-news','NewsController@save')->name('admin.save.news');
    Route::post('/update-news','NewsController@update')->name('admin.update.news');
    Route::delete('/delete-news','NewsController@delete')->name('admin.delete.news');
    Route::get("/add_more_news", function(){ return View::make("backend.news.add_more"); })->name('add.more.news.lang');
    
    // Our Team Route
    Route::get('/team','TeamController@index')->name('admin.team');
    Route::get('/team-list','TeamController@list')->name('admin.list.team');
    Route::get('/add-team','TeamController@add')->name('admin.add.team');
    Route::get('/edit-team/{id}','TeamController@edit')->name('admin.edit.team');
    Route::post('/save-team','TeamController@save')->name('admin.save.team');
    Route::post('/update-team','TeamController@update')->name('admin.update.team');
    Route::delete('/delete-team','TeamController@delete')->name('admin.delete.team');
    Route::get("/add-more-team", function(){ return View::make("backend.team.add_more"); })->name('add.more.team.lang');
    // Our Team Sort Route
    Route::get('/sort-team','TeamController@sort')->name('admin.sort.team');
    Route::get('/get-team-sort-data','TeamController@getTeamSortData')->name('admin.team.sort.data');
    Route::post('/sort-update','TeamController@sortUpdate')->name('admin.team.sort.update');


    // Admin Route
    Route::get('/admin-user','AdminController@index')->name('admin.user');
    Route::get('/admin-user-list','AdminController@list')->name('admin.list.user');
    Route::get('/add-admin-user','AdminController@add')->name('admin.add.user');
    Route::get('/edit-admin-user/{id}','AdminController@edit')->name('admin.edit.user');
    Route::post('/save-admin-user','AdminController@save')->name('admin.save.user');
    Route::post('/update-admin-user','AdminController@update')->name('admin.update.user');
    Route::delete('/delete-admin-user','AdminController@delete')->name('admin.delete.user');
    
    // User Profile Route
    Route::get('/user-profiles','UserProfilesController@index')->name('user.profiles');
    Route::get('/user-profiles-list','UserProfilesController@list')->name('admin.list.user.profiles');
    Route::post('/change-user-profiles-status','UserProfilesController@changeStatus')->name('admin.change.users.status');
    Route::get('/view-user-profiles/{id}','UserProfilesController@viewProfiles')->name('view.user.profiles');
    Route::post('/update-profile-badge','UserProfilesController@updateProfilesBadge')->name('update.profile.badge');
    
    // Page Route
    Route::get('/admin-pagecontent','PagesController@index')->name('admin.pagecontent');
    Route::get('/admin-pagecontent-list','PagesController@list')->name('admin.list.pagecontent');
    Route::get('/edit-pagecontent/{id}','PagesController@edit')->name('admin.edit.pagecontent');
    Route::post('/update-admin-pagecontent','PagesController@update')->name('admin.update.pagecontent');
    Route::get("/add-more-pagecontent", function(){ return View::make("backend.pages.add_more"); })->name('add.more.pages.lang');

    // Testimonial Route
    Route::get('/testimonials','TestimonialController@index')->name('admin.testimonial');
    Route::get('/testimonial-list','TestimonialController@list')->name('admin.list.testimonial');
    Route::get('/add-testimonial','TestimonialController@add')->name('admin.add.testimonial');
    Route::get('/edit-testimonial/{id}','TestimonialController@edit')->name('admin.edit.testimonial');
    Route::post('/save-testimonial','TestimonialController@save')->name('admin.save.testimonial');
    Route::post('/update-testimonial','TestimonialController@update')->name('admin.update.testimonial');
    Route::delete('/delete-testimonial','TestimonialController@delete')->name('admin.delete.testimonial');
    Route::get("/add-more-testimonial", function(){ return View::make("backend.testimonial.add_more"); })->name('add.more.testimonial.lang');


    // FAQ Route
    Route::get('/faq','FaqController@index')->name('admin.faq');
    Route::get('/faq-list','FaqController@list')->name('admin.list.faq');
    Route::get('/add-faq','FaqController@add')->name('admin.add.faq');
    Route::get('/edit-faq/{id}','FaqController@edit')->name('admin.edit.faq');
    Route::post('/save-faq','FaqController@save')->name('admin.save.faq');
    Route::post('/update-faq','FaqController@update')->name('admin.update.faq');
    Route::delete('/delete-faq','FaqController@delete')->name('admin.delete.faq');
    Route::get("/add-more-faq", function(){ return View::make("backend.faq.add_more"); })->name('add.more.faq.lang');

    // FAQ Sort Route
    Route::get('/sort-faq','FaqController@sort')->name('admin.sort.faq');
    Route::get('/get-faq-sort-data','FaqController@getFaqSortData')->name('admin.faq.sort.data');
    Route::PUT('/sort-update','FaqController@sortUpdate')->name('admin.faq.sort.update');

    // Language Route
    Route::get('/languages','LanguageController@index')->name('admin.language');
    Route::get('/language-list','LanguageController@list')->name('admin.list.language');
    Route::get('/add-language','LanguageController@add')->name('admin.add.language');
    Route::get('/edit-language/{id}','LanguageController@edit')->name('admin.edit.language');
    Route::post('/save-language','LanguageController@save')->name('admin.save.language');
    Route::post('/update-language','LanguageController@update')->name('admin.update.language');
    Route::post('/change-status-language','LanguageController@changeStatus')->name('admin.language.status');

    // Language Translate Route
    Route::get('/language-translates','LangTranslateController@index')->name('admin.language.translate');
    Route::get('/language-translate-list','LangTranslateController@list')->name('admin.list.language.translate');
    Route::get('/add-language-translate','LangTranslateController@add')->name('admin.add.language.translate');
    Route::get('/edit-language-translate/{id}','LangTranslateController@edit')->name('admin.edit.language.translate');
    Route::post('/save-language-translate','LangTranslateController@save')->name('admin.save.language.translate');
    Route::post('/update-language-translate','LangTranslateController@update')->name('admin.update.language.translate');
    Route::delete('/delete-language-translate','LangTranslateController@delete')->name('admin.delete.language.translate');
    Route::get("/add-more-language-translate", function(){ return View::make("backend.langtranslate.add_more"); })->name('add.more.lang.translate.lang');
    
    // Language Translate Lable  Route 
    Route::get('/translate-label','LangTranslateLabelController@index')->name('admin.language.translate.label');
    Route::get('/translate-label-list','LangTranslateLabelController@list')->name('admin.list.language.translate.label');
    Route::get('/add-translate-label','LangTranslateLabelController@add')->name('admin.add.language.translate.label');
    Route::get('/edit-translate-label/{id}','LangTranslateLabelController@edit')->name('admin.edit.language.translate.label');
    Route::post('/save-translate-label','LangTranslateLabelController@save')->name('admin.save.language.translate.label');
    Route::post('/update-translate-label','LangTranslateLabelController@update')->name('admin.update.language.translate.label');
    

    Route::post('/get-states-by-country','CommonController@getStatesByCountry')->name('get.states.by.country');

});




// Route::group(['namespace' => 'Backend', 'prefix' => 'admin'], function () {    
//     Route::get('/register', 'UsersController@showRegistrationForm')->name('register');
//     Route::get('/save', 'UsersController@register')->name('admin.register');
//     Route::post('/save', 'UsersController@register')->name('admin.register');
// });
