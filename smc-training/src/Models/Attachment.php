<?php

namespace Training\Api\Models;

use Illuminate\Database\Eloquent\Model;
///use Training\Order\Api\Traits\HasLinkable;

class Attachment extends Model {

    //use HasLinkable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}