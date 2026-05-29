<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;

class CourseEnrollment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Scope a search
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $searchText)
    {
        return $query
            ->where('course_enrollments.id', 'LIKE', '%'.$searchText.'%')
            ->orWhereHas('course', function (\Illuminate\Database\Eloquent\Builder $query) use ($searchText) {
                $query->where('courses.name', 'LIKE', '%'.$searchText.'%');
            })
            ;
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getTable()
    {
        return config('smc-training.table_names.course_enrollments');
    }

    /**
     * @return \Training\Api\Models\Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function participant()
    {
        return $this->morphTo(__FUNCTION__, 'participant_type', 'participant_id');
    }
}
