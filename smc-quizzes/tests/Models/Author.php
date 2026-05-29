<?php

namespace Quiz\Api\Tests\Models;

use Quiz\Api\Traits\CanAuthorQuiz;
use Quiz\Api\Traits\QuizParticipant;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use QuizParticipant, CanAuthorQuiz;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $table = 'authors';
}
