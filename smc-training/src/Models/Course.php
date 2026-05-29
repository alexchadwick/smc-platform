<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Training\Api\Database\Factories\CourseFactory as ModelFactory;

class Course extends Model {

    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return ModelFactory::new();
    }

    public function attempts()
    {
        return $this->hasMany(config('smc-training.models.course_attempt'));
    }

    public function courseables()
    {
        return $this->hasMany(config('smc-training.models.courseable'), 'course_id');
    }

    public function course_enrollments()
    {
        return $this->hasMany(config('smc-training.models.course_enrollment'));
    }

    protected $table = "courses";

    protected $fillable = [
        'id', //todo tory remove
        'name',
        'description',
        'footer_html',
        'header_html',
    ];

    /**
     * Scope a search
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $searchText)
    {
        return $query
            ->where('courses.id', 'LIKE', '%'.$searchText.'%')
            ->orWhere('courses.description', 'LIKE', '%'.$searchText.'%')
            ;
    }



}