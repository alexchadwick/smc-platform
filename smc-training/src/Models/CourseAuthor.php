<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseAuthor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getTable()
    {
        return config('smc-training.table_names.course_authors');
    }

    /**
     * @return \Training\Api\Models\Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function author()
    {
        return $this->morphTo(__FUNCTION__, 'author_type', 'author_id');
    }
}
