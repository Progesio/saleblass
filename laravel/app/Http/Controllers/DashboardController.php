<?php

namespace App\Http\Controllers;

use App\Models\UserWaPoliester;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = UserWaPoliester::join('users', 'user_wa_poliesters.user_id', '=', 'users.id')
            ->where('users.id', '=', auth()->id())
            ->get();

        return view('dashboard', ['data' => $data]);
    }
}
