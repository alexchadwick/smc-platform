<?php

namespace Quiz\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            //META
            'name' => $this->name, //text
            'description' => $this->description, //text
            'total_marks' => $this->total_marks, //text
            'pass_marks' => $this->pass_marks, //text
            'max_attempts' => $this->max_attempts, //text
            //TODO tory: make boolean, not a tinyInt
            'is_published' => $this->is_published, //text
            'media_url' => $this->media_url, //text
            'media_type' => $this->media_type, //text
            'duration' => $this->duration, //text
            'time_between_attempts' => $this->time_between_attempts, //text


            'valid_from_timestamp' => $this->when($this->valid_from, function () {
                return $this->valid_from->timestamp;
            }),
            'valid_upto_timestamp' => $this->when($this->valid_upto, function () {
                return $this->valid_upto->timestamp;
            }),
            //..
            'is_deleted' => (bool)(isset($this->deleted_at) && $this->deleted_at ? true : false),
            //TIMESTAMPS
            'created_at_timestamp' => $this->created_at->timestamp,
            'updated_at_timestamp' => $this->updated_at->timestamp,
            //If deleted, return deleted_at timestamp
            'deleted_at_timestamp' => $this->when($this->deleted_at, function () {
                return $this->deleted_at->timestamp;
            }),
        ];
    }

}