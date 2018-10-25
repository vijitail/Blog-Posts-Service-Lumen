<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider 
{
    public function register()
    {
        $this->app->bind(
            'App\BlogPostsService\Repositories\Contracts\CommentRepositoryInterface', 
            'App\BlogPostsService\Repositories\CommentRepository'
        );
    }
}