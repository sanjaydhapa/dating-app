<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\AdminUserDataController;
//use App\Http\Controllers\LogoutController;
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
use Kreait\Firebase\Factory;

Route::get('/firebase-test', function () {
   
   
   $firebase = (new Factory)
    ->withServiceAccount(config('firebase.credentials'))
    ->withDatabaseUri(config('firebase.projects.app.database.url'));

    $database = $firebase->createDatabase();
    
    $database->getReference('users/123')->set([
        'name' => 'Test User',
        'email' => 'test@example.com'
    ]);

    return 'Firebase connected and test data written!';
});


// clear route cache
Route::get('/clear-cache', function () {
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'clear successfully !';
});


/*
Route::group(['middleware'=>['web']],function(){
Route::get('/',[FrontController::class,'home'])->name('home');
Route::post('/send-message',[FrontController::class,'sendMessage'])->name('send.message');
Route::get('/sitemap.xml', [FrontController::class, 'SitemapXml']);
Route::get('/blog',[FrontController::class,'blog']);
Route::get('/blog/{slug}',[FrontController::class,'post']);
Route::get('/service/{slug}',[FrontController::class,'service']);

});
*/
//Route::get('/sitemap.xml', [FrontController::class, 'SitemapXml']);

//Route::get('/{slug}',[FrontController::class,'pages']);





Route::get('/', function () {
   
    return view('welcome'); 
});


/*================== Admin all routs =============================================*/

//, 'middleware'=>['admin:admin']
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'login'])->name('admin.login');
	
Route::group(['prefix'=> 'admin'], function(){
	//Route::get('/login', [AdminController::class, 'loginForm']);
	//Route::post('/login',[AdminController::class, 'login'])->name('admin.login');
    //Route::post('/logout',[AdminController::class,'destroy'])->name('admin.logout')->middleware('auth:admin');
});
Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
//Route::post('/logout',LogoutController::class)->name('logout')->middleware('auth:web');
Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password');
Route::post('/update/change/password',[AdminProfileController::class,'UpdateChangePassword'])->name('update.change.password');

//Route::middleware(['admin.auth', 'verified'])->get('/admin/dashboard', function () {
Route::group(['prefix'=> 'admin', 'middleware'=>['admin.auth']],function(){
    //print_r('expression');die;
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/settings',[SettingController::class,'generalSettings'])->name('view.setting');
});



Route::prefix('user')->middleware(['admin.auth'])->group(function () {

    // Use controller grouping for cleaner routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/view', 'view')->name('all.user');
        Route::get('/add', 'add')->name('add.user');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/update', 'update')->name('user.update');
        Route::get('/delete/{id}', 'delete')->name('user.delete');

        // Toggle actions
        Route::get('{id}/toggle-verify', 'toggleVerify')->name('user.toggleVerify');
        Route::get('{id}/toggle-freeze', 'toggleFreeze')->name('user.toggleFreeze');
        Route::get('{id}/toggle-status', 'toggleStatus')->name('user.toggleStatus');
    });
});

// Routes for DataTables AJAX
Route::get('users/list', [UserController::class, 'index'])->name('users.list');
Route::get('users/data', [UserController::class, 'getData'])->name('users.data');

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/contact/messages', [ContactController::class, 'listMessages'])->name('admin.contact.list');
    Route::get('/contact/messages/{id}/reply', [ContactController::class, 'replyForm'])->name('admin.contact.replyForm');
    Route::post('/contact/messages/{id}/reply', [ContactController::class, 'sendReply'])->name('admin.contact.sendReply');
});

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('user-data', [AdminUserDataController::class, 'index'])->name('admin.userdata.index');
    Route::get('user-data/create', [AdminUserDataController::class, 'create'])->name('admin.userdata.create');
    Route::post('user-data/store', [AdminUserDataController::class, 'store'])->name('admin.userdata.store');
    Route::delete('user-data/{id}', [AdminUserDataController::class, 'destroy'])->name('admin.userdata.destroy');
});


/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

*/