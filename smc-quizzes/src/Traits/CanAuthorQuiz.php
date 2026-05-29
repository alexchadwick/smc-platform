<?php

namespace Quiz\Api\Traits;

trait CanAuthorQuiz
{
    public function quizzes()
    {
        return $this->morphMany(config('smc-quizzes.models.quiz_author'), 'author');
    }
}
