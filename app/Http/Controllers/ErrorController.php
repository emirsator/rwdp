<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function warning($message = "") 
    {
        return view('errors.warning', compact('message'));
    }
}
