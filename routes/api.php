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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get list of feeds
Route::post('feeds','FeedsController@getFeeds');
// get specific feed
Route::post('feed/{id}','FeedsController@singleFeed');
//get Donation Categories
Route::post('donation_categories','DonationCategoriesController@getDonCat');
//get donations based on category_id from donation categories
Route::post('donation_categories/{id}','DonationsController@getDonations');
//fetch doantion details
Route::post('donation/{id}', 'DonationsController@fetchDonation');
//get Volunteer Categories
Route::post('volunteer_categories','VolunteerCategoriesController@getVonCat');
//get volunteers based on category_id from volunteer categories
Route::post('volunteer_categories/{id}','VolunteersController@getVolunteers');
//single volunteer
Route::post('volunteer/{id}', 'VolunteersController@fetchVolunteer');
//get all events
Route::post('events', 'EventsController@showEvents');
//get single event
Route::post('event/{id}','EventsController@show');
//get experience categories
Route::post('experiences_categories', 'ExperiencesController@getExpcategories');
//get all experiences
Route::post('experiences/{id}', 'ExperiencesController@getExperiences');
//get single experience
Route::post('experience/{id}', 'ExperiencesController@singleExp');
//get rentals
Route::post('rentals/{id}', 'RentalsController@getRentals');
//get rentals categories
Route::post('rentals_categories', 'RentalsController@getCategories');
//get single rental
Route::post('rental/{id}', 'RentalsController@fetchItem');
//Save Rental Request
Route::post('rental_request/store', 'RentalsController@saveRequest');
//get exclusive offers categories
Route::post('exclusive_offers_categories', 'MerchantOffersController@getcategories');
//get merchant related to categories using category_id
Route::post('exclusive_offer/{id}', 'MerchantOffersController@getOffers');
//get offers related to merchants using merchant_id
Route::get('offers/{id}', 'MerchantOffersController@getOffer');
//get above offer details
Route::get('offer/{id}', 'MerchantOffersController@showOffer');
//Display merchant with name
Route::get('merchants', 'MerchantOffersController@getMerchant');
//get single merchant
Route::get('merchant_details/{id}', 'MerchantOffersController@singleMerchant');
//check subscription
Route::get('customers/verify_validity/{id}/{offer_id}', 'SubscriptionsController@checkSub');
//Save transaction
Route::post('transaction', 'SubscriptionsController@PostTrans');
//Customer Interest
Route::post('customer_interest/{id}', 'GroupsController@myInterest');
//customer_details
Route::post('customer_details/{id}', 'CustomersController@fetch');
//Get Shop Categories
Route::post('shop_categories', 'BespokeProductsController@getcategories');
//Get Shop Items based on category id
Route::post('shop_categories/{id}', 'BespokeProductsController@ViewShop');
//Get single item detail with gallery images
Route::post('product/{id}', 'BespokeProductsController@Single');
//Luxury travel
Route::post('luxury_travel','LuxuryExperiencesController@getTravel');
//SIngle Luxury travel
Route::post('luxury_travel/{id}','LuxuryExperiencesController@getSingle');
//flight booking
Route::post('flight_booking', 'FlightBookingsController@saveBooking');
//airport concierge
Route::post('airport_concierge', 'AirportConciergeController@saveConcierge');
//bespoke travel
Route::post('bespoke_travel', 'BespokeTravelsController@saveTravel');
// travel concierge
Route::post('travel_concierge', 'TravelConciergeController@storeConcierge');
//bridal styling
Route::post('styling/bridal_styling', 'BridalStylingController@storeBridal');
//home styling
Route::post('styling/home_styling', 'HomeStylingController@storeHome');
//personal styling
Route::post('styling/personal_styling', 'PersonalStylingController@storePersonal');
//and beyond
Route::post('and_beyond', 'BeyondController@saveBeyond');
//event ticket categories
Route::post('tickets/categories', 'VipEventCategoriesController@getCategories');
//event to ccategory using category_id
Route::post('tickets/events/{id}', 'GlobalEventsController@events_to_category');
//single event using event_id
Route::post('tickets/single/{id}', 'GlobalEventsController@single_ticket_event');
//Buy ticket to event
Route::post('tickets/buy', 'GlobalEventsController@buyTicket');
//vip access category 
Route::post('access/categories', 'PrivatePartiesController@getcategories');
//event to category in access
Route::post('access/events/{id}', 'PrivatePartiesController@events_to_category');
//event details
Route::post('access/single/{id}', 'PrivatePartiesController@single_event');
//access request
Route::post('access/request', 'PrivatePartiesController@makeRequest');
//Customer Vpa
Route::post('vpa/send_request', 'VpasController@postRequest');
//Get Interest Group details, Group Post and Event attached to the Group
Route::post('join/{id}/{customer_id}', 'GroupsController@get_details_group');
//Group Joining
Route::get('member_join/{id}/{customer_id}', 'GroupsController@be_a_member');
//Leave Group
Route::get('member_leave/{id}/{customer_id}', 'GroupsController@leave_a_group');

//authentication and logout
Route::group(['middleware' => ['api']], function () {
    Route::post('auth/login', 'ApiController@login');
    Route::post('auth/logout', 'ApiController@logout');
    Route::get('auth/user', 'ApiController@getAuthUser');
});
//Registration 
Route::post('auth/signup', 'ApiController@signup');
//interest groups
Route::get('interests', 'GroupsController@getInterest');
//interest groups post pass group id
Route::get('interests/{id}', 'EventsController@getPosts');
//single group post with gallery
Route::get('interest/{id}', 'EventsController@getSingle');
//reset password
Route::post('auth/reset_password', 'ApiController@resetMail');
//verify code
Route::post('auth/verify_code', 'ApiController@checkCode');
//Edit Profile
Route::post('auth/edit_profile', 'ApiController@editprofile');
//Change Password
Route::post('auth/change_password', 'ApiController@changepassword');
//Change Profile picture
Route::post('auth/changepic/{customer_id}', 'ApiController@changepic');
//membership type
Route::post('membership', 'ApiController@membership');
//save customer interest
Route::post('customer_interest', 'ApiController@saveInterest');
//save customer event
Route::post('customer_event', 'ApiController@saveEvent');
//save customer experience
Route::post('customer_experience', 'ApiController@saveExperience');
//save customer luxury experience
Route::post('customer_luxury', 'ApiController@saveLuxury');
//save contact ticket
Route::post('contact', 'ContactsController@saveTicket');

Route::post('test', 'ApiController@playTest');
//Home page Layout
Route::post('new_offers/{id}', 'TagsController@fetchProduct');

Route::post('social_wire/{id}', 'TagsController@SocialWire');

Route::post('get_post/{id}', 'TagsController@getPosts');
//change plan
Route::post('change_plan', 'SubscriptionsController@change_plan');
//Make Subscription 
Route::post('subscription', 'SubscriptionsController@MakeSubscription');
//Fetch User Subscription Status
Route::post('sub_details/{id}', 'SubscriptionsController@sub_details');
//Renew Plan
Route::post('renew_plan', 'SubscriptionsController@Renew_plan');
//save customer interest
Route::post('pick_interest/{customer_id}/{group_id}/{status}', 'ApiController@pickInterest');
//resend verification code
Route::post('resend_code/{email}', 'ApiController@ResendCode');
//bespoke product request
Route::post('bespoke_product_request', 'BespokeProductsController@saveRequest');
//Get user notifications
Route::post('notifications/{id}', 'ApiController@get_notif');
//read notif
Route::post('read_notification/{id}', 'ApiController@read_notif');
//redemption reviews
Route::post('reviews', 'SubscriptionsController@saveReviews');




