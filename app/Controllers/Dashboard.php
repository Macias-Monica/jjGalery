<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $role = session()->get('role');
        
        if ($role == 'admin') {
            return view('dashboard/admin');
        } else {
            return view('dashboard/user');
        }
    }
}
