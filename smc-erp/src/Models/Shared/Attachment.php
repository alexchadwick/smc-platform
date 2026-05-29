<?php

namespace SMC\ERP\Api\Models\Shared;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SMC\ERP\Api\Database\Factories\AttachmentFactory as ModelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model {

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
        return config('smc-erp.table_names.attachments');
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
            get: fn ($value, $attributes) => $attributes['attachment_file_name'],
            set: fn ($value) => ['attachment_file_name' => $value],
        );
    }


    protected static function newFactory()
    {
        return ModelFactory::new();
    }

    public function attachable(){
        return //TODO;
    }

    /**
     * Scope a query to only include model with attachable.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasAttachable($query)
    {
        return $query->has('attachable', '>', 0);
    }
}