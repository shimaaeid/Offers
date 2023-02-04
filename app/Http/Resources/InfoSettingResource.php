<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoSettingResource extends JsonResource
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
            'forceUpdate' => $this->forceUpdate,
            'lastBuild' => $this->lastBuild,
            'website' => $this->website,
            'whatsApp' => $this->whatsApp,
            'phone' => $this->phone,
            'snap' => $this->snap,
            'Instagram' => $this->Instagram,
            'ticktock' => $this->ticktock,
            'policy' => $this->policy,
            'android' => $this->android,
            'ios' => $this->ios,

        ];
    }
}
