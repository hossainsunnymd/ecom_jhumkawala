<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //customer dashboard
    public function dashboard(){
        return Inertia::render('Frontend/AccountDashboard');
    }
}
