<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnlineOffersResource extends JsonResource
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
            'id' => $this->offers->id,
            'image_path' => $this->offers->image_path,
            'title' => $this->offers->title,
            'shop_id' => $this->offers->shop_id,
            'shop_image' => $this->offers->shop->profile_path,
            'shop_name' => $this->offers->shop->name,
            'category_id' => $this->offers->shop->category->id,
            'category_name' => $this->shop->offers->category->name,
            'category_image' => $this->offers->shop->category->image_path,
        ];
    }
}
