<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\BlogController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/getuserdata', function () {

    return phpinfo();
    $users = User::all(); // Retrieve all users from the database

    $userNames = [];
    foreach ($users as $user) {
        $userNames[] = $user->name; // Collect user names into an array
    }

    return $userNames; // Return the array of user names
});


Route::get('/contact',function(){
    return view('contact');
});
Route::get('/data/{id}/{name}/{token}',[BlogController::class, 'show_data']);
Route::get('/blog/{id}', [BlogController::class, 'index']);
Route::get('/post', [PostsController::class, 'index'])->name('post.index');
Route::get('/', function () {
    return view('welcome');
}); 


Route::match(['get', 'post'], '/one', function () {
    return 'Something';
 });
 Route::view('/welcome', 'we', ['name' => 'Taylor']);
 
 Route::get('/user/profile', function () {
     return 'USER/PROFILE';
 })->name('profile');
 
 Route::get('/info',function(){
 // Generating URLs...
    $url = route('profile');
    echo 'value of info route '.$url;
 });
 Route::get('/posts/{post}/comments/{comment}', function (string $commentId,string $postId) {
 
     echo 'value of commentId'.$commentId;
     echo 'value of postId'.$postId;
 });
 
 Route::get('/user/{id}', function (string $id) {
     echo 'value of id'.$id;
 })->where('id', '[0-9]+');


//Auth Routes
Auth::routes();
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Auth::routes(['verify' => true]);
