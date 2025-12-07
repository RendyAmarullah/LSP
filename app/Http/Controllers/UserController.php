<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data user, diurutkan dari yang terbaru
        // paginate(10) artinya menampilkan 10 user per halaman
        $users = User::where('role', 'mahasiswa')->paginate(10);

        return view('admin.akun', compact('users'));
    }
}
