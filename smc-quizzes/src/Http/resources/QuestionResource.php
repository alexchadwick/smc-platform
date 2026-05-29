<?php

namespace Quiz\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            //RELATIONS
            'question_type' => new QuestionTypeResource($this->whenLoaded('questionType')),
            //META
            'question_type_id' => $this->question_type_id,
            'name' => $this->name,
            'media_url' => $this->media_url,
            'media_type' => $this->media_type,
            'is_active' => (boolean) $this->is_active,
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