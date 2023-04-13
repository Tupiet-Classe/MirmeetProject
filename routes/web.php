<?php

use App\Events\StartChat;
use App\Http\Controllers\ChatController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LoginSocialiteController;
use App\Models\Publication;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware(['auth', 'verified', 'check_access']);

Route::get('/follow', function () {
    return view('follow');
})->middleware(['auth', 'verified', 'check_access']);

Route::post('/follower', [FollowController::class, 'insert'])->name('follow.follower')->middleware(['auth', 'verified', 'check_access']);
Route::put('/following', [FollowController::class, 'update'])->name('follow.following')->middleware(['auth', 'verified', 'check_access']);

Route::get('/dashboard', function () {
    return view('login.dashboard');
})->middleware(['auth', 'verified', 'check_access'])->name('dashboard');

Route::get('/andrei', function () {
    return view('perfil.andrei');
})->middleware(['auth', 'verified', 'check_access']);

// Notifications
Route::get('/get-notifications', [NotificationController::class, 'show'])->name('get-notifications')->middleware(['auth', 'verified', 'check_access']);

Route::get('/perfil', function () {
    return view('perfil.perfil');
})->middleware(['auth', 'verified', 'check_access']);

Route::get('/my', function() {
    return view('perfil.wall_personal');
})->middleware(['auth', 'verified', 'check_access']);

Route::get('/apiSwarm', function() {
    return view('apiSwarm');
});
 
// Route::get('/api', [PublicationController::class, 'get_data_from_reference']);
// Route::get('/user-data', [UserController::class, 'index']);
// Route::get('/post-data', [PublicationController::class, 'index']);
Route::post('/new-post', [PublicationController::class, 'store_posts'])->middleware(['auth', 'verified', 'check_access']);

Route::get('/pending-users', [UserController::class, 'indexPending'])->middleware(['auth', 'verified', 'check_access'])->name('pending.users');
Route::get('/allow/{id}', [UserController::class, 'allow'])->middleware(['auth', 'verified', 'check_access'])->name('allow');
Route::get('/deny/{id}', [UserController::class, 'deny'])->middleware(['auth', 'verified', 'check_access'])->name('deny');
Route::get('/pending-search', [UserController::class, 'searchPending'])->middleware(['auth', 'verified', 'check_access'])->name('pending.search');

Route::get('/denied-users', [UserController::class, 'indexDenied'])->middleware(['auth', 'verified', 'check_access'])->name('denied.users');
Route::get('/restore/{id}', [UserController::class, 'restore'])->middleware(['auth', 'verified', 'check_access'])->name('restore');

Route::get('/ban-users', [UserController::class, 'indexBanned'])->middleware(['auth', 'verified', 'check_access'])->name('ban.users');
Route::get('/ban/{id}', [UserController::class, 'ban'])->middleware(['auth', 'verified', 'check_access'])->name('ban');
Route::get('/unban/{id}', [UserController::class, 'unban'])->middleware(['auth', 'verified', 'check_access'])->name('unban');
Route::get('/manage-search', [UserController::class, 'searchManage'])->middleware(['auth', 'verified', 'check_access'])->name('manage.search');

Route::get('/verify-users', [UserController::class, 'indexVerify'])->middleware(['auth', 'verified', 'check_access'])->name('verify.users');
Route ::get('/verify/{id}', [UserController::class, 'verify'])->middleware(['auth', 'verified', 'check_access'])->name('verify');
Route::get('/unverify/{id}', [UserController::class, 'unverify'])->middleware(['auth', 'verified', 'check_access'])->name('unverify');
Route::get('/verify-search', [UserController::class, 'searchVerify'])->middleware(['auth', 'verified', 'check_access'])->name('verify.search');

Route::get('/roles', [UserController::class, 'indexRole'])->middleware(['auth', 'verified', 'check_access'])->name('roles.users');
Route::get('/give-role/{id}', [UserController::class, 'give'])->middleware(['auth', 'verified', 'check_access'])->name('give');
Route::get('/remove-role/{id}', [UserController::class, 'remove'])->middleware(['auth', 'verified', 'check_access'])->name('remove');
Route::get('/role-search', [UserController::class, 'searchRole'])->middleware(['auth', 'verified', 'check_access'])->name('role.search');

Route::get('/perfil/get-followers/{id}', [UserController::class, 'followersammount'])->name('get.followers')->middleware(['auth', 'verified', 'check_access']);
Route::get('/perfil/get-following/{id}', [UserController::class, 'followingammount'])->name('get.following')->middleware(['auth', 'verified', 'check_access']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//login google------------------------------------------------------------------

Route::get('/login-google', [LoginSocialiteController::class, 'Google'])->name('login.google');

Route::get('/google-callback', [LoginSocialiteController::class, 'googleCallback']);

//login github------------------------------------------------------------------

Route::get('/login-github', [LoginSocialiteController::class, 'Github'])->name('login.github');

Route::get('/github-callback', [LoginSocialiteController::class, 'githubCallback']);


/* Ruta per sol·licitar enllaços de restabliment de contrasenya */
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');



/* RUTES EQUIP 3 */

/**
 * ==================
 *     RUTES XAT
 * ==================
 */
Route::get('/chat', [ChatController::class, 'index'])->middleware(['auth', 'verified', 'check_access']);
Route::post('/send', [ChatController::class, 'send'])->middleware(['auth', 'verified', 'check_access']);
Route::get('/start-chat/{to_id}', [ChatController::class, 'start_chat'])->middleware(['auth', 'verified', 'check_access']);

Route::get('/me', function() {
    return ['id' => Auth::id(), 'username' => Auth::user()->username];
});

Route::get('/discover2', function () {
    return view('prova');
});

// Route::get('/api/posts/{follower_id}', [PublicationController::class, 'getPosts']);

Route::get('/messages-between/{token}', [ChatController::class, 'get_messages_between'])->middleware(['auth', 'verified', 'check_access']);

// Aquestes rutes són per accedir als dos murs
Route::get('discover');
Route::get('home');

//Redirecció a la view Blade "Discover" que es redirigirà a la view Vue
Route::get('/discover-prova', function(){
    return view('discover-prova');
});

Route::get('/publications/{follower_id}',  [PublicationController::class, 'GetPosts']);
Route::get('/publications',  [PublicationController::class, 'GetAllPosts2']);
Route::get('/publications2', [PublicationController::class, 'GetPosts3'])->name('discover-prova');
Route::get('/publications3', [PublicationController::class, 'GetPosts3'])->name('prova');

Route::get('/api/posts', [PublicationController::class, 'GetAllPosts2'])->name('discover-prova');

//Recuperar les dades de la base de dades
Route::get('/posts-discover', [PublicationController::class, 'index'])->name('c');
Route::get('/post-discover/posts', [PublicationController::class, 'GetPosts'])->name('discover-prova');
Route::get('/posts', [PublicationController::class, 'GetPosts']);

// Aquestes rutes retornen els posts a mostrar al mur discover i a la home
Route::get('/posts-discover', [PublicationController::class, 'recDataSwarm'])->name('recoverPosts.discover');
Route::get('/posts-home', [PublicationController::class, 'myWall'])->name('postsMyWall.discover');
//Route::get('posts-discover');
Route::get('posts-home');

require __DIR__.'/auth.php';
