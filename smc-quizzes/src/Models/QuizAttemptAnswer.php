<?php

namespace Quiz\Api\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizAttemptAnswer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTable()
    {
        return config('smc-quizzes.table_names.quiz_attempt_answers');
    }

    public function quiz_attempt()
    {
        return $this->belongsTo(config('smc-quizzes.models.quiz_attempt'));
    }

    public function quiz_question()
    {
        return $this->belongsTo(config('smc-quizzes.models.quiz_question'));
    }

    public function question_option()
    {
        return $this->belongsTo(config('smc-quizzes.models.question_option'));
    }
}
