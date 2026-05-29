<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Training\Api\Database\Factories\CourseTypeFactory as ModelFactory;

class CourseType extends Model {

    use HasFactory, SoftDeletes;

    public const DOCUMENT = 1,VIDEO =2,QUIZ=3;

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

    protected static function newFactory()
    {
        return ModelFactory::new();
    }
    protected $table = "course_types";

  /*  protected $fillable = [
        'name'
    ];*/

}