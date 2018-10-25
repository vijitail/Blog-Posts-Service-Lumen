<?php

namespace App\BlogPostsService\Transformers;

class CommentTransformer extends Transformer
{
    protected $resourceName = 'comment';

    public function transform($data) 
    {
        return $data;
    }
}