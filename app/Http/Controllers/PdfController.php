<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function index()
    {
        $distinctYears = DB::table('consultations')
            ->select(DB::raw('YEAR(startDate) as year'))
            ->distinct()->orderBy('year', 'asc')
            ->get();

        $years = $distinctYears->pluck('year');

        return view('pdfs.index')->with('years', $years);
    }

    public function generate(Request $request)
    {

        $consultations = Consultation::select('*')
            ->whereYear('startDate', request('year'))
            ->orderByRaw('MONTH(startDate) ASC')
            ->get();


        $animals = null;
        $owners = null;


        foreach($consultations as $consultation){
            $animals[$consultation->animal_id] = Animal::find($consultation->animal_id);
            $owner_id = $animals[$consultation->animal_id]->owner_id;
            $owners[$owner_id] = Owner::find($owner_id);
        }

        $meses = [
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];



        $pdf = Pdf::loadView('pdfs.templatePdf', compact('consultations', 'animals', 'owners', 'meses'));

        return $pdf->setPaper('A4')->stream('relatorioConsultas.pdf');
    }
}
