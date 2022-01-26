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
        $dates = explode(' - ', $request->dates);

        $start_date = formatDateToSql($dates[0], true);
        $end_date = formatDateToSql($dates[1], true);

        $logs = Activity::where('causer_id', $request->user_id)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->orderByDesc('created_at')
                ->get();

        return view('logs.list', compact('logs'));
    }
}
