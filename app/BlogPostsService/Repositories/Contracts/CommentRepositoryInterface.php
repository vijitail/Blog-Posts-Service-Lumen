<?php

namespace App\BlogPostsService\Repositories\Contracts;

use App\BlogPostsService\Repositories\Contracts\RepositoryInterface;

interface CommentRepositoryInterface extends RepositoryInterface 
{
    public function paginate($limit, $offset);

    public function findCommenter($id);
} 