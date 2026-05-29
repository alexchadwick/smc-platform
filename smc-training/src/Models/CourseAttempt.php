<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CourseAttempt extends Model {

    protected $table = "course_attempts";

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
    protected $dates = [
        'last_viewed',
    ];

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

    protected $appends = ['durationMin'];

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

    /**
     * Mark course completed, update enrollments
     * @return void
     */
    public function completeCourse() {

        //Look for enrollments and mark them completed
        $enrollments = $this->participant->course_enrollments()->where('course_id', $this->course_id)->get();
        foreach ($enrollments as $enrollment) {
            $enrollment->completed_at = now();
            $enrollment->save();
        }
        $this->completed_at = now();
        $this->last_viewed = now();
        $this->save();
    }

    /**
     * Backward compatibility of the attribute
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function durationMin(): Attribute
    {

        $lasViewedTimestamp = $this['last_viewed'];
        $totalDuration = $lasViewedTimestamp->diffInSeconds($this['created_at']);
        $str = gmdate('H:i:s', $totalDuration);
        return Attribute::make(
            get: fn ($value, $attributes) => $str,
        );
    }

    protected function getDurationMinAttribute() {
        //$data = $this->toArray();
        //return $this['durationMin'];
    }

    protected function durationMin2(): Attribute
    {

        return new Attribute(
            get: fn ($value, $attributes) => function() use($attributes) {
                $lasViewedTimestamp = $attributes['last_viewed'];
                $totalDuration = $lasViewedTimestamp->diffInSeconds($attributes['created_at']);
                $str = gmdate('H:i:s', $totalDuration);
                return $str;
            },
            set: fn ($value) => [],
        );
    }

    /*protected $fillable = [
        'id', //todo tory remove

    ];*/

}