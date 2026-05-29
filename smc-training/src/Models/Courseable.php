<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Training\Api\Traits\HasAttachment;

class Courseable extends Model
{
    use HasFactory, SoftDeletes, HasAttachment;

    protected $table = 'courseables';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getTable()
    {
        return config('smc-training.table_names.courseables');
    }

    /**
     * @return \Training\Api\Models\Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return mixed
     */
    public function courseable()
    {
        return $this->morphTo();
    }

}
