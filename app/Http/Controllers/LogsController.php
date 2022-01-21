<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('logs.index', compact('users'));
    }

    public function list(Request $request)
    {

        $logs = Activity::where('causer_id', $request->user_id)
                ->where('created_at', $request->start_date)
                ->get();
        return view('logs.list', compact('logs'));
    }
}
