<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Панель администратора
    public function panel()
    {
        return view('admin.panel');
    }
}