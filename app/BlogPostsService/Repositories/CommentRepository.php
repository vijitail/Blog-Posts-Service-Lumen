<?php

namespace App\BlogPostsService\Repositories;

use App\BlogPostsService\Repositories\Contracts\CommentRepositoryInterface;
use App\BlogPostsService\Paginate\Paginate;
use App\Comment;

class CommentRepository implements CommentRepositoryInterface
{   
    public function create($values)
    {
        return Comment::create($values);
    }

    public function read() 
    {
        return Comment::all();
    }

    public function update($id, $values)
    {
        return Comment::where('id', $id)->update($values);
    }

    public function delete($id)
    {
        return Comment::where('id', $id)->delete();
    }

    public function paginate($limit, $offset)
    {
        return new Paginate(Comment::select(),$limit, $offset);
    }

    public function findById($id)
    {
        return Comment::where('id', $id)->first();
    }

    public function findCommenter($id)
    {
        $comment = $this->findById($id);
        return $comment->user_id;
    }
}