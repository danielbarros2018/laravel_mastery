<?php

namespace App\Http\Controllers\Hello;

use App\Http\Controllers\Controller;

class HelloWorldController extends Controller
{
    public function helloWorld()
    {
        return view('hello-world');
    }

    public function hello(string $name = '')
    {
        return 'Hello '.$name;
    }
}
