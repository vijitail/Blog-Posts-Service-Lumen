<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\BlogPostsService\Validations\CommentValidation;
use App\BlogPostsService\Transformers\CommentTransformer;
use App\BlogPostsService\Repositories\Contracts\CommentRepositoryInterface;

class CommentController extends ApiController
{
    /**
     * CommentController constructor
     *
     * @param CommentTransformer $transformer
     * @param CommentRepositoryInterface $repository
     */
    public function __construct(CommentTransformer $transformer, CommentRepositoryInterface $repository)
    {
        $this->transformer = $transformer;
        $this->repository = $repository;
    }

    /**
     * Post a comment
     * 
     * @param Request $request
     */
    public function create(Request $request)
    {
        $inputs = $request->all();
    
        $validation = new CommentValidation($inputs);
        $validationErrors = $validation->checkValidity();
        if(!$validationErrors)
            return $this->respondCreated($this->repository->create($inputs));
        else
            return $this->respondValidationErrors($validationErrors);
    }

    /**
     * Get paginated comments
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->offset ? $request->offset : 0;
        $comments = $this->repository->paginate($limit, $offset);

        return $this->respondWithPagination($comments);
    }

    /**
     * Update a comment
     * 
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        // check if the user is authorized to update
        if($this->repository->findCommenter($id) != $inputs['user_id']) {
            return $this->respondUnauthorized();
        }

        $validation = new CommentValidation($inputs);
        $validationErrors = $validation->checkValidity();
        if($validationErrors) {
            return $this->respondValidationErrors($validator->errors());
        }

        if($this->repository->update($id, $inputs))
            return $this->respondWithTransformer($this->repository->findById($id));
        else
            return $this->respondNotFound();
    }

    /**
     * Delete a comment
     * 
     * @param Request $request
     * @param int $id
     */
    public function delete($id)
    {
        $comment = $this->repository->findById($id);

        if($this->repository->delete($id))
            return $this->respondWithTransformer($comment);
        else
            return $this->respondNotFound();
    }
}
