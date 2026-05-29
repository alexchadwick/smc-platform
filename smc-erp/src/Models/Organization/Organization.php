<?php

namespace SMC\ERP\Api\Models\Organization;

use SMC\ERP\Api\Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
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
        return config('smc-erp.table_names.organizations');
    }

    /**
     * Backward compatibility of the attribute
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function label(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['name'],
            set: fn ($value) => ['name' => $value],
        );
    }


    protected static function newFactory()
    {
        return OrganizationFactory::new();
    }

    public function divisions(){
        return $this->hasMany(OrganizationDivision::class);
    }

    public function locations(){
        return //TODO;
    }


    /**
     * Scope a query to only include organizations with divisions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasDivisions($query)
    {
        return $query->has('divisions', '>', 0);
    }

    /**
     * Scope a query to only include organizations with locations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasLocations($query)
    {
        return $query->has('locations', '>', 0);
    }


}
