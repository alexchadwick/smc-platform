<?php

namespace Training\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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

            'name' => $this->name, //text

            'description' => $this->description, //text

            'footer_html' => $this->footer_html, //text
            'header_html' => $this->header_html, //text
            //'custom_css' => $this->custom_css, //text

            'has_footer_html' => (bool)(isset($this->footer_html) && !empty($this->footer_html) ? true : false),
            'has_header_html' => (bool)(isset($this->header_html) && !empty($this->header_html) ? true : false),
            //'has_custom_css' => (bool)(isset($this->custom_css) && $this->custom_css ? true : false),

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