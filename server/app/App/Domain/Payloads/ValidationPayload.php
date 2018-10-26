<?php
namespace App\App\Domain\Payloads;
use App\App\Domain\Payloads\Payload;
class ValidationPayload extends Payload {
    protected $status = 422;
    public function getData() {
        return [
            'errors' => $this->data,
        ];
    }
}