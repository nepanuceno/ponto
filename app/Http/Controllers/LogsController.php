<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        $start_date = $this->formatDates($dates[0]);
        $end_date = $this->formatDates($dates[1]);

        $logs = Activity::where('causer_id', $request->user_id)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();

        return view('logs.list', compact('logs'));
    }

    private function formatDates($date)
    {
        $date = Carbon::createFromIsoFormat('DD/MM/Y h:mm a', $date, 'UTC');
        return $date->isoFormat('YYYY-MM-DD HH:mm'); // 2022/01/21 18:33
    }
}