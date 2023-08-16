<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        $consultations = Consultation::all();
        $animals = $owners[0]->animals;
        return view('consultations.index')->with('consultations', $consultations)->with('owners', $owners)->with('animals', $animals);
    }

    public function animals(Request $request)
    {
        $owner = Owner::find($request->id);

        return response()->json($owner->animals);
    }

    public function create(Request $request)
    {
        $request->validate([
            'startDate' => ['required'],
            'endDate' => ['required'],
            'coast' => ['required'],
            'animal_id'=> ['required']
        ]);

        $coast = str_replace('R$ ', '', $request->coast);
        $coast = str_replace(',', '.', $coast);

        DB::beginTransaction();

        $consultation = new Consultation([
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'coast' => $coast,
            'animal_id'=> $request->animal_id
        ]);

        $user = User::find(Auth::user()->id);
        $consultation->user()->associate($user);

        $animal = Animal::find($request->animal_id);
        $consultation->animal()->associate($animal);

        $consultation->save();

        DB::commit();

        $request->session()->flash('message', 'Consulta agendada com sucesso!');

        return redirect('/consultations');
    }
}
