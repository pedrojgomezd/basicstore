<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('customer')->get();

        return view('admin.dashboard')->withPurchases($purchases);
    }
}
