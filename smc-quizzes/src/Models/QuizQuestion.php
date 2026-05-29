<?php

namespace Quiz\Api\Models;

use Quiz\Api\Database\Factories\QuizQuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
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
        return config('smc-quizzes.table_names.quiz_questions');
    }

    public function quiz()
    {
        return $this->belongsTo(config('smc-quizzes.models.quiz'));
    }

    public function question()
    {
        return $this->belongsTo(config('smc-quizzes.models.question'));
    }

    public function answers()
    {
        return $this->hasMany(config('smc-quizzes.models.quiz_attempt_answer'));
    }

    protected static function newFactory()
    {
        return new QuizQuestionFactory();
    }
}
