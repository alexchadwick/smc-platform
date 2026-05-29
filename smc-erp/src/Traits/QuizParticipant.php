<?php

namespace Quiz\Api\Traits;

use Quiz\Api\Models\QuizAttempt;

trait QuizParticipant
{
    public function quiz_attempts()
    {
        return $this->morphMany(config('smc-quizzes.models.quiz_attempt'), 'participant');
    }
}
