<?php

namespace Training\Api\Traits;

trait CourseParticipant
{
    public function course_enrollments()
    {
        return $this->morphMany(config('smc-training.models.course_enrollment'), 'participant');
    }

    public function course_attempts()
    {
        return $this->morphMany(config('smc-training.models.course_attempt'), 'participant');
    }
}
