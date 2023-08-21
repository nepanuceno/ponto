<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;
use View;

class TimeSheetController extends Controller
{
    private $data;

    public function index() {

        $year = Carbon::now();

        $currentYear = $year->year;
        $endYear = $year->subYears(2);
        $endYear = $endYear->year;

        $month = $year->month;
        if ($month == 12) {
            $month = 1;
            $currentYear = $currentYear + 1;
            $endYear = $endYear - 1;
        }

        $years = range($currentYear, $endYear);

        $departaments = Departament::where('status', 1)->get();
        $employees = Employee::where('active', 1)->get();

        return view('timesheets.index', compact('years', 'month', 'departaments', 'employees'));
    }


    public function makeTimeSheet(Request $request) {
        $dt = Carbon::create($request->year, $request->month);
        $month =$this->transtaleMonth($dt->format('m'));
        $year = $request->year;

        $month_days = range(1, $dt->daysInMonth);

        $arr_days = array();
        foreach($month_days as $key=>$day) {
            $dt = Carbon::create($request->year, $request->month, $day);
            $arr_aux = array('day'=> $key+1, 'week_day'=> $this->translateDay($dt->isoFormat('d')), 'raw_day' =>$dt->isoFormat('d'));
            $arr_days[] = $arr_aux;
        }

        $employees = Employee::where('active', 1);
        if ($request->departament != 0) {
            $employees->where('departament_id', $request->departament);
        }
        elseif ($request->employee != 0) {
            $employees->where('id', $request->employee);
        }
        $employees = $employees->get();

        // return view('timesheets.pdf', compact('employees', 'arr_days', 'month', 'year'));

        $pdf = PDF::loadView('timesheets.pdf', compact('employees', 'arr_days', 'month', 'year'))
            ->setOptions(
                [
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled'=>true,
                    'isRemoteEnabled' => true
                ]
            );

        $pdf_generated = $pdf->download('livroPonto.pdf');

        activity()
            ->withProperties(['time-sheet' => $employees])
            ->log('Gerou um livro de pontos em '. date('d/m/Y'));

        return $pdf_generated;
    }

    // Generate PDF
    public function createPDF() {
        $pdf = PDF::loadView('timesheets.pdf')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('livroPonto.pdf');
    }

    public function transtaleMonth($month) {

        switch ($month) {
            case '01':
                return "Janeiro";
                break;
            case '02':
                return "Fevereiro";
                break;
            case '03':
                return "Março";
                break;
            case '04':
                return "Abril";
                break;
            case '05':
                return "Maio";
                break;
            case '06':
                return "Junho";
                break;
            case '07':
                return "Julho";
                break;
            case '08':
                return "Agosto";
                break;
            case '09':
                return "Setembro";
                break;
            case '10':
                return "Outubro";
                break;
            case '11':
                return "Novembro";
                break;
            case '12':
                return "Dezembro";
                break;
            default:
                return "Mês desconhecido";
                break;
        }
    }

    public function translateDay($day) {
        switch ($day) {
            case '0':
                return "Domingo";
                break;
            case '1':
                return "Segunda-Feira";
                break;
            case '2':
                return "Terça-Feira";
                break;
            case '3':
                return "Quarta-Feira";
                break;
            case '4':
                return "Quinta-Feira";
                break;
            case '5':
                return "Sexta-Feira";
                break;
            case '6':
                return "Sábado";
                break;

            default:
                return "Dia desconhecido";
                break;
        }
    }
}

