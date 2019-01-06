<?php

namespace App\Http\Controllers;

class SandboxController extends Controller
{
    // GET /sandbox/index
    public function index()
    {
        return view('sandbox.index');
    }
}
