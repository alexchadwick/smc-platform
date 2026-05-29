<?php

namespace Admin\Api\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Admin\Api\Traits\CanAuthorCourse;
use Admin\Api\Traits\CourseParticipant;

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
