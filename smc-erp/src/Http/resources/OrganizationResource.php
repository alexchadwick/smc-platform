<?php

namespace ERP\Api\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'organization_type' => new OrganizationTypeResource($this->whenLoaded('organizationType')),
            //META
            'name' => $this->name,
            'description' => $this->description,
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