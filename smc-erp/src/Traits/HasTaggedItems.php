<?php

namespace Training\Api\Traits;

trait HasTaggedItems
{
    public function taggedItems()
    {
        return $this->morphMany(config('smc-training.models.attachment'), 'attachable');
    }


}
