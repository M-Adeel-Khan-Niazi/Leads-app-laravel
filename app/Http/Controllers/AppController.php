<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use App\Models\Installer;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard()
    {
        $total_agents = User::where('role', 'agent')->count();
        $total_installers = Installer::count();
        $total_funders = Funder::count();
        $total_leads = Leads::count();
        return view('index', compact('total_agents', 'total_installers', 'total_funders', 'total_leads'));
    }
}
