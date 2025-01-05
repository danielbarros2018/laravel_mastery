<?php

namespace App\Services;

class MessageServices
{
    public static function addFlash(string $key, string $message)
    {
        session()->flash($key, $message);
    }
}