<?php

namespace Training\Api\Traits;

trait HasAttachment
{
    public function attachment()
    {
        return $this->morphOne(config('smc-training.models.attachment'), 'attachable');
    }


}
