<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ValidateErrorResource extends JsonResource
{
    public $with = ['success' => false, 'validate' => true];

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
