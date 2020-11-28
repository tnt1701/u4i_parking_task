<?php

class MessageResponse
{
    public $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
