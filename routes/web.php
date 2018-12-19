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

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', 'LoginController@mobile_login');

Route::get('/', 'AdminsController@index')->middleware('auth');

Route::get('/index', 'AdminsController@index')->middleware('auth');

Route::get('admin_comment/{table}/{id}', 'CommentsController@index')->middleware('auth');

Route::post('admin_comment/admin_post_comment', 'CommentsController@postComment')->middleware('auth');



Route::get('admin', 'AdminsController@index')->middleware('auth');

Route::get('admin_admins', 'AdminsController@admins')->middleware('auth');

Route::get('admin_groups', 'GroupsController@index')->middleware('auth');

Route::get('admin_group_new', 'GroupsController@newGroup')->middleware('auth');

Route::get('admin_group_post_delete/{id}', 'GroupsController@destroy')->middleware('auth');


Route::get('admin_feeds', 'FeedsController@index')->middleware('auth');

Route::post('admin_feed_store', 'FeedsController@store')->middleware('auth');

Route::get('admin_feed_delete/{id}', 'FeedsController@delete')->middleware('auth');

Route::post('admin_feed_update', 'FeedsController@update')->middleware('auth');

Route::get('admin_volunteers', 'VolunteersController@index')->middleware('auth');

Route::post('admin_volunteer_store', 'VolunteersController@store')->middleware('auth');

Route::post('admin_volunteer_update', 'VolunteersController@update')->middleware('auth');

Route::post('admin_volunteer_delete', 'VolunteersController@delete')->middleware('auth');

Route::get('admin_donations', 'DonationsController@index')->middleware('auth');

Route::post('admin_donation_store', 'DonationsController@store')->middleware('auth');

Route::post('admin_donation_update', 'DonationsController@update')->middleware('auth');

Route::get('admin_donation_delete/{id}', 'DonationsController@delete')->middleware('auth');

Route::get('admin_group_edit/{id}', 'GroupsController@editGroup')->middleware('auth');

Route::get('admin_group_view/{id}', 'GroupsController@viewGroup')->middleware('auth');

Route::get('admin_group_posts/{id}', 'GroupsController@groupPosts')->middleware('auth');

Route::post('admin_group_post_store', 'GroupsController@postStore')->middleware('auth');

Route::post('admin_group_store', 'GroupsController@store')->middleware('auth');

Route::post('admin_group_update', 'GroupsController@update')->middleware('auth');

Route::get('admin_group_delete/{id}', 'GroupsController@delete')->middleware('auth');

Route::post('admin_upload_group_gallery', 'GroupsController@upload')->middleware('auth');


Route::get('admin_global_vip_categories', 'VipEventCategoriesController@index')->middleware('auth');

Route::post('admin_vipcategories_store', 'VipEventCategoriesController@store')->middleware('auth');

Route::post('admin_vipcategories_update', 'VipEventCategoriesController@update')->middleware('auth');

Route::get('admin_vipcategories_delete/{id}', 'VipEventCategoriesController@delete')->middleware('auth');



Route::get('admin_global_vip_events', 'GlobalEventsController@index')->middleware('auth');

Route::get('admin_global_vip_event_new', 'GlobalEventsController@NewGlobalVipEvent')->middleware('auth');

Route::get('admin_global_vip_event_edit/{id}', 'GlobalEventsController@editGlobalVipEvent')->middleware('auth');

Route::get('admin_global_vip_event_delete/{id}', 'GlobalEventsController@delete')->middleware('auth');

Route::post('admin_global_vip_event_store', 'GlobalEventsController@store')->middleware('auth');

Route::post('admin_global_vip_event_update', 'GlobalEventsController@update')->middleware('auth');

Route::post('admin_upload_global_vip_event_gallery', 'GlobalEventsController@upload')->middleware('auth');

Route::get('admin_private_parties', 'PrivatePartiesController@index')->middleware('auth');

Route::get('admin_private_party_new', 'PrivatePartiesController@NewPrivateParty')->middleware('auth');

Route::get('admin_private_party_edit/{id}', 'PrivatePartiesController@editPrivateParty')->middleware('auth');

Route::get('admin_private_party_delete/{id}', 'PrivatePartiesController@deletePrivateParty')->middleware('auth');

Route::post('admin_private_party_store', 'PrivatePartiesController@store')->middleware('auth');

Route::post('admin_private_party_update', 'PrivatePartiesController@update')->middleware('auth');

Route::post('admin_upload_private_party_gallery', 'PrivatePartiesController@upload')->middleware('auth');


Route::post('admin_event_tag_store', 'EventsController@addTag')->middleware('auth');

Route::get('admin_event_tag_delete/{id}/{event_id}', 'EventsController@deleteTag')->middleware('auth');

Route::get('admin_events', 'EventsController@index')->middleware('auth');

Route::get('admin_event_new', 'EventsController@newEvent')->middleware('auth');

Route::get('admin_event_edit/{id}', 'EventsController@editEvent')->middleware('auth');

Route::get('admin_events_view/{id}', 'EventsController@viewEvent')->middleware('auth');

Route::post('admin_event_store', 'EventsController@store')->middleware('auth');

Route::post('admin_event_update', 'EventsController@update')->middleware('auth');

Route::get('admin_event_delete/{id}', 'EventsController@delete')->middleware('auth');

Route::post('admin_upload_event_gallery', 'EventsController@upload')->middleware('auth');

Route::get('admin_bespoke_product_categories', 'BespokeProductCategoriesController@index')->middleware('auth');

Route::get('admin_bespoke_product_category_new', 'BespokeProductCategoriesController@newBespokeProductCategory')->middleware('auth');

Route::get('admin_bespoke_product_category_edit/{id}', 'BespokeProductCategoriesController@editBespokeProductCategory')->middleware('auth');

Route::post('admin_bespoke_product_category_store', 'BespokeProductCategoriesController@store')->middleware('auth');

Route::post('admin_bespoke_product_category_update', 'BespokeProductCategoriesController@update')->middleware('auth');


Route::get('admin_waitlisted_product_categories', 'WaitlistedProductCategoriesController@index')->middleware('auth');

Route::get('admin_waitlisted_product_category_new', 'WaitlistedProductCategoriesController@newWaitlistedProductCategory')->middleware('auth');

Route::get('admin_waitlisted_product_category_edit/{id}', 'WaitlistedProductCategoriesController@editWaitlistedProductCategory')->middleware('auth');

Route::post('admin_waitlisted_product_category_store', 'WaitlistedProductCategoriesController@store')->middleware('auth');

Route::post('admin_waitlisted_product_category_update', 'WaitlistedProductCategoriesController@update')->middleware('auth');


Route::post('admin_product_tag_store', 'BespokeProductsController@addTag')->middleware('auth');

Route::get('admin_product_tag_delete/{id}/{bespoke_product_id}', 'BespokeProductsController@deleteTag')->middleware('auth');

Route::get('admin_bespoke_products', 'BespokeProductsController@index')->middleware('auth');

Route::get('admin_bespoke_product_new', 'BespokeProductsController@newBespokeProduct')->middleware('auth');

Route::get('admin_bespoke_product_edit/{id}', 'BespokeProductsController@editBespokeProduct')->middleware('auth');

Route::post('admin_bespoke_product_store', 'BespokeProductsController@store')->middleware('auth');

Route::post('admin_bespoke_product_update', 'BespokeProductsController@update')->middleware('auth');

Route::post('admin_upload_bespoke_product_gallery', 'BespokeProductsController@upload')->middleware('auth');


Route::get('admin_waitlisted_products', 'WaitlistedProductsController@index')->middleware('auth');

Route::get('admin_waitlisted_product_new', 'WaitlistedProductsController@newWaitlistedProduct')->middleware('auth');

Route::get('admin_waitlisted_product_edit/{id}', 'WaitlistedProductsController@editWaitlistedProduct')->middleware('auth');

Route::post('admin_waitlisted_product_store', 'WaitlistedProductsController@store')->middleware('auth');

Route::post('admin_waitlisted_product_update', 'WaitlistedProductsController@update')->middleware('auth');

Route::post('admin_upload_waitlisted_product_gallery', 'WaitlistedProductsController@upload')->middleware('auth');



Route::get('admin_waitlisted_product_requests', 'WaitlistedProductsController@requests')->middleware('auth');

Route::post('admin_waitlisted_product_request_update_admin', 'WaitlistedProductsController@updateAdmin')->middleware('auth');

Route::post('admin_waitlisted_product_request_update_status', 'WaitlistedProductsController@updateStatus')->middleware('auth');

Route::get('admin_bespoke_product_requests', 'BespokeProductsController@requests')->middleware('auth');

Route::post('admin_bespoke_product_request_update_admin', 'BespokeProductsController@updateAdmin')->middleware('auth');

Route::post('admin_bespoke_product_request_update_status', 'BespokeProductsController@updateStatus')->middleware('auth');


Route::get('admin_private_party_requests', 'PrivatePartiesController@requests')->middleware('auth');

Route::post('admin_private_party_update_admin', 'PrivatePartiesController@updateAdmin')->middleware('auth');

Route::post('admin_private_party_update_status', 'PrivatePartiesController@updateStatus')->middleware('auth');

Route::get('admin_global_vip_events_requests', 'GlobalEventsController@requests')->middleware('auth');

Route::post('admin_global_vip_event_update_admin', 'GlobalEventsController@updateAdmin')->middleware('auth');

Route::post('admin_global_vip_event_update_status', 'GlobalEventsController@updateStatus')->middleware('auth');

Route::get('admin_flight_booking_requests', 'FlightBookingsController@requests')->middleware('auth');

Route::post('admin_flight_booking_update_admin', 'FlightBookingsController@updateAdmin')->middleware('auth');

Route::post('admin_flight_booking_update_status', 'FlightBookingsController@updateStatus')->middleware('auth');





Route::get('admin_vpas', 'VpasController@index')->middleware('auth');

Route::post('admin_vpa_update_admin', 'VpasController@updateAdmin')->middleware('auth');

Route::post('admin_vpa_update_status', 'VpasController@updateStatus')->middleware('auth');

Route::get('admin_contacts', 'ContactsController@index')->middleware('auth');

Route::get('admin_reply_ticket/{id}', 'ContactsController@showTicket')->middleware('auth');

Route::post('admin_contact_update_admin', 'ContactsController@updateAdmin')->middleware('auth');

Route::post('admin_contact_update_status', 'ContactsController@updateStatus')->middleware('auth');

Route::post('admin_create_ticket', 'ContactsController@newTicket')->middleware('auth');

Route::post('admin_ticket_comment', 'ContactsController@CommentTicket')->middleware('auth');


Route::get('admin_airport_concierge', 'AirportConciergeController@index')->middleware('auth');

Route::post('admin_airport_concierge_update_admin', 'AirportConciergeController@updateAdmin')->middleware('auth');

Route::post('admin_airport_concierge_update_status', 'AirportConciergeController@updateStatus')->middleware('auth');

Route::get('admin_bespoke_travel', 'BespokeTravelsController@index')->middleware('auth');

Route::post('admin_bespoke_travel_update_admin', 'BespokeTravelsController@updateAdmin')->middleware('auth');

Route::post('admin_bespoke_travel_update_status', 'BespokeTravelsController@updateStatus')->middleware('auth');

Route::get('admin_personal_shoppings', 'PersonalShoppingsController@index')->middleware('auth');

Route::post('admin_personal_shopping_update_admin', 'PersonalShoppingsController@updateAdmin')->middleware('auth');

Route::post('admin_personal_shopping_update_status', 'PersonalShoppingsController@updateStatus')->middleware('auth');


Route::get('admin_wardrobe_stylings', 'WardrobeStylingsController@index')->middleware('auth');

Route::post('admin_wardrobe_styling_update_admin', 'WardrobeStylingsController@updateAdmin')->middleware('auth');

Route::post('admin_wardrobe_styling_update_status', 'WardrobeStylingsController@updateStatus')->middleware('auth');

Route::post('admin_experience_tag_store', 'ExperiencesController@addTag')->middleware('auth');

Route::get('admin_experience_tag_delete/{id}/{experience_id}', 'ExperiencesController@deleteTag')->middleware('auth');

Route::get('admin_experiences', 'ExperiencesController@index')->middleware('auth');

Route::get('admin_experience_new', 'ExperiencesController@newExperiences')->middleware('auth');

Route::get('admin_experience_edit/{id}', 'ExperiencesController@editExperiences')->middleware('auth');

Route::get('admin_experience_view/{id}', 'ExperiencesController@viewExperiences')->middleware('auth');

Route::post('admin_experience_store', 'ExperiencesController@store')->middleware('auth');

Route::post('admin_experience_update', 'ExperiencesController@update')->middleware('auth');

Route::get('admin_experience_delete/{id}', 'ExperiencesController@delete')->middleware('auth');

Route::get('admin_excategories', 'ExperiencesCategoriesController@index')->middleware('auth');

Route::get('admin_excategories_delete/{id}', 'ExperiencesCategoriesController@delete')->middleware('auth');

Route::post('admin_excategories_store', 'ExperiencesCategoriesController@store')->middleware('auth');

Route::post('admin_upload_experience_gallery', 'ExperiencesController@upload')->middleware('auth');


Route::get('admin_luxury_experiences', 'LuxuryExperiencesController@index')->middleware('auth');

Route::get('admin_luxury_experience_new', 'LuxuryExperiencesController@newExperiences')->middleware('auth');

Route::get('admin_luxury_experience_edit/{id}', 'LuxuryExperiencesController@editExperiences')->middleware('auth');

Route::get('admin_luxury_experience_delete/{id}', 'LuxuryExperiencesController@delete')->middleware('auth');

Route::post('admin_luxury_experience_store', 'LuxuryExperiencesController@store')->middleware('auth');

Route::post('admin_luxury_experience_update', 'LuxuryExperiencesController@update')->middleware('auth');

Route::post('admin_upload_luxury_experience_gallery', 'LuxuryExperiencesController@upload')->middleware('auth');

Route::get('admin_luxury_experiences_requests', 'LuxuryExperiencesController@requests')->middleware('auth');

Route::post('admin_luxury_experience_update_admin', 'LuxuryExperiencesController@updateAdmin')->middleware('auth');

Route::post('admin_luxury_experience_update_status', 'LuxuryExperiencesController@updateStatus')->middleware('auth');



Route::get('admin_rentals', 'RentalsController@index')->middleware('auth');

Route::get('admin_rental_new', 'RentalsController@newRentals')->middleware('auth');

Route::get('admin_rental_edit/{id}', 'RentalsController@editRentals')->middleware('auth');

Route::post('admin_rental_store', 'RentalsController@store')->middleware('auth');

Route::post('admin_rental_delete', 'RentalsController@delete')->middleware('auth');

Route::post('admin_rental_update', 'RentalsController@update')->middleware('auth');

Route::post('admin_upload_rental_gallery', 'RentalsController@upload')->middleware('auth');

Route::get('admin_rentals_requests', 'RentalsController@requests')->middleware('auth');

Route::post('admin_rental_update_admin', 'RentalsController@updateAdmin')->middleware('auth');

Route::post('admin_rental_update_status', 'RentalsController@updateStatus')->middleware('auth');



Route::post('get_state', 'RentalsController@getState')->middleware('auth');

Route::post('get_code', 'RentalsController@getCode')->middleware('auth');


Route::get('admin_customers', 'CustomersController@activeCustomers')->middleware('auth');

Route::get('admin_customers_new', 'CustomersController@NewCustomer')->middleware('auth');

Route::get('admin_customers_delete/{id}', 'CustomersController@deleteCustomers')->middleware('auth');

Route::post('admin_customers_store', 'CustomersController@AddCustomer')->middleware('auth');

Route::get('admin_guests', 'CustomersController@guestCustomers')->middleware('auth');

Route::get('admin_guests_delete/{id}', 'CustomersController@deleteCustomers')->middleware('auth');

Route::get('admin_guests_new', 'CustomersController@guestsNew')->middleware('auth');

Route::post('admin_guests_store', 'CustomersController@store')->middleware('auth');

Route::get('admin_merchant_category_new', 'MerchantCategoriesController@newMerchantCategory')->middleware('auth');

Route::get('admin_merchant_categories', 'MerchantCategoriesController@index')->middleware('auth');

Route::post('admin_merchant_categories_store', 'MerchantCategoriesController@store')->middleware('auth');

Route::get('admin_merchant_categories_delete/{id}', 'MerchantCategoriesController@delete')->middleware('auth');

Route::get('admin_merchant_categories_edit/{id}', 'MerchantCategoriesController@edit')->middleware('auth');

Route::post('admin_merchant_categories_update', 'MerchantCategoriesController@updateNew')->middleware('auth');

Route::get('admin_merchants', 'MerchantsController@index')->middleware('auth');

Route::get('admin_subscriptions', 'SubscriptionsController@index')->middleware('auth');

Route::get('admin_subscriptions_new', 'SubscriptionsController@ViewSub')->middleware('auth');

Route::post('admin_sub_store', 'SubscriptionsController@store')->middleware('auth');

Route::post('admin_sub_update', 'SubscriptionsController@update')->middleware('auth');

Route::get('admin_merchants_offers', 'MerchantOffersController@index')->middleware('auth');

Route::get('admin_merchant_new', 'MerchantsController@newMerchant')->middleware('auth');

Route::get('admin_merchant_delete/{id}', 'MerchantsController@delete')->middleware('auth');

Route::post('admin_offer_tag_store', 'MerchantOffersController@addTag')->middleware('auth');

Route::get('admin_offer_tag_delete/{id}/{offer_id}', 'MerchantOffersController@deleteTag')->middleware('auth');

Route::get('admin_offer_new', 'MerchantOffersController@newOffer')->middleware('auth');

Route::get('admin_offers_new/{id}', 'MerchantOffersController@NewOffer')->middleware('auth');

Route::post('admin_offer_store', 'MerchantOffersController@store')->middleware('auth');

Route::get('admin_offer_edit/{id}', 'MerchantOffersController@edit')->middleware('auth');

Route::post('admin_offer_update', 'MerchantOffersController@update')->middleware('auth');

Route::get('admin_offer_delete/{id}', 'MerchantOffersController@delete')->middleware('auth');

Route::post('admin_merchant_store', 'MerchantsController@store')->middleware('auth');

Route::get('admin_merchant_edit/{id}', 'MerchantsController@edit')->middleware('auth');

Route::post('admin_merchant_update', 'MerchantsController@update')->middleware('auth');

Route::post('admin_upload_merchant_gallery', 'MerchantsController@upload')->middleware('auth');

Route::get('admin_delete_merchant_image/{id}', 'MerchantsController@deleteImage')->middleware('auth');

Route::get('admin_delete_group_image/{id}', 'GroupsController@deleteImage')->middleware('auth');

Route::get('admin_delete_event_image/{id}', 'EventsController@deleteImage')->middleware('auth');

Route::get('admin_delete_experience_image/{id}', 'ExperiencesController@deleteImage')->middleware('auth');

Route::get('admin_delete_luxury_image/{id}', 'LuxuryExperiencesController@deleteImage')->middleware('auth');

Route::get('admin_delete_rental_image/{id}', 'RentalsController@deleteImage')->middleware('auth');



Route::get('admin_activate_account/{id}', 'AdminsController@activateAccount')->middleware('auth');

Route::get('admin_deactivate_account/{id}', 'AdminsController@deactivateAccount')->middleware('auth');

Route::get('admin_admin_new', 'AdminsController@newAdmin')->middleware('auth');

Route::post('admin_admin_store', 'AdminsController@store')->middleware('auth');

Route::post('admin_login', 'UsersController@adminAuthenticate');

Route::get('logout', 'UsersController@logout');

Route::get('admin_rencategories', 'RentalsCategoriesController@index')->middleware('auth');

Route::get('admin_rencategories_delete/{id}', 'RentalsCategoriesController@delete')->middleware('auth');

Route::post('admin_rencategories_store', 'RentalsCategoriesController@store')->middleware('auth');

Route::post('admin_rencategories_update', 'RentalsCategoriesController@update')->middleware('auth');


Route::get('admin_dcategories', 'DonationCategoriesController@index')->middleware('auth');

Route::post('admin_dcategories_store', 'DonationCategoriesController@store')->middleware('auth');

Route::post('admin_dcategories_update', 'DonationCategoriesController@update')->middleware('auth');

Route::post('admin_dcategories_delete', 'DonationCategoriesController@delete')->middleware('auth');


Route::get('admin_vcategories', 'VolunteerCategoriesController@index')->middleware('auth');

Route::post('admin_categories_store', 'VolunteerCategoriesController@store')->middleware('auth');

Route::post('admin_categories_update', 'VolunteerCategoriesController@update')->middleware('auth');

Route::post('admin_categories_delete', 'VolunteerCategoriesController@delete')->middleware('auth');

Route::get('admin_tags', 'TagsController@index')->middleware('auth');

Route::post('admin_tag_store', 'TagsController@store')->middleware('auth');

Route::get('admin_tag_delete/{id}', 'TagsController@delete')->middleware('auth');

Route::post('admin_tag_update', 'TagsController@update')->middleware('auth');

Route::get('admin_travel_concierge', 'TravelConciergeController@requests')->middleware('auth');

Route::post('admin_travel_concierge_update_admin', 'TravelConciergeController@updateAdmin')->middleware('auth');

Route::post('admin_travel_concierge_update_status', 'TravelConciergeController@updateStatus')->middleware('auth');

Route::get('admin_experiences_requests', 'ExperiencesController@requests')->middleware('auth');

Route::post('admin_experience_update_admin', 'ExperiencesController@updateAdmin')->middleware('auth');

Route::post('admin_experience_update_status', 'ExperiencesController@updateStatus')->middleware('auth');

Route::get('admin_beyond_request', 'BeyondController@requests')->middleware('auth');

Route::post('admin_beyond_update_admin', 'BeyondController@updateAdmin')->middleware('auth');

Route::post('admin_beyond_update_status', 'BeyondController@updateStatus')->middleware('auth');

Route::get('admin_personal_request', 'PersonalStylingController@requests')->middleware('auth');

Route::post('admin_personal_update_admin', 'PersonalStylingController@updateAdmin')->middleware('auth');

Route::post('admin_personal_update_status', 'PersonalStylingController@updateStatus')->middleware('auth');

Route::get('admin_home_request', 'HomeStylingController@requests')->middleware('auth');

Route::post('admin_home_update_admin', 'HomeStylingController@updateAdmin')->middleware('auth');

Route::post('admin_home_update_status', 'HomeStylingController@updateStatus')->middleware('auth');

Route::get('admin_bridal_request', 'BridalStylingController@requests')->middleware('auth');

Route::post('admin_bridal_update_admin', 'BridalStylingController@updateAdmin')->middleware('auth');

Route::post('admin_bridal_update_status', 'BridalStylingController@updateStatus')->middleware('auth');

Route::get('guest_activate_account/{id}', 'CustomersController@activateAccount')->middleware('auth');

Route::get('guest_deactivate_account/{id}', 'CustomersController@deactivateAccount')->middleware('auth');

Route::get('admin_subscription_create/{id}', 'SubscriptionsController@DoSub')->middleware('auth');

Route::get('admin_customers_history/{id}', 'CustomersController@customerHistory')->middleware('auth');

Route::get('admin_bespoke_product_delete/{id}', 'BespokeProductsController@delete')->middleware('auth');

Route::get('admin_delete_bespoke_image/{id}', 'BespokeProductsController@deleteImage')->middleware('auth');


