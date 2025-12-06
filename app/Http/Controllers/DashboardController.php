<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // PASTIKAN NAMA METHOD ADALAH 'dashboard' (sesuai yang dipanggil di rute)
    public function dashboard()
    {
        // Logika untuk menampilkan dashboard (misalnya, me-return view)
        return view('dashboard');
    }
    
    
}