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
        // $day =$this->translateDay($dt->isoFormat('d'));
        $year = $request->year;


        $month_days = range(1, $dt->daysInMonth);

        $arr_days = array();
        foreach($month_days as $key=>$day) {
            $dt = Carbon::create($request->year, $request->month, $day);
            $arr_aux = array('day'=> $key+1, 'week_day'=> $this->translateDay($dt->isoFormat('d')));
            $arr_days[] = $arr_aux;
        }


        $employees = Employee::where('active', 1);
        if ($request->departament != 0)
        $employees->where('departament_id', $request->departament);
        elseif ($request->employee != 0) {
            $employees->where('id', $request->employee);
        }
        $employees = $employees->get();

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
        //View::share('book_employees', [$employees, $arr_days, $month, $year]);
        //return view('timesheets.maketimesheets', compact('employees', 'arr_days', 'month', 'year'));
    }

    // Generate PDF
    public function createPDF() {

        // share data to view
        // view()->share('employee',$data);
        $pdf = PDF::loadView('timesheets.pdf')->setOptions(['defaultFont' => 'sans-serif']);
        //$pdf .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">';
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
                return "Mar??o";
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
                return "M??s desconhecido";
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
                return "Ter??a-Feira";
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
                return "S??bado";
                break;

            default:
                return "Dia desconhecido";
                break;
        }
    }
}

