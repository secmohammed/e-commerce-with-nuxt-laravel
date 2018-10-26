<?php
namespace App\App\Domain\Payloads;
abstract class Payload {
    protected $data = null;
    protected $status = 200;
    public function __construct($data = null, $status = null) {
        if (isset($data)) {
            $this->data = $data;
        }
        if (isset($status)) {
            $this->status = $status;
        }
    }
    public function getData() {
        return $this->data;
    }
    public function getStatus() {
        return $this->status;
    }
}