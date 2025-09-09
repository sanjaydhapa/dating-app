<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashbaordController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FirebaseController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UserDataController;
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

Route::post('request-register', [AuthController::class, 'requestOtpForRegistration']);
Route::post('verify-otp-and-register', [AuthController::class, 'verifyOtpAndRegister']);
Route::post('store-kyc', [AuthController::class, 'storeKyc']);
Route::post('store-profile', [AuthController::class, 'storeProfile']);
//Route::post('/register', [AuthController::class, 'register']);

//Route::post('/google-login', [AuthController::class, 'googleLogin']);
Route::get('/login', function () {
    return response()->json(['message' => 'Use API token not valid.'], 401);
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/firebase-login', [FirebaseController::class, 'firebaseLogin']);
 
//forgot password

Route::post('forgot-password-api', [AuthController::class, 'forgotPasswordApi']);
Route::post('forgot-password-verify-otp', [AuthController::class, 'forgotPasswordVerifyOtp']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/freeze-account', [DashbaordController::class, 'freezeAccount']);
    Route::get('/unfreeze-account', [DashbaordController::class, 'unfreezeAccount']);
    Route::get('/check-freeze-status', [DashbaordController::class, 'checkFreezeStatus']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/store-messages', [ContactController::class, 'storeMessages']);
    Route::get('/contact-messages', [ContactController::class, 'getMessages']);
    
    Route::post('/save-data', [UserDataController::class, 'saveData']);
    Route::get('/get-data', [UserDataController::class, 'getData']);
    Route::delete('/delete-data/{id}', [UserDataController::class, 'deleteData']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete', [AuthController::class, 'deleteUser']);
    Route::get('/users', [DashbaordController::class, 'users']);
    Route::get('/user/edit', [DashbaordController::class, 'editUser']);
    Route::post('/user/update', [DashbaordController::class, 'editUpdate']);
    Route::post('/user/action', [DashbaordController::class, 'handleAction']);
    Route::get('/user/actions', [DashbaordController::class, 'getActions']);
    Route::get('/user/actions-trageted', [DashbaordController::class, 'getActionsTrageted']);
    Route::get('/user-action/convert-dateinvite', [DashbaordController::class, 'convertDateinviteToAdminers']);
    Route::post('/user/comment', [DashbaordController::class, 'commentUser']);
    Route::get('/user/{id}', [DashbaordController::class, 'userDetails']);
    Route::get('/user_list/{id?}', [DashbaordController::class, 'users_list']);
    
    
    //Route::post('/user/like', [DashbaordController::class, 'likeUser']);
    //Route::post('/user/unlike', [DashbaordController::class, 'unlikeUser']);
    //Route::post('/user/block', [DashbaordController::class, 'blockUser']);
    

    
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/story', [StoryController::class, 'addStory']);
    Route::get('/stories', [StoryController::class, 'viewStories']);
    Route::post('/story/{id}/view', [StoryController::class, 'markAsViewed']);
    Route::post('/story/{id}/like', [StoryController::class, 'likeStory']);
    Route::get('/my-stories', [StoryController::class, 'myStories']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/feeds', [FeedController::class, 'store']);
    Route::get('/feeds', [FeedController::class, 'index']);
    Route::get('/feeds/{id}', [FeedController::class, 'show']);

    Route::post('/feeds/{id}/comments', [CommentController::class, 'store']);
    Route::post('/like', [LikeController::class, 'like']);
    
    
    
});

//Route::middleware('auth:sanctum')->get('/get-data', [UserDataController::class, 'getData']);
//Route::middleware('auth:sanctum')->post('/save-data', [UserDataController::class, 'saveData']);