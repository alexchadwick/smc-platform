<?php

namespace Quiz\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizAttemptResource extends JsonResource
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
            'participant' => new ParticipantResource($this->whenLoaded('participant')),

            //META
            'quiz_id' => $this->quiz_id,
            'participant_id' => $this->participant_id,
            'participant_type' => $this->participant_type,

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