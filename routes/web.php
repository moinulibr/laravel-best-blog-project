<?php

/* no need-- Route::get('/home', 'HomeController@index')->name('home');*/
    Route::get('/', 'HomeController@index')->name('home');

    /*Post detail */
    Route::get('posts','Frontend\PostDetail\PostDetailController@index')->name('posts.index');
    Route::get('post/{slug}','Frontend\PostDetail\PostDetailController@postDetails')->name('post.details');

    /*Post by category and Tag  and Author*/
    Route::get('category/{slug}','Frontend\PostDetail\PostDetailController@postByCategoy')->name('post.category');
    Route::get('tag/{slug}','Frontend\PostDetail\PostDetailController@postByTag')->name('post.tag');
    Route::get('author/all/post/{id}','Frontend\PostDetail\PostDetailController@postByAuthor')->name('post.author');

    /*Search */
    Route::get('search','Frontend\Search\SearchController@search')->name('search');

/*Subscriber */
    Route::post('subscriber','Frontend\Subscriber\SubscriberController@store')->name('subscriber.store');

    Auth::routes();

        /**Favorite post */
    Route::group(['middleware' => 'auth'], function () {
        /*Favorite post*/
        Route::get('favorite/add','Frontend\Favorite\FavoriteController@add')->name('post.favorite');
        Route::get('favorite/remove/{post}','Frontend\Favorite\FavoriteController@remove')->name('post.favorite.remove');
          /*post Comment*/
          Route::post('comment/add/{post}','Frontend\Comment\CommentController@store')->name('comment.store');
    });


    /*-------------------Admin Group--------------*/
    Route::group(['as'=>'admin.','prefix' => 'admin','namespace' => 'Admin','middleware'=> ['auth','admin']], function () {
        Route::get('/dashboard','DashboardController@index')->name('dashboard');

        /*Setting */
        Route::get('settings','Setting\SettingController@index')->name('settings.index');
        Route::put('profile/update/{id}','Setting\SettingController@profileUpdate')->name('settings.profile.update');
        Route::put('change/password','Setting\SettingController@changePassword')->name('settings.change.password');

            /* -Tag - */
        Route::resource('tag', 'Tag\TagController');
        Route::resource('category', 'Category\CategoryController');

            /**post */
        Route::resource('post', 'Post\PostController');
        Route::get('post/delete/{id}', 'Post\PostController@delete')->name('post.delete');
        Route::get('post/approve/{id}', 'Post\PostController@approve')->name('post.approve');

        Route::get('/pending/post','Post\PostController@pending')->name('post.pending');
        Route::get('/pending/post/{id}','Post\PostController@showPending')->name('post.pending.show');

        /*Favorite */
        Route::get('/favorite','Favorite\FavoriteController@index')->name('favorite.index');

        /*All Author */
        Route::get('author','Author\AuthorController@index')->name('author.index');
        Route::get('author/delete/{id}','Author\AuthorController@delete')->name('author.delete');

        /*Subscriber */
        Route::get('/subscriber','Subscriber\SubscriberController@index')->name('subscriber.index');
        Route::get('/subscriber/delete/{id}','Subscriber\SubscriberController@delete')->name('subscriber.delete');

        /**Comment */
        Route::get('/comment','Comment\CommentController@index')->name('comment.index');
        Route::get('/comment/delete/{id}','Comment\CommentController@delete')->name('comment.delete');
    });

    /*------------------------Author Group------------------- */
    Route::group(['as'=>'author.','prefix' => 'author','namespace' => 'Author','middleware'=> ['auth','author']], function () {
        Route::get('/dashboard','DashboardController@index')->name('dashboard');
        
            /*Setting */
            Route::get('settings','Setting\SettingController@index')->name('settings.index');
            Route::put('profile/update/{id}','Setting\SettingController@profileUpdate')->name('settings.profile.update');
            Route::put('change/password','Setting\SettingController@changePassword')->name('settings.change.password');    

             /*Favorite */
        Route::get('/favorite','Favorite\FavoriteController@index')->name('favorite.index');

        Route::resource('post', 'Post\PostController');
        Route::get('post/delete/{id}', 'Post\PostController@delete')->name('post.delete');

         /**Comment */
         Route::get('/comment','Comment\CommentController@index')->name('comment.index');
         Route::get('/comment/delete/{id}','Comment\CommentController@delete')->name('comment.delete');
    });


/*
 used it in the appServiceProvider.php file.. boot method
    View::composer('layouts.fronted.partials.footer',function($view){
		$cat = App\Model\Category\Category::all();
		$view->with('cat',$cat);
	});
 */