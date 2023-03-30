<?php

use App\Events\StartChat;
use App\Http\Controllers\ChatController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
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
});

Route::get('/follow', function () {
    return view('follow');
});

Route::post('/follower', [FollowController::class, 'insert'])->name('follow.follower');
Route::put('/following', [FollowController::class, 'update'])->name('follow.following');

Route::get('/dashboard', function () {
    return view('login.dashboard');
})->middleware(['auth', 'verified', 'check_access'])->name('dashboard');

Route::get('/andrei', function () {
    return view('perfil.andrei');
});

// Notifications
Route::get('/get-notifications', [NotificationController::class, 'show'])->name('get-notifications');

Route::get('/perfil', function () {
    return view('perfil.perfil');
});

Route::get('/my', function() {
    return view('perfil.wall_personal');
});

// Route::get('/api', [PublicationController::class, 'get_data_from_reference']);
// Route::get('/user-data', [UserController::class, 'index']);
// Route::get('/post-data', [PublicationController::class, 'index']);
Route::post('/new-post', [PublicationController::class, 'store_posts']);

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
Route::get('/verify/{id}', [UserController::class, 'verify'])->middleware(['auth', 'verified', 'check_access'])->name('verify');
Route::get('/unverify/{id}', [UserController::class, 'unverify'])->middleware(['auth', 'verified', 'check_access'])->name('unverify');
Route::get('/verify-search', [UserController::class, 'searchVerify'])->middleware(['auth', 'verified', 'check_access'])->name('verify.search');

Route::get('/roles', [UserController::class, 'indexRole'])->middleware(['auth', 'verified', 'check_access'])->name('roles.users');
Route::get('/give-role/{id}', [UserController::class, 'give'])->middleware(['auth', 'verified', 'check_access'])->name('give');
Route::get('/remove-role/{id}', [UserController::class, 'remove'])->middleware(['auth', 'verified', 'check_access'])->name('remove');
Route::get('/role-search', [UserController::class, 'searchRole'])->middleware(['auth', 'verified', 'check_access'])->name('role.search');

Route::get('/perfil/get-followers/{id}', [UserController::class, 'followersammount'])->name('get.followers');
Route::get('/perfil/get-following/{id}', [UserController::class, 'followingammount'])->name('get.following');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//login google------------------------------------------------------------------

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login.google');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userexist = User::where('external_id', $user->id)->where('external_auth', 'google')->first();


    if($userexist){
        Auth::login($userexist);
    } else{
        $userexist = User::create([

            'name' => $user->name,
            'username' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'google',
        ]);

        Auth::login($userexist);
    }
    return redirect('/dashboard');
});

//login github------------------------------------------------------------------

Route::get('/login-github', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/github-callback', function () {
    $user = Socialite::driver('github')->user();
    //dd($user);
    $userexist = User::where('external_id', $user->id)->where('external_auth', 'github')->first();


    if($userexist){
        Auth::login($userexist);
    } else{
        $userexist = User::create([

            'name' => $user->nickname,
            'username' => $user->nickname,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'github',
        ]);

        Auth::login($userexist);
    }
    return redirect('/dashboard');
});


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
Route::get('/chat', [ChatController::class, 'index'])->middleware('auth');
Route::post('/send', [ChatController::class, 'send'])->middleware('auth');
Route::get('/start-chat/{to_id}', function($to_id) {
    $token = Str::random(16);
    StartChat::dispatch($token, $to_id);
    return ['token' => $token];
});

Route::get('/me', function() {
    return ['id' => Auth::id(), 'username' => Auth::user()->username];
});


// Aquestes rutes són per accedir als dos murs
Route::get('discover');
Route::get('home');

// Aquestes rutes retornen els posts a mostrar al mur discover i a la home
Route::get('/posts-discover/{user_id}', [PublicationController::class, ''])->name('recoverPosts.discover');
Route::get('/posts-home/{user_id}', [PublicationController::class, 'myWall'])->name('postsMyWall.discover');

require __DIR__.'/auth.php';
