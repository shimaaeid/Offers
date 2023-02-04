<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'opening_hours' => $this->opening_hours,
            'location' => $this->location,
            'location_url' => $this->location_url,
            'whatsapp' => $this->whatsapp,
            'insta' => $this->insta,
            'snap' => $this->snap,
            'web_site' => $this->web_site,
            'shoptype_id' => $this->shopType->name,
            'subscription_date' => $this->subscription_date,
            'expire_date' => $this->expire_date,
            'months' => $this->months,
            'category_id' => $this->category->id,
            'category_name' => $this->category->name,
            'category_image' => $this->category->image_path,
            'packagetype_id' => $this->packageType->name,
            'description' => $this->description,
            'profile_path' => $this->profile_path,
            'cover_path' => $this->cover_path,
            'active' => $this->active,
            'watch' => $this->watch,

        ];
    }
}
