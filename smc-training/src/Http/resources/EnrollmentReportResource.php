<?php

namespace Training\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentReportResource extends JsonResource
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
            'completed_at' => $this->completed_at,

            'is_completed' => (bool)(isset($this->completed_at) && $this->completed_at ? true : false),
            //If completed, return deleted_at timestamp
            'completed_at_timestamp' => $this->when($this->completed_at, function () {
                return $this->completed_at->timestamp;
            }),

            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,
            //If deleted, return deleted_at timestamp
            'deleted_at_timestamp' => $this->when($this->deleted_at, function () {
                return $this->deleted_at->timestamp;
            }),

        ];
    }

}