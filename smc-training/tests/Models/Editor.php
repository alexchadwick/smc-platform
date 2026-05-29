<?php

namespace Training\Api\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Training\Api\Traits\CanAuthorCourse;

class Editor extends Model
{
    use CanAuthorCourse;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $table = 'editors';
}
