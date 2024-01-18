<?php

namespace App\Http\Resources;
use App\Http\Resources\itemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'cusine_type'=>$this->cusine_type,
            'review'=>$this->review,
            'loction'=>$this->loction,
             'phone'=>$this->phone,
             'menu'=>itemResource::collection($this->items)
        ];
    }
}
