<?php

namespace Training\Api\Traits;

trait HasAttachments
{
    public function attachments()
    {
        return $this->morphMany(config('smc-training.models.attachment'), 'attachable');
    }


}
