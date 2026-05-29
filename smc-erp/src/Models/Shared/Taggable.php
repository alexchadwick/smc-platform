<?php

namespace SMC\ERP\Api\Models\Shared;

use SMC\ERP\Api\Database\Factories\TagggedItemFactory as ModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taggable extends Model
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
        return config('smc-erp.table_names.tagged_items');
    }


    protected static function newFactory()
    {
        return ModelFactory::new();
    }

    public function taggable(){
        return //TODO;
    }

    /**
     * Scope a query to only include divisions with organization.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasTaggable($query)
    {
        return $query->has('taggable', '>', 0);
    }

}
