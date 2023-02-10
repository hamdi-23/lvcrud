<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangController extends Controller
{
    public function index()
    {
        return view('index');
    }

    function addtransaksi()
    {
        return view('addtransaksi');
    }
}
