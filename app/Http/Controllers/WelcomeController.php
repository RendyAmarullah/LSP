<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get(); 
        return view('welcome', compact('pengumuman')); 
    }
}
