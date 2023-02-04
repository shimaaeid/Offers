<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'image_path' => $this->image_path,
            'title' => $this->title,
            // 'shop_id' => $this->shop_id,
            // 'shop_image' => $this->shop->profile_path,
            // 'shop_name' => $this->shop->name,
            // 'category_id' => $this->shop->category->id,
            // 'category_name' => $this->shop->category->name,
            // 'category_image' => $this->shop->category->image_path,
        ];
    }
}
