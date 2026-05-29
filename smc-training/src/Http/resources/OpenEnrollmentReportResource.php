<?php

namespace Training\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpenEnrollmentReportResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            //ID
            'id' => $this->id,
            'course' => $this->course,
            'participant' => $this->participant,
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,

        ];
    }

}