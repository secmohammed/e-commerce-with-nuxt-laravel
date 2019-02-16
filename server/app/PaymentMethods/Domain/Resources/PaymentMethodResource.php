<?php

namespace App\PaymentMethods\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id, 
            'card_type' => $this->card_type,
            'last_four' => $this->last_four,
            'default' => $this->default
        ];
    }
}
