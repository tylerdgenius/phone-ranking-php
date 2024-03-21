<?php

class ResponseObject {
    public string $message;
    public string $status;
    public $payload;
    
    public function __construct($status, $message, $payload) {
        $this->payload = $payload;
        $this->message = $message;
        $this->status = $status;
    }
}