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

Route::group(['middleware' => ['web']], function() {
    Auth::routes();

    Route::get('/', 'SiteController@showIndex')->name('site.home');

    Route::get('/articles', 'ArticleController@showAll')->name('site.articles');
    Route::get('/articles/category/{category_slug}', 'ArticleController@showArticleOnCategory')->name('site.articles.category');
    Route::get('/article/{id}', 'ArticleController@showOne')->name('site.article');

    Route::match(['get', 'post'], '/contact', 'SiteController@showContact')->name('site.contact');



    Route::group(['prefix' => '/admin'] , function () {

        Route::group(['middleware' => ['my.authenticate']], function () {

            Route::get('/', 'Admin\SiteController@getIndex')->name('admin.home');
            Route::get('/users', [
                'as' => 'admin.users',
                'uses' => 'Admin\SiteController@getListUser',
            ]);
            Route::get('/user/{slug}', 'Admin\SiteController@getUser')
                ->name('admin.user');
            Route::get('/logout', 'Admin\SiteController@getLogout')
                ->name('admin.logout');

        });

        Route::get('/login', 'Admin\SiteController@getLogin')
            ->name('admin.login');
        Route::any('/sign-in', 'Admin\SiteController@postSignIn')
            ->name('admin.sign-in');


        Route::get('/pages/add', 'Admin\CoreResource@add');//шлях до всаного доданого методу в контролер типу ресурс
        Route::resource('/pages', 'Admin\CoreResource', ['except' => ['delete', 'show']]);//шляхи для стандартних методів контролера типу ресурс
        Route::get('/form-create', function () {
            return view('form-create');
        })->name('admin.pages.form-create');
        Route::get('/form-update', function () {
            return view('form-update');
        })->name('admin.pages.form-update');

    });

    Route::get('/home', 'HomeController@index')->name('home');

});

/*
 * ============================================================================================
    Route::get('/', ['as' => 'site.home', function () {
        return view('welcome');
    }]);
Route::get('/my-test-page', function () {
    return view('my-test-page');
});

Route::get('/add-comment', function () {
    return view('function');
});

Route::post('/view-comments-post', function () {
    echo '<a href="' . route("home") . '">Home</a> <br/><br/><br/>';

    echo "<pre>" ;
        print_r($_POST);
    echo "<pre>" ;
});

Route::get('/add-comment-method-match', function () {
    return view('function-math');
});

//> Для обробки запиту надісланого одним із методів, вказаних в переліку
Route::match(['get', 'post'], '/view-comments-method-match', function () {

    echo '<a href="' . route("home") . '">Home</a> <br/><br/><br/>';

    echo "<pre>" ;
    print_r($_REQUEST);
    echo "<pre>" ;
});*/
//<

//> Для обробки запиту надісланого будь яким методом
/*Route::any('/view-comments-method-match', function () {

    echo '<a href="' . route("home") . '">Home</a> <br/><br/><br/>';

    echo "<pre>" ;
    print_r($_REQUEST);
    echo "<pre>" ;
});
//<

Route::get('/post/{post_id}/{slug?}', function ($parameter1, $parameter2 = '') {
    echo '$id = ' . $parameter1 . '; <br/>$slug = ' . $parameter2;
})->where('post_id', '[0-9]+');

Route::get('/product/{product_id}/{category_id?}', function ($parameter1, $parameter2 = null) {
    echo '$product_id = ' . $parameter1 . '; <br/>$category_id = ' . $parameter2;
})->where([
    'product_id' => '[0-9]+',
    'category_id' => '[0-9]+'
]);*/
/*
Route::group(['prefix' => '/admin'], function () {

    Route::get('/new/{new_id}/{slug?}', function ($parameter1, $parameter2 = '') {

        echo '<a href="' . route("home") . '">Home</a> <br/><br/><br/>';

        echo '$id = ' . $parameter1 . '; <br/>$slug = ' . $parameter2;
    })->where('new_id', '[0-9]+')
        ->name('admin_new');

});*/
/*
Route::group(['prefix' => '/profile/{name}'], function () {

    Route::get('/settings', function ($name) {
        echo 'Profile user: ' . $name . ' -> settings';
    });

    Route::get('/home-profile', function ($name) {
        echo 'Profile user: ' . $name . ' -> home page';
    });

});*/
//===================================================================================
