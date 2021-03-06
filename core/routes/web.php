<?php
/*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 */

// Public website
Route::get('/', '\Platform\Controllers\Website\WebsiteController@home')->name('home');

/*
 |--------------------------------------------------------------------------
 | Platform routes
 |--------------------------------------------------------------------------
 */

// JavaScript language vars
Route::get('assets/javascript', '\Platform\Controllers\App\AssetController@appJs');

// -----------------------------------------------------------------
// Plan limitation online.cards_visible
Route::group(['middleware' => 'limitation:online.cards_visible'], function () {

  // Card
  Route::get('card/{hash_id}', '\Platform\Controllers\Cards\RenderController@showCard');
  Route::get('card/{hash_id}/manifest.json', '\Platform\Controllers\Cards\RenderController@showManifest');
});

// Secured web routes
Route::group(['middleware' => 'auth:web'], function () {

  // Main layout
  Route::get('platform', '\Platform\Controllers\App\MainController@main')->name('main');

  /*
   |--------------------------------------------------------------------------
   | Partials
   |--------------------------------------------------------------------------
   */

  // Dashboard
  Route::get('platform/dashboard', '\Platform\Controllers\App\DashboardController@showDashboard');

  // Profile
  Route::get('platform/profile', '\Platform\Controllers\App\AccountController@showProfile');
  Route::post('platform/profile', '\Platform\Controllers\App\AccountController@postProfile');
  Route::post('platform/profile-avatar', '\Platform\Controllers\App\AccountController@postAvatar');
  Route::post('platform/profile-avatar-delete', '\Platform\Controllers\App\AccountController@postDeleteAvatar');

  // Connections
  Route::get('platform/connections', '\Platform\Controllers\App\AccountController@showConnections');

  // -----------------------------------------------------------------
  // Plan limitation account.plan_visible
  Route::group(['middleware' => 'limitation:account.plan_visible'], function () {

    // Plan
    Route::get('platform/plan', '\Platform\Controllers\App\AccountController@showPlan');
  });

  // Software apps
  Route::get('platform/software/app', '\Platform\Controllers\Software\AppController@showApp');

  // -----------------------------------------------------------------
  // Plan limitation online.visible
  Route::group(['middleware' => 'limitation:online.visible'], function () {

    // -----------------------------------------------------------------
    // Plan limitation online.members_visible
    Route::group(['middleware' => 'limitation:online.members_visible'], function () {

      // Members
      Route::get('platform/members', '\Platform\Controllers\Members\MemberController@showMembers');
      Route::get('platform/members/export', '\Platform\Controllers\Members\MemberController@getExport');
      Route::get('platform/members/data', '\Platform\Controllers\Members\MemberController@getMemberData');
      Route::get('platform/member/edit', '\Platform\Controllers\Members\MemberController@showEditMember');
      Route::post('platform/member/update', '\Platform\Controllers\Members\MemberController@postMember');
      Route::post('platform/member/delete', '\Platform\Controllers\Members\MemberController@postMemberDelete');
      Route::post('platform/member/upload-avatar', '\Platform\Controllers\Members\MemberController@postAvatar');
      Route::post('platform/member/delete-avatar', '\Platform\Controllers\Members\MemberController@postDeleteAvatar');
    });
  });

  // -----------------------------------------------------------------
  // Plan limitation mobile.visible
  Route::group(['middleware' => 'limitation:mobile.visible'], function () {

    // Campaign apps
    Route::get('platform/campaign/apps', '\Platform\Controllers\Campaign\AppController@showApps'); 
    Route::get('platform/campaign/apps/data', '\Platform\Controllers\Campaign\AppController@getAppData');
    Route::get('platform/campaign/app/new', '\Platform\Controllers\Campaign\AppController@showNewApp');
    Route::get('platform/campaign/app/edit', '\Platform\Controllers\Campaign\AppController@showEditApp');
    Route::post('platform/campaign/app/delete', '\Platform\Controllers\Campaign\AppController@postDelete');
    Route::post('platform/campaign/app/switch', '\Platform\Controllers\Campaign\AppController@postSwitch');
    Route::post('platform/campaign/app', '\Platform\Controllers\Campaign\AppController@postapp');
    Route::get('platform/campaign/apps/export', '\Platform\Controllers\Campaign\AppController@getExport'); 

    // Campaigns
    Route::get('platform/campaigns', '\Platform\Controllers\Campaign\CampaignController@showCampaigns'); 
    Route::get('platform/campaigns/data', '\Platform\Controllers\Campaign\CampaignController@getCampaignData');
    Route::get('platform/campaign/new', '\Platform\Controllers\Campaign\CampaignController@showNewCampaign');
    Route::get('platform/campaign/edit', '\Platform\Controllers\Campaign\CampaignController@showEditCampaign');
    Route::post('platform/campaign/delete', '\Platform\Controllers\Campaign\CampaignController@postDelete');
    Route::post('platform/campaign/switch', '\Platform\Controllers\Campaign\CampaignController@postSwitch');
    Route::post('platform/campaign', '\Platform\Controllers\Campaign\CampaignController@postCampaign');
    Route::get('platform/campaigns/export', '\Platform\Controllers\Campaign\CampaignController@getExport');

    // Campaign analytics
    Route::get('platform/campaign/analytics', '\Platform\Controllers\Analytics\CampaignAnalyticsController@showAnalytics');

    // Scenarios
    Route::get('platform/scenarios', '\Platform\Controllers\Location\ScenarioController@showEditScenarios');

    // -----------------------------------------------------------------
    // Plan limitation mobile.beacons_visible
    Route::group(['middleware' => 'limitation:mobile.beacons_visible'], function () {

      // Beacons
      Route::get('platform/beacons', '\Platform\Controllers\Location\BeaconController@showBeacons');
      Route::get('platform/beacons/data', '\Platform\Controllers\Location\BeaconController@getBeaconData');
      Route::get('platform/beacon/new', '\Platform\Controllers\Location\BeaconController@showNewBeacon');
      Route::get('platform/beacon/edit', '\Platform\Controllers\Location\BeaconController@showEditBeacon');
      Route::post('platform/beacon/delete', '\Platform\Controllers\Location\BeaconController@postDelete');
      Route::post('platform/beacon/switch', '\Platform\Controllers\Location\BeaconController@postSwitch');
      Route::post('platform/beacon', '\Platform\Controllers\Location\BeaconController@postBeacon');
      Route::get('platform/beacons/export', '\Platform\Controllers\Location\BeaconController@getExport');
      Route::post('platform/beacons/beacon-uuid', '\Platform\Controllers\Location\BeaconController@postBeaconUuid');
    });

    // -----------------------------------------------------------------
    // Plan limitation mobile.geofences_visible
    Route::group(['middleware' => 'limitation:mobile.geofences_visible'], function () {

      // Geofences
      Route::get('platform/geofences', '\Platform\Controllers\Location\GeofenceController@showGeofences'); 
      Route::get('platform/geofences/data', '\Platform\Controllers\Location\GeofenceController@getGeofenceData');
      Route::get('platform/geofence/new', '\Platform\Controllers\Location\GeofenceController@showNewGeofence');
      Route::get('platform/geofence/edit', '\Platform\Controllers\Location\GeofenceController@showEditGeofence');
      Route::post('platform/geofence/delete', '\Platform\Controllers\Location\GeofenceController@postDelete');
      Route::post('platform/geofence/switch', '\Platform\Controllers\Location\GeofenceController@postSwitch');
      Route::post('platform/geofence', '\Platform\Controllers\Location\GeofenceController@postGeofence');
      Route::get('platform/geofences/export', '\Platform\Controllers\Location\GeofenceController@getExport'); 
    });

    // Location group
    Route::post('platform/location-group/new', '\Platform\Controllers\Location\LocationController@postLocationGroup');

    // -----------------------------------------------------------------
    // Plan limitation mobile.geofences_visible
    Route::group(['middleware' => 'limitation:mobile.cards_visible'], function () {

      // Cards
      Route::get('platform/cards', '\Platform\Controllers\Location\CardController@showCards'); 
      Route::get('platform/cards/data', '\Platform\Controllers\Location\CardController@getCardData');
      Route::get('platform/card/new', '\Platform\Controllers\Location\CardController@showNewCard');
      Route::get('platform/card/edit', '\Platform\Controllers\Location\CardController@showEditCard');
      Route::post('platform/card/delete', '\Platform\Controllers\Location\CardController@postDelete');
      Route::post('platform/card/switch', '\Platform\Controllers\Location\CardController@postSwitch');
      Route::post('platform/card', '\Platform\Controllers\Location\CardController@postCard');
      Route::get('platform/cards/export', '\Platform\Controllers\Location\CardController@getExport'); 
    });
  });

  // -----------------------------------------------------------------
  // Plan limitation media.visible
  Route::group(['middleware' => 'limitation:media.visible'], function () {

    // Media
    Route::get('platform/media/browser', '\Platform\Controllers\App\MediaController@showBrowser');
    Route::get('platform/media/picker', '\Platform\Controllers\App\MediaController@showPicker');
    Route::any('elfinder/connector', '\Barryvdh\Elfinder\ElfinderController@showConnector');
    Route::get('elfinder/tinymce', '\Platform\Controllers\App\MediaController@showTinyMCE');
  });

  // For owners
  Route::group(['middleware' => 'role:owner'], function () {

    // Reseller management
    Route::get('platform/admin/resellers', '\Platform\Controllers\App\ResellerController@showResellers');
    Route::get('platform/admin/resellers/data', '\Platform\Controllers\App\ResellerController@getResellerData');
    Route::get('platform/admin/reseller/new', '\Platform\Controllers\App\ResellerController@showNewReseller');
    Route::post('platform/admin/reseller/new', '\Platform\Controllers\App\ResellerController@postNewReseller');
    Route::get('platform/admin/reseller/edit', '\Platform\Controllers\App\ResellerController@showEditReseller');
    Route::post('platform/admin/reseller/update', '\Platform\Controllers\App\ResellerController@postReseller');
    Route::post('platform/admin/reseller/delete', '\Platform\Controllers\App\ResellerController@postResellerDelete');
  });

  // For owners and admins
  Route::group(['middleware' => 'role:owner,reseller,admin'], function () {

    // User management
    Route::get('platform/admin/users', '\Platform\Controllers\App\UserController@showUsers');
    Route::get('platform/admin/users/data', '\Platform\Controllers\App\UserController@getUserData');
    Route::get('platform/admin/user/new', '\Platform\Controllers\App\UserController@showNewUser');
    Route::post('platform/admin/user/new', '\Platform\Controllers\App\UserController@postNewUser');
    Route::get('platform/admin/user/edit', '\Platform\Controllers\App\UserController@showEditUser');
    Route::post('platform/admin/user/update', '\Platform\Controllers\App\UserController@postUser');
    Route::post('platform/admin/user/delete', '\Platform\Controllers\App\UserController@postUserDelete');
    Route::post('platform/admin/user/upload-avatar', '\Platform\Controllers\App\UserController@postAvatar');
    Route::post('platform/admin/user/delete-avatar', '\Platform\Controllers\App\UserController@postDeleteAvatar');
    Route::get('platform/admin/user/login-as/{sl}', '\Platform\Controllers\App\UserController@getLoginAs');

    // Plan management
    Route::get('platform/admin/plans', '\Platform\Controllers\App\PlanController@showPlans');
    Route::get('platform/admin/plans/data', '\Platform\Controllers\App\PlanController@getPlanData');
    Route::get('platform/admin/plan/new', '\Platform\Controllers\App\PlanController@showNewPlan');
    Route::post('platform/admin/plan/new', '\Platform\Controllers\App\PlanController@postNewPlan');
    Route::get('platform/admin/plan/edit', '\Platform\Controllers\App\PlanController@showEditPlan');
    Route::post('platform/admin/plan/update', '\Platform\Controllers\App\PlanController@postPlan');
    Route::post('platform/admin/plan/delete', '\Platform\Controllers\App\PlanController@postPlanDelete');
    Route::post('platform/admin/plan/order', '\Platform\Controllers\App\PlanController@postPlanOrder');

    // Software apps
    Route::get('platform/admin/software/apps', '\Platform\Controllers\Software\AppController@showApps');
    Route::get('platform/admin/software/apps/data', '\Platform\Controllers\Software\AppController@getAppData');
    Route::get('platform/admin/software/app/new', '\Platform\Controllers\Software\AppController@showNewApp');
    Route::post('platform/admin/software/app/new', '\Platform\Controllers\Software\AppController@postApp');
    Route::get('platform/admin/software/app/edit', '\Platform\Controllers\Software\AppController@showEditApp');
    Route::post('platform/admin/software/app/update', '\Platform\Controllers\Software\AppController@postApp');
    Route::post('platform/admin/software/app/delete', '\Platform\Controllers\Software\AppController@postAppDelete');
    Route::post('platform/admin/software/app/order', '\Platform\Controllers\Software\AppController@postAppOrder');
  });
});

/*
 |--------------------------------------------------------------------------
 | Auth Platform
 |--------------------------------------------------------------------------
 */

// Login Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Registration Routes
if (\Config::get('auth.allow_registration', true)) {
  Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
  Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
}

// Password Reset Routes
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);

/*
 |--------------------------------------------------------------------------
 | Auth Members
 |--------------------------------------------------------------------------
 */

//Member Login
Route::get('member/login', 'AuthMember\LoginController@showLoginForm');
Route::post('member/login', 'AuthMember\LoginController@login');
Route::post('member/logout', 'AuthMember\LoginController@logout');
Route::get('member/logout', 'AuthMember\LoginController@logout');

//Member Register
Route::get('member/register', 'AuthMember\RegisterController@showRegistrationForm');
Route::post('member/register', 'AuthMember\RegisterController@register');

//Member Passwords
Route::post('member/password/email', 'AuthMember\ForgotPasswordController@sendResetLinkEmail');
Route::post('member/password/reset', 'AuthMember\ResetPasswordController@reset');
Route::get('member/password/reset', 'AuthMember\ForgotPasswordController@showLinkRequestForm');
Route::get('member/password/reset/{token}', 'AuthMember\ResetPasswordController@showResetForm');

// Reset everything
Route::get('reset/{key}', '\Platform\Controllers\App\InstallationController@reset');
?>