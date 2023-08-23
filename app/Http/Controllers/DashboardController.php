<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $totalConsultasNoMes = Consultation::whereMonth('startDate', Carbon::now()->month)
            ->whereYear('startDate', Carbon::now()->year)
            ->count();

        $totalFuncionarios = User::where('isAdmin', false)->count();

        $totalProprietarios = Owner::all()->count();

        $totalAnimais = Animal::all()->count();

        $consults = Consultation::select('*')
                    ->whereYear('startDate', Carbon::now()->year)
                    ->orderByRaw('MONTH(startDate) ASC')
                    ->get();


        $lucrosMensais = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $totalGanhos = 0;

        foreach($consults as $consult){
            $date = strtotime($consult->startDate);
            $month = getdate($date)['mon'] - 1;
//            dd($month);
            $lucrosMensais[$month] += $consult->coast;
            $totalGanhos += $consult->coast;
        }
        $json = json_encode($lucrosMensais);
        return view('dashboard')
            ->with('lucrosMensais', $json)
            ->with('totalConsultasNoMes', $totalConsultasNoMes)
            ->with('totalFuncionarios', $totalFuncionarios)
            ->with('totalProprietarios', $totalProprietarios)
            ->with('totalAnimais', $totalAnimais)
            ->with('totalGanhos', $totalGanhos);
    }
}
