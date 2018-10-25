<?php

namespace App\BlogPostsService\Repositories\Contracts;

interface RepositoryInterface 
{
    public function create($values);

    public function read();

    public function update($id, $values);

    public function delete($id);

    public function findById($id);
}