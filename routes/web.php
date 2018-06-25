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


    //<Route with middleware 'auth'
    Route::group(['middleware' => ['auth']] , function () {

        //<Route with prefix '/profile'
        Route::group(['prefix' => '/profile'] , function () {

            Route::get('/', 'Modules\Profile\SiteController@showIndex')->name('profile.site.index');

            Route::resource('/articles', 'Modules\Profile\ArticleResource');
        });
        //>Route with prefix '/profile'

        //<Route with prefix '/admin'
        Route::group(['prefix' => '/admin', 'middleware' => 'verificationRules'] , function () {

            Route::get('/', 'Modules\Admin\SiteController@showIndex')->name('admin.site.index');

            Route::get('/articles', 'Modules\Admin\ArticleController@getIndex')->name('admin.articles.index');
            Route::get('/articles/revise/{id}', 'Modules\Admin\ArticleController@getOne')->name('admin.articles.one');
            Route::get('/articles/{id}/change-status-on/{status}', 'Modules\Admin\ArticleController@setChangeStatus')->name('admin.articles.change-status');
        });
        //>Route with prefix '/admin'
    });
    //>

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
    Route::group(['prefix' => '/test'] , function () {

        Route::get('/new/{new_id}/{slug?}', function ($parameter1, $parameter2 = '') {

            echo '<a href="' . route("home") . '">Home</a> <br/><br/><br/>';

            echo '$id = ' . $parameter1 . '; <br/>$slug = ' . $parameter2;
        })->where('new_id', '[0-9]+')
            ->name('admin_new');

        Route::group(['middleware' => ['my.authenticate']], function () {

            Route::get('/', 'Test\SiteController@getIndex')->name('admin.home');
            Route::get('/users', [
                'as' => 'admin.users',
                'uses' => 'Test\SiteController@getListUser',
            ]);
            Route::get('/user/{slug}', 'Test\SiteController@getUser')
                ->name('admin.user');
            Route::get('/logout', 'Test\SiteController@getLogout')
                ->name('admin.logout');

        });

        Route::get('/login', 'Test\SiteController@getLogin')
            ->name('admin.login');
        Route::any('/sign-in', 'Test\SiteController@postSignIn')
            ->name('admin.sign-in');


        Route::get('/pages/add', 'Test\CoreResource@add');//шлях до всаного доданого методу в контролер типу ресурс
        Route::resource('/pages', 'Test\CoreResource', ['except' => ['delete', 'show']]);//шляхи для стандартних методів контролера типу ресурс
        Route::get('/form-create', function () {
            return view('form-create');
        })->name('admin.pages.form-create');
        Route::get('/form-update', function () {
            return view('form-update');
        })->name('admin.pages.form-update');

    });
*/
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
