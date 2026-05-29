<?php

namespace Training\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseDetailReportResource extends JsonResource
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
            'name' => $this->name,
            'attempts' => $this->attempts,
            'open_enrollment_count' => $this->course_enrollments->where('course_id', $this->id)->where('completed_at', null)->count(),
            'completed_enrollment_count' => $this->course_enrollments->where('course_id', $this->id)->where('completed_at' ,'!=', null)->count(),
            'total_enrollment_count' => $this->course_enrollments->where('course_id', $this->id)->count(),
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,

        ];
    }

}