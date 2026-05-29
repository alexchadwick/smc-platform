<?php

namespace Training\Order\Api\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasLinkable {

    /**
     * @return mixed
     */
    public function link()
    {
        return $this->morphTo();
    }

}