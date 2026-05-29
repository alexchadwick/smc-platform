<?php

namespace Training\Api\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Training\Api\Traits\CanAuthorCourse;
use Training\Api\Traits\CourseParticipant;

class Author extends Model
{
    use CourseParticipant, CanAuthorCourse;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $table = 'authors';
}
