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
|
*/

use App\Http\Controllers\AcademiesController;
use App\Http\Controllers\ManagmentPlayersAndCoachesController;
use App\Http\Controllers\ManagmentUpdateByClubController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\ElectronicServicesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NationalTeamsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlayersController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/', function () {
    $locale = Cookie::get('locale');

    if (isset($locale) && $locale != Null && array_key_exists($locale, config('app.locales'))) {
        App::setLocale($locale);

        return redirect("/" . $locale);
    } else {
        App::setLocale(config('app.fallback_locale'));
        Cookie::queue('locale', App::getLocale());

        return redirect("/" . config('app.fallback_locale'));
    }
});


Route::group(['prefix' => '{locale}', 'middleware' => 'language'], function () {

    Route::get('change/{locale2}', function ($locale, $new) {

        $uri = parse_url(URL::previous())['path'];
        $segments = explode('/', $uri);
        if (isset($segments[3])) {
            unset($segments[0]);
            unset($segments[1]);
            unset($segments[2]);
            $segments[3] = $new;
            return Redirect::to(url(implode("/", $segments)));
        } else {
            return Redirect::to(url('/' . $new));
        }
    });
//    Route::get('/downloadPdf',[HomeController::class, 'downloadPdf']);
    Route::get('/', [HomeController::class, 'index']);
    Route::post('/', [HomeController::class, 'postSubscribe']);

    // Auth Routes
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('flush-session', [HomeController::class, 'flushSession']);
    // Auth Routes
    // Route::get('login', [LoginController::class, 'index'])->name('login');
    // Route::post('login', [LoginController::class, 'login']);
    // Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('register', [RegisterController::class, 'register']);
    route::get('passwords/resets/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
    route::post('password/email', [ForgotPasswordController::class, 'sendEmail']);
    route::post('password/reset', [ResetPasswordController::class, 'resetPassword']);
    Route::get('thanks', [ResetPasswordController::class, 'thanks']);

    // My account
    Route::get('/myaccount/{slug?}/{id?}/{id1?}',[RegisterController::class,'account']);
    Route::get('profile/addPlayerClub', [ManagmentPlayersAndCoachesController::class ,'getFormPlayerClub']);
    Route::get('profile/addCoachClub', [ManagmentPlayersAndCoachesController::class ,'getFormCoachClub']);
    Route::get('profile/addManagerClub', [ManagmentPlayersAndCoachesController::class ,'getFormManagerClub']);
    Route::post('register/managment', [ManagmentPlayersAndCoachesController::class ,'registerMangment']);

    Route::get('profile/editPlayerClub/{id}', [ManagmentUpdateByClubController::class ,'getFormEditPlayerClub']);
    Route::get('profile/editCoachClub/{id}', [ManagmentUpdateByClubController::class ,'getFormEditCoachClub']);
    Route::get('profile/editManagerClub/{id}', [ManagmentUpdateByClubController::class ,'getFormEditManagerClub']);

    Route::put('update/managment/{id}', [ManagmentUpdateByClubController::class ,'saveUpdateMangment']);
    Route::POST('delet-player-request/{id}',[ManagmentUpdateByClubController::class,'deletePlayerRequest']);
    Route::POST('delet-coach-request/{id}',[ManagmentUpdateByClubController::class,'deleteCoachRequest']);
    Route::POST('delet-manager-request/{id}',[ManagmentUpdateByClubController::class,'deleteManagerRequest']);

    // profile
    Route::get('profile/password', [ProfileController::class ,'change_password']);
    Route::post('profile/password/store', [ProfileController::class ,'store_password']);
    Route::get('profile/edit/{id}', [ProfileController::class ,'edit_profile']);
    Route::put('profile/edit/{id}', [ProfileController::class ,'save_profile']);
    Route::post('profile/storage-image-from-url', [ProfileController::class ,'storageImageFromUrl']);
    Route::post('profile/delete-storage-image-from-url', [ProfileController::class ,'deleteStorageImageFromUrl']);

    Route::get('profile/editPlayerByClient/{id}', [ProfileController::class ,'edit_Player_ByClient_profile']);
    Route::put('profile/editPlayerByClient/{id}', [ProfileController::class ,'save_Player_ByClient_profile']);

    Route::get('profile/getClubCoachDetailsAjax', [ProfileController::class ,'getClubCoachDetailsAjax']);
    Route::get('profile/getClubPlayerDetailsAjax', [ProfileController::class ,'getClubPlayerDetailsAjax']);
    Route::get('profile/getClubPlayerEventsDetailsAjax', [ProfileController::class ,'getClubPlayerEventsDetailsAjax']);
    Route::get('profile/getPlayerTeamDetailsAjax', [ProfileController::class ,'getPlayerTeamDetailsAjax']);
    Route::post('profile/clubGetTeamDetailsAjax', [ClubsController::class ,'clubGetTeamDetailsAjax']);
    Route::get('profile/renderClubFormAjax', [ClubsController::class ,'renderClubFormAjax']);
    Route::post('profile/clubRegisterNewPlayerAjax', [ClubsController::class ,'clubRegisterNewPlayerAjax']);
    Route::get('profile/renderAllPlayerClubParticipantsAjax', [ClubsController::class ,'renderAllPlayerClubParticipantsAjax']);
    Route::get('profile/renderClubEditFormAjax/{teamId}', [ClubsController::class ,'renderClubEditFormAjax']);
    Route::post('profile/academyGetTeamDetailsAjax', [AcademiesController::class ,'academyGetTeamDetailsAjax']);
    Route::get('profile/renderAcademyFormAjax', [AcademiesController::class ,'renderAcademyFormAjax']);
    Route::post('profile/academyRegisterNewPlayerAjax', [AcademiesController::class ,'academyRegisterNewPlayerAjax']);
    Route::get('profile/renderAllPlayerAcademyParticipantsAjax', [AcademiesController::class ,'renderAllPlayerAcademyParticipantsAjax']);
//    Route::post('profile/send-client-team-request',[ProfileController::class,'sendClientTeamRequests']);
//    Route::post('profile/leave-player-team-request', [ProfileController::class ,'leavePlayerTeamRequestAjax']);
    Route::post('profile/playerTeamRequest', [ProfileController::class ,'playerTeamRequestAjax']);
    Route::get('profile/getPlayerRequestsAjax', [ProfileController::class ,'getPlayerRequestsAjax']);
    Route::get('profile/getPlayerInvitationsAjax', [ProfileController::class ,'getPlayerInvitationsAjax']);
    Route::post('profile/searchAcceptedPlayerAjax', [ProfileController::class ,'searchAcceptedPlayerAjax']);
    Route::get('profile/renderPlayerFormAjax', [ProfileController::class ,'renderPlayerFormAjax']);
    Route::get('profile/renderPlayerEditFormAjax', [ProfileController::class ,'renderPlayerEditFormAjax']);
    Route::post('profile/updateTeamInfoAjax', [ProfileController::class ,'updateTeamInfoAjax']);
    Route::post('profile/playerRegisterNewPlayerAjax', [ProfileController::class ,'playerRegisterNewPlayerAjax']);
    Route::post('profile/playerAcceptInvitationAjax', [ProfileController::class ,'playerAcceptInvitationAjax']);
    Route::post('upload', [ProfileController::class ,'upload']);


//     // Complaints
//     Route::post('complaint', [ProfileController::class ,'submitComplaint']);
//     Route::post('complaint/{id}', [ProfileController::class ,'complaint_details']);

//     // Client Orders
//     Route::post('order/{group_id}', [ProfileController::class ,'order_details']);

//     // Products
//     Route::get('category/{id}/products', [ProductsController::class, 'index']);
//     Route::get('category/{id}', [ProductsController::class, 'categories']);
//     Route::get('products/{id}/{slug?}', [ProductsController::class, 'view']);

//     Route::get('user/{id}', [UsersController::class, 'profile']);
//     Route::get('user/edit/{id}', [UsersController::class, 'edit_profile']);
//     Route::put('user/edit/{id}', [UsersController::class, 'save_profile']);
// //    Route::post('upload', [UsersController::class, 'upload']);

//     Route::get('covers', [ProductsController::class, 'covers']);
//     Route::get('custom-covers/{id}/{slug}', [ProductsController::class, 'custom_covers']);
//     Route::post('ajax-custom-covers', [OrdersController::class, 'ajax_custom_covers']);
//     Route::get('covers-type/{id}', [ProductsController::class, 'covers_type']);
// //    Route::get('custom-hangers', [ProductsController::class, 'custom_hangers_product']);
//     Route::get('custom-hanger-details/{id}', [ProductsController::class, 'custom_hangers_product']);
//     Route::get('hangers-type/{id}', [ProductsController::class, 'hangers_type']);

//     Route::group(['prefix' => 'products'], function () {
//         Route::get('ready-hangers', [ProductsController::class, 'ready_hangers_product']);
//         Route::get('ready-hanger-details', [ProductsController::class, 'ready_hanger_details']);
//         // Route::get('custom-hangers', [ProductsController::class, 'custom_hangers_product']);
//         // Route::get('properties/{status}', [ProductsFrontController::class, 'products']);
//         // Route::get('properties/{status}/{category_id}/{id}', [ProductsFrontController::class, 'product_details']);
//         // Route::get('products/{category_id}/{slug}', [ProductsFrontController::class, 'index']);
//         // Route::get('products/load_ajax_list/{category_id}/{offset?}', [ProductsFrontController::class, 'get_ajax_products']);
//         // Route::get('products/{category_id}/{slug}/{id}/{item_slug}', [ProductsFrontController::class, 'view']);
//         // Route::get('products/new',[ProductsFrontController::class, 'newarrival']);
//         // Route::get('products/{slug}/{model_id}/{model_slug}',[ProductsFrontController::class, 'modelspro']);
//     });
    Route::group(['prefix' => 'clubs'],function(){
        Route::get('/' , [ClubsController::class, 'index']);
        Route::get('/{id}/details', [ClubsController::class, 'view']);
    });

    Route::group(['prefix' => 'academies'],function(){
        Route::get('/' , [AcademiesController::class, 'index']);
        Route::get('/{id}/details', [AcademiesController::class, 'view']);
    });

    Route::group(['prefix' => 'national-teams'],function(){
        Route::get('/games' , [NationalTeamsController::class, 'listGames']);
        Route::get('/games/{id}' , [NationalTeamsController::class, 'listTeamsByGames']);
        Route::get('/Categories/{id}' , [NationalTeamsController::class, 'listTeamsByCategories']);
        Route::get('/' , [NationalTeamsController::class, 'index']);
        Route::get('/{id}/view', [NationalTeamsController::class, 'detailsTeams']);
    });

    /*     Route::group(['prefix' => 'electronic-services'],function(){
        Route::get('/individually',[ElectronicServicesController::class,'getIndividually']);
        // Route::get('/individually/register',[ElectronicServicesController::class,'getIndividuallyRegister']);
        Route::get('individually/{slug?}/details',[ElectronicServicesController::class,'getIndividuallydetails']);
        Route::get('/institutions',[ElectronicServicesController::class,'getInstitutions']);
        // Route::get('/institutions/register', [ElectronicServicesController::class, 'getInstitutionsRegister']);
        Route::get('/{slug?}/details',[ElectronicServicesController::class,'getInstitutionsdetails']);
        Route::get('/requests-permission',[ElectronicServicesController::class,'getRequestsAndPermission']);
        Route::get('/{slug}',[ElectronicServicesController::class,'getElectronicOrders']);
    }); */
    Route::get('/online-services',[RegisterController::class,'account']);

    Route::post('send-noproblem-request',[ElectronicServicesController::class,'sendNoProblemRequest']);
    Route::get('show-noproblem-request/{id}',[ElectronicServicesController::class,'showNoProblemRequest']);
    Route::POST('delet-noproblem-request/{id}',[ElectronicServicesController::class,'deleteNoProblemRequest']);
    Route::put('send-noproblem-edit-request/{id}',[ElectronicServicesController::class,'editNoProblemRequest']);

    Route::post('send-certificate-request',[ElectronicServicesController::class,'sendCertificateRequest']);
    Route::get('show-certificate-request/{id}',[ElectronicServicesController::class,'showCertificateRequest']);
    Route::post('delet-certificate-request/{id}',[ElectronicServicesController::class,'deleteCertificateRequest']);
    Route::put('send-certificate-edit-request/{id}',[ElectronicServicesController::class,'editCertificateRequest']);

    Route::post('send-organization-request',[ElectronicServicesController::class,'sendOrganizationRequest']);
    Route::get('show-organization-request/{id}',[ElectronicServicesController::class,'showOrganizationRequest']);
    Route::put('delet-organization-request/{id}',[ElectronicServicesController::class,'deleteOrganizationRequest']);
    Route::put('send-organization-edit-request/{id}',[ElectronicServicesController::class,'sendEditOrganizationRequest']);

    Route::get('download-certification/{id}',[ElectronicServicesController::class,'downloadCertification']);
    Route::get('show-certification',[ElectronicServicesController::class,'downloadMembershipcertificate']);
    Route::get('show-certification/Membershipcertificate',[ElectronicServicesController::class,'downloadMembershipcertificate']);
    Route::get('show-certification/noProblemcertificate/{id}',[ElectronicServicesController::class,'downloadNoProblemCertificate']);
    Route::get('membership-card-printing',[ElectronicServicesController::class,'membershipCardPrinting']);


    Route::post('send-article-request',[ArticlesController::class,'sendArticleRequest']);
    Route::post('send-article-edit-request',[ArticlesController::class,'EditArticleRequest']);

    Route::get('show-article-request/{id}',[ArticlesController::class,'showArticleRequest']);
    Route::post('delet-article-request/{id}',[ArticlesController::class,'deleteArticleRequest']);
    Route::post('ckeditor/upload',[ArticlesController::class,'ckeditorUpload'])->name('ckeditor.upload');

    Route::group(['prefix' => 'events'], function() {
        Route::get('/{id}/{slug}',[EventsController::class,'index']);
        Route::get('/{slug}/{id}/view',[EventsController::class,'view']);
        Route::get('/{eventClassificationId}/{id}/view',[EventsController::class,'view']);
        Route::post('/subscribe-event/{id}',[EventsController::class,'subscribeEvent']);
        Route::get('/calendar',[EventsController::class,'eventCalendar']);
    });

    Route::group(['prefix' => 'register'],function() {
        // Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/', [RegisterController::class, 'register']);
        Route::get('/player',[ElectronicServicesController::class,'registerPlayer']);
//        Route::post('/player',[HomeController::class, 'downloadPdf']);
        Route::get('/follower',[ElectronicServicesController::class,'registerFollower']);
        Route::get('/coach',[ElectronicServicesController::class,'registerCoach']);
        Route::get('/judgment',[ElectronicServicesController::class,'registerJudgment']);
        Route::get('/club',[ElectronicServicesController::class,'registerClub']);
        Route::get('/academy',[ElectronicServicesController::class,'registerAcademy']);
        Route::get('/sport-services-company',[ElectronicServicesController::class,'registerSportServicesCompany']);
        Route::get('/content-writer',[ElectronicServicesController::class,'registerContentWriter']);
        Route::get('/commentator',[ElectronicServicesController::class,'registerCommentator']);

        // Route::post('/platform/add',[ElectronicServicesController::class,'addPlatform']);
        Route::get('/platform/add/{name}',[ElectronicServicesController::class,'addPlatform']);
        Route::get('/games/add/{name}',[ElectronicServicesController::class,'addGames']);
    });
    Route::group(['prefix' => 'articles'] , function(){
        // Route::get('/new/{slug}',[ArticlesController::class,'get_new_writer_articles']);
        // Route::get('/new/get_all_ajax_articles/{offset}',[ArticlesController::class,'get_ajax_new_writer_articles']);
        // Route::get('/{slug}',[ArticlesController::class,'all']);
        // Route::post('/get_all_ajax_articles/{offset}', [ArticlesController::class,'getAjaxAllArticles']);

        // Route::get('research/{slug}',[ArticlesController::class,'get_research_articles'])->middleware('auth');
        // Route::post('research/{offset?}',[ArticlesController::class,'get_research_data'])->middleware('auth');

		Route::get('/',[BlogsController::class,'index']);
		Route::get('/create',[BlogsController::class,'getSubmitBlogs']);
		Route::get('/{id}/view',[BlogsController::class,'view']);

		// Route::get('/{type_id}/{slug}',[ArticlesController::class,'index']);
        // Route::any('/get_ajax_articles/{news_type_id}/{offset}', [ArticlesController::class,'getAjaxArticles']);
        // Route::get('/{type_id}/{slug}/{id}/{news_slug}',[ArticlesController::class,'view']);
    });

    // Route::post('/upload',[ArticlesController::class,'uploadImage'])->name('ckeditor.upload');

    Route::group(['prefix' => 'news'] , function(){
        Route::get('/',[ArticlesController::class,'index']);
        Route::get('/{id}/view',[ArticlesController::class,'view']);
    });

    Route::group(['prefix' => 'players'] , function(){
        Route::get('/',[PlayersController::class,'index']);
        Route::get('/{id}/view',[PlayersController::class,'view']);
    });


    Route::get('/media/gallery/{slug?}',[ArticlesController::class,'get_galleries']);
    Route::get('/media/gallery/{id}/view',[ArticlesController::class,'view_gallery']);
    Route::get('/media/videos/{slug?}',[ArticlesController::class,'get_videos']);


    // Route::get('/media/videos/{slug?}',[ArticlesController::class,'get_videos']);

//     // Cart
//     Route::get('cart', [OrdersController::class, 'shoppingCarts']);
//     Route::post('add-to-cart/{id}', [OrdersController::class, 'addToCart']);
//     Route::get('remove-cart/{id}', [OrdersController::class, 'removeCartItem']);
//     Route::post('update-cart/{id}', [OrdersController::class, 'update'])->name('cart.update');
//     Route::post('update-property/{id}', [OrdersController::class, 'updateProperty']);
//     Route::post('charge', [OrdersController::class, 'charge']);
//     Route::get('empty-cart', [OrdersController::class, 'emptyCart']);
//     // Wishlist
//     Route::get('wishlist', [OrdersController::class, 'wishlist']);
//     Route::post('add-to-wishlist/{id}', [OrdersController::class, 'addToWishlist']);
//     Route::get('remove-wishlist/{id}', [OrdersController::class, 'removeWishlistItem']);
//     Route::get('empty-wishlist', [OrdersController::class, 'emptyWishlist']);
//     // Checkout
//     Route::get('checkout', [OrdersController::class, 'checkout']);
//     Route::post('checkout', [OrdersController::class, 'submitCheckout']);

//     Route::get('/home', [HomeController::class, 'index']);
    Route::get('pages/{slug?}', [PagesController::class, 'index']);
    Route::get('pages/{id?}', [PagesController::class, 'index']);



    Route::get('terms-service/{id?}', [PagesController::class, 'index1']);
    Route::get('privacy-policy/{id?}', [PagesController::class, 'index1']);


    Route::get('contact', [PagesController::class, 'contact']);
    Route::post('contact/send-mail', [PagesController::class , 'sendMail']);

});




// Route::get('ckeditor', 'ArticlesController@index');

// Route::post('ckeditor/upload', 'ArticlesController@upload')->name('ckeditor.upload');


Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });
