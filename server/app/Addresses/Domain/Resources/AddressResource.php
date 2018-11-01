<?php

namespace App\Addresses\Domain\Resources;

use App\Countries\Domain\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_1' => $this->address_1,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => new CountryResource($this->country),
            'default' => $this->default
        ];
    }
}