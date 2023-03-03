<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', function () {
    return view('login.dashboard');
})->middleware(['auth', 'verified', 'check_access'])->name('dashboard');

Route::get('/andrei', function () {
    return view('andrei');
});

Route::get('/perfil', function () {
    return view('perfil');
});

Route::get('/my', function() {
    return view('wall_personal');
});

Route::get('/api', [PublicationController::class, 'get_data_from_reference']);
Route::get('/user-data', [UserController::class, 'index']);
Route::get('/post-data', [PublicationController::class, 'index']);
Route::get('/posts', [PublicationController::class, 'get_posts']);
Route::post('/post', [PublicationController::class, 'store']);

Route::get('/pending-users', [UserController::class, 'indexPending'])->middleware(['auth', 'verified', 'check_access'])->name('pending.users');
Route::get('/allow/{id}', [UserController::class, 'allow'])->middleware(['auth', 'verified', 'check_access'])->name('allow');
Route::get('/deny/{id}', [UserController::class, 'deny'])->middleware(['auth', 'verified', 'check_access'])->name('deny');

Route::get('/denied-users', [UserController::class, 'indexDenied'])->middleware(['auth', 'verified', 'check_access'])->name('denied.users');
Route::get('/restore/{id}', [UserController::class, 'restore'])->middleware(['auth', 'verified', 'check_access'])->name('restore');

Route::get('/ban-users', [UserController::class, 'indexBanned'])->middleware(['auth', 'verified', 'check_access'])->name('ban.users');
Route::get('/ban/{id}', [UserController::class, 'ban'])->middleware(['auth', 'verified', 'check_access'])->name('ban');
Route::get('/unban/{id}', [UserController::class, 'unban'])->middleware(['auth', 'verified', 'check_access'])->name('unban');

Route::get('/verify-users', [UserController::class, 'indexVerify'])->middleware(['auth', 'verified', 'check_access'])->name('verify.users');
Route::get('/verify/{id}', [UserController::class, 'verify'])->middleware(['auth', 'verified', 'check_access'])->name('verify');
Route::get('/unverify/{id}', [UserController::class, 'unverify'])->middleware(['auth', 'verified', 'check_access'])->name('unverify');

/*
Route::get('/search', [UserController::class, 'indexverify'])->middleware(['auth', 'verified', 'check_access'])->name('search.results');
Route::get('/verified-users', [UserController::class, 'indexverify'])->middleware(['auth', 'verified', 'check_access'])->name('indexverify.users');
Route::get('/verifyYes/{id}', [UserController::class, 'verifyYes'])->middleware(['auth', 'verified', 'check_access'])->name('verifyYes');
Route::get('/verifyNo/{id}', [UserController::class, 'verifyNo'])->middleware(['auth', 'verified', 'check_access'])->name('verifyNo');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

/* Ruta per sol·licitar enllaços de restabliment de contrasenya */
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

/* RUTES EQUIP 3 */
// Aquestes rutes són per accedir als dos murs
Route::get('discover');
Route::get('home');

// Aquestes rutes retornen els posts a mostrar al mur discover i a la home
Route::get('posts-discover');
Route::get('posts-home');

require __DIR__.'/auth.php';
