<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function index()
    {
        return view('legal.mentions');
    }
}
