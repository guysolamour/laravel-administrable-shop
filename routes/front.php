<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;



Route::name(Str::lower(config('administrable.front_namespace') . '.'))->middleware('web')->group(function (){
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Blog
    |--------------------------------------------------------------------------
    */
    Route::get('blog/posts', [config('administrable-blog.controllers.front.post'), 'index'])->name('extensions.blog.blog.index');

    Route::get('blog/posts/search', [config('administrable-blog.controllers.front.post'), 'search'])->name('extensions.blog.search');
    Route::get('blog/posts/{post}', [config('administrable-blog.controllers.front.post'), 'show'])->name('extensions.blog.show');

    Route::get('blog/posts/categories/{category}', [config('administrable-blog.controllers.front.post'), 'category'])->name('extensions.blog.category');
    Route::get('blog/posts/tags/{tag}', [config('administrable-blog.controllers.front.post'), 'tag'])->name('extensions.blog.tag');

});

