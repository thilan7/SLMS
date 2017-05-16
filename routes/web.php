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
*/

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Route::get('/', [
    'uses' => 'PostController@getHomePage',
    'as' => 'homepage'], function () {
    return view('welcome');
});

Route::get('/transactionHistory', [
    'uses' => 'TransactionController@getTransactionHistory',
    'as' => 'transactionHistory'], function () {
    return view('transactionHistory');
});

Route::get('/edit-book/{book_id}', [
        'uses' => 'BookController@getEditbook',
        'as' => 'book.edit',
        'middleware' => 'auth']
);
Route::post('/edit-book', [
        'uses' => 'BookController@postEditbook',
        'as' => 'bookEdit',
        'middleware' => 'auth']
);

Route::get('/delete-book/{book_id}', [
        'uses' => 'BookController@getDeletebook',
        'as' => 'book.delete',
        'middleware' => 'auth']
);
Route::get('/reserve-book/{book_id}', [
        'uses' => 'BookController@reserveBook',
        'as' => 'book.reserve',
        'middleware' => 'auth']
);
Route::get('/unreserve-book/{book_id}', [
        'uses' => 'BookController@unreserveBook',
        'as' => 'book.unreserve',
        'middleware' => 'auth']
);

Route::post('/return-BOOk/{book_id}', [
        'uses' => 'TransactionController@returnBookFinal',
        'as' => 'return-BOOk',
        'middleware' => 'auth']
);
Route::get('/add', function () {
    return view('addBooks');
})->name('add');;

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');;

Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');;

Route::get('/facilities', function () {
    return view('facilities');
})->name('facilities');;

Route::get('/contactUs', function () {
    return view('contactUS');
})->name('contactUs');;

Route::get('/services', function () {
    return view('services');
})->name('services');;

Route::post('/transaction', [
        'uses' => 'TransactionController@lendBook',
        'as' => 'lendBook']
);

Route::get('/returnBook', function () {
    return view('returnBook');
})->name('returnBook');;

Route::post('/returnBook', [
        'uses' => 'TransactionController@returnBook',
        'as' => 'returnBook']
);

Route::get('/addStudents', function () {
    return view('addStudents');
})->name('addStudents');;


Route::post('/searchbook', [
        'uses' => 'BookController@searchbook',
        'as' => 'searchbook']
);

Route::post('/add', [
        'uses' => 'BookController@addBook',
        'as' => 'addbook']
);
Route::get('/homeButtionPress', [
        'uses' => 'UserController@homeButtionPress',
        'as' => 'homeButtionPress']
);
Route::post('/signup', [

        'uses' => 'UserController@postSignUp',
        'as' => 'signup']
);
Route::post('/signin', [

        'uses' => 'UserController@postSignIn',
        'as' => 'signin']
);


Route::get('/logout', [

        'uses' => 'UserController@getLogout',
        'as' => 'logout']
);

Route::get('/dashboard', [
        'uses' => 'PostController@getDashboard',
        'as' => 'dashboard']
);

Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware' => 'auth']
);

Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth']
);

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
]);
