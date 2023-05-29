<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->count();

        return view('dashboard', compact('members'));
    }
}
