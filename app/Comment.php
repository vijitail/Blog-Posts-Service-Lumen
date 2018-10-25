<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{
    /**
     * Table to be used for the model
     * 
     * @var string
     */
    protected $table='comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'user_id', 'post_id'
    ];
}