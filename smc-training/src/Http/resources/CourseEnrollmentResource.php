<?php

namespace Training\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseEnrollmentResource extends JsonResource
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

            //'course' => $this->whenLoaded(new CourseResource($this->course)),
            'completed_at' => $this->completed_at,
            'course' => $this->course,
            'course_id' => $this->course_id,
            'attempts_count' => auth()->user()->course_enrollments()->where('course_id', $this->course['id'])->count(),

            'is_completed' => (bool)(isset($this->completed_at) && $this->completed_at ? true : false),
            'is_deleted' => (bool)(isset($this->deleted_at) && $this->deleted_at ? true : false),
            //TIMESTAMPS
            'created_at' => $this->created_at,
            'created_at_timestamp' => $this->created_at->timestamp,
            'updated_at_timestamp' => $this->updated_at->timestamp,
            //If deleted, return deleted_at timestamp
            'deleted_at_timestamp' => $this->when($this->deleted_at, function () {
                return $this->deleted_at->timestamp;
            }),
        ];
    }

}