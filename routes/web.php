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
use App\Http\Controllers\MessageController2;
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

/**
  * Ruta que s'utilitza per canviar l'idioma de l'aplicació i desar la selecció a la sessió de l'usuari
  *
  * setLocale() estableix l'idioma actiu de l'aplicació per a l'idioma seleccionat actual
  * La segona línia desa l'idioma actiu a la sessió de l'aplicació utilitzant el mètode put de la instància de sessió (session()),
  * d'aquesta manera, l'idioma actiu persistirà a totes les sol·licituds posteriors.
  *
  * @param $locale representa que l'usuari vol establir a l'aplicació
  * @return back retorna l'usuari a la pàgina on era abans de canviar l'idioma de l'aplicació
  */

//Canviar idioma
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});


Route::post('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return response()->json(['success' => true]);
})->middleware('web');


//
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/follow', function () {
    return view('follow');
})->middleware(['auth', 'verified']);

Route::post('/follower', [FollowController::class, 'insert'])->name('follow.follower')->middleware(['auth', 'verified']);
Route::put('/following', [FollowController::class, 'update'])->name('follow.following')->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('login.dashboard');
})->middleware(['auth', 'verified', 'check_access'])->name('dashboard');


// Notifications
Route::get('/get-notifications', [NotificationController::class, 'show'])->name('get-notifications')->middleware(['auth', 'verified']);
Route::get('/quit-notifications', [NotificationController::class, 'destroy'])->name('quit-notifications')->middleware(['auth', 'verified']);

Route::get('/perfil/{id}', [ProfileController::class, 'show'])->name('get-perfil')->middleware(['auth', 'verified']);
Route::get('/perfil/{user}/recuperar', [ProfileController::class, 'recuperar'])->name('get-informacio')->middleware(['auth', 'verified']);
/*
Route::get('/perfil', function () {
    return view('perfil.perfil');
})->middleware(['auth', 'verified']);
*/

Route::get('/my', function() {
    return view('walls.my_wall');
})->middleware(['auth', 'verified'])->name('my');

Route::get('/make-like/{id}/{post}', [UserController::class, 'likes'])->middleware(['auth'])->name('make-like');
Route::get('/check-like/{post}', [UserController::class, 'checkLikes'])->middleware(['auth'])->name('check-like');

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified', 'check_access'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified', 'check_access'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->middleware(['auth', 'verified', 'check_access'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified', 'check_access'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified', 'check_access'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'verified', 'check_access'])->name('users.destroy');


// Route::get('/post', [PublicationController::class, 'postToSwarm'])->name('getSwarm');
Route::get('/get', [PublicationController::class, 'getFromSwarm'])->name('getSwarm');


// Route::get('/api', [PublicationController::class, 'get_data_from_reference']);
// Route::get('/user-data', [UserController::class, 'index']);
// Route::get('/post-data', [PublicationController::class, 'index']);
Route::post('/new-post', [PublicationController::class, 'store_posts'])->middleware(['auth']);
Route::post('/post', [PublicationController::class, 'postToSwarm'])->middleware(['auth']);

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

Route::get('/perfil/{user}/get-followers', [FollowController::class, 'followersammount'])->name('get.followers')->middleware(['auth', 'verified']);
Route::get('/perfil/{user}/get-following', [FollowController::class, 'followingammount'])->name('get.following')->middleware(['auth', 'verified']);
Route::get('/perfil/{user}/get-publications', [FollowController::class, 'publicacionsUser'])->name('get.publicationsUser')->middleware(['auth', 'verified']);
Route::post('perfil/configuracio', [ProfileController::class, 'perfilConfiguration'])->name('perfilConfiguration')->middleware('auth', 'verified');

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
Route::get('/chat', [ChatController::class, 'chat_recents'])->middleware(['auth', 'verified']);
Route::get('/chat/{id}', [ChatController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/send', [ChatController::class, 'send'])->middleware(['auth', 'verified']);
Route::get('/start-chat/{to_id}', [ChatController::class, 'start_chat'])->middleware(['auth', 'verified']);

Route::get('/me', function() {
    return ['id' => Auth::id(), 'username' => Auth::user()->username];
});

Route::get('/discover', function() {
    return view('walls.discover_wall');
})->middleware(['auth', 'verified'])->name('discover');

// Route::get('/api/posts/{follower_id}', [PublicationController::class, 'getPosts']);
Route::get('/channels', [ChatController::class, 'get_channels'])->middleware(['auth', 'verified']);
Route::get('/rooms/{to_id}', [ChatController::class, 'check_existing_room'])->middleware(['auth', 'verified']);

Route::get('/recent-chats', [ChatController::class, 'get_recent_chats'])->middleware(['auth', 'verified']);
Route::get('/messages-between/{token}', [ChatController::class, 'get_messages_between'])->middleware(['auth', 'verified']);
Route::get('/following-users', [ChatController::class, 'get_following_users_to_chat'])->middleware(['auth', 'verified']);
Route::get('/following-users/{search}', [ChatController::class, 'get_following_users_to_chat'])->middleware(['auth', 'verified']);
// Aquestes rutes són per accedir als dos murs


Route::post('/search/user', [UserController::class, 'searchUsers'])->middleware(['auth', 'verified']);
Route::post('/search', [UserController::class, 'searchUsersResponsive'])->middleware(['auth', 'verified'])->name('search.responsive');
Route::get('/search', [UserController::class, 'showSearchResults'])->middleware(['auth', 'verified'])->name('search.results');



// Route::get('/search', function() {
//     $users = collect(); // Definir una colección vacía
//     return view('search.index', compact('users'));
// })->middleware(['auth', 'verified']);

Route::get('/publications/{follower_id}',  [PublicationController::class, 'GetPosts']);
Route::get('/publications',  [PublicationController::class, 'GetAllPosts2']);
Route::get('/publications2', [PublicationController::class, 'GetPosts3'])->name('discover-prova');
Route::get('/publications3', [PublicationController::class, 'GetPosts3'])->name('prova');

Route::get('/api/posts', [PublicationController::class, 'GetAllPosts2'])->name('discover-prova');

//Recuperar les dades de la base de dades
Route::get('/posts', [PublicationController::class, 'GetPosts']);

Route::get('/home', function() {
    return view('walls.home_wall');
})->middleware(['auth', 'verified']);

// Route::get('/publications/{follower_id}',  [PublicationController::class, 'GetPosts']);
// Route::get('/publications',  [PublicationController::class, 'GetAllPosts2']);
// Route::get('/publications2', [PublicationController::class, 'GetPosts3'])->name('discover-prova');
// Route::get('/publications3', [PublicationController::class, 'GetPosts3'])->name('prova');

// Route::get('/api/posts', [PublicationController::class, 'GetAllPosts2'])->name('discover-prova');

// Aquestes rutes retornen els posts a mostrar al mur discover i a la home
Route::get('/posts-my', [PublicationController::class, 'myWall'])->name('postsMyWall');
Route::get('/posts-home', [PublicationController::class, 'postsHome'])->name('recoverPostsHome');
Route::post('/home/{publication}/comments', [PublicationController::class, 'storeComment'])->middleware(['auth', 'verified'])->name('recoverPostsHome');


Route::get('/posts-discover', [PublicationController::class, 'postsDiscover'])->name('recoverPostsDiscover');
Route::post('/discover/{publication}/comments', [PublicationController::class, 'storeComment'])->middleware(['auth', 'verified'])->name('recoverPostsDiscover');
Route::get('/discover/{publication}/comments', [PublicationController::class, 'showComments'])
    ->middleware(['auth', 'verified'])
    ->name('recoverPostsDiscover');
// Apartat comentaris
// Route::post('/messages/{id}/comments', 'MessageController@storeComment')->name('messages.comments.store');
// Route::delete('/messages/{id}/comments/{comment_id}', 'MessageController@destroyComment')->name('messages.comments.destroy');
// Route::get('/messages/{id}/comments', 'MessageController@getComments')->name('messages.comments.get');

require __DIR__.'/auth.php';