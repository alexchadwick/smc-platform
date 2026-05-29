<?php

namespace SMC\ERP\Api\Models\Shared;

use SMC\ERP\Api\Database\Factories\AddressFactory as ModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
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
        return config('smc-erp.table_names.addresses');
    }


    protected static function newFactory()
    {
        return ModelFactory::new();
    }

    public function addressable(){
        return //TODO;
    }

    /**
     * Scope a query to only include model with addressable.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasAddressable($query)
    {
        return $query->has('addressable', '>', 0);
    }

}
