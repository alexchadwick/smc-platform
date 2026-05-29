<?php

namespace Training\Api\Traits;

trait CanAuthorCourse
{
    public function courses()
    {
        return $this->morphMany(config('smc-training.models.course_author'), 'author');
    }
}
