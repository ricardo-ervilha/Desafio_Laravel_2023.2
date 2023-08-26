<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        $consultations = Consultation::paginate(10);
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

        if($request->startDate >= $request->endDate){
            //Handle Error para caso o horário de início seja maior igual ao horário de término.

            return back()->with('message', 'Horário de início está igual ou depois do horário de término!');
        }

        $consultations = DB::table('consultations')->where('user_id', '=', Auth::user()->id)->get();

        $request->startDate = str_replace('T', ' ', $request->startDate);
        $request->endDate = str_replace('T', ' ', $request->endDate);
        foreach($consultations as $consult){

            if($request->startDate >= $consult->startDate && $request->startDate < $consult->endDate){
                return back()->with('message-error', 'Conflito de horário!');
            }else if($request->startDate <= $consult->startDate && $request->endDate > $consult->startDate){
                return back()->with('message-error', 'Conflito de horário!');
            }
        }

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

    public function createTreatment(Request $request)
    {
        $request->validate([
            'diagnostic' => ['required'],
            'guidelines' => ['required'],
            'medicines' => ['required'],
            'extraInfos'=> ['required']
        ]);

        DB::beginTransaction();

        $treatment = new Treatment([
            'diagnostic' => $request->diagnostic,
            'guidelines' => $request->guidelines,
            'medicines' => $request->medicines,
            'extraInfos'=> $request->extraInfos
        ]);
        $treatment->save();

        $consultation = Consultation::find($request->id);
        $consultation->treatment()->associate($treatment);
        $consultation->update();

        DB::commit();

        $request->session()->flash('message', 'Tratamento adicionado com sucesso!');

        return redirect('/consultations');
    }
}
