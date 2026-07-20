<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class FaceclaimController extends Controller
{
    public function index()
    {
        return view('faceclaim.index');
    }
}
