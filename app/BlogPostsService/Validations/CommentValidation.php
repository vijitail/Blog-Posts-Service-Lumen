<?php

namespace App\BlogPostsService\Validations;

use Validator;

class CommentValidation
{   
    /**
     * Validator object
     * 
     * @var Validator
     */
    private $validator;

    /**
     * Validation rules
     * 
     * @var array
     */
    private $rules = [
        'comment' => 'required|max:255',
        'user_id' => 'required',
        'post_id' => 'required'
    ];

    /**
     * Comment Validation constructor
     * 
     * @param $inputs
     */
    public function __construct($inputs)
    {
        $this->validator = Validator::make($inputs, $this->rules);
    }

    /**
     * Checks the validity of the inputs
     */
    public function checkValidity()
    {
        if($this->validator->fails()) {
            return $this->validator->errors();
        }
        else
            return false;
    }
}