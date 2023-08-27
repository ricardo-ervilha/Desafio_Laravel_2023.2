<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    public function search(Request $request){
        $search = request('search');

        $animals = Animal::where('name', 'like', '%'.$search.'%')->paginate(10);

        $owners = Owner::all();
        $animalConsultations = null;
        foreach($animals as $animal){
            $animalConsultations[$animal->id] = $consultations = DB::table('consultations')
                ->join('treatments', 'consultations.treatment_id', '=', 'treatments.id')
                ->where('consultations.animal_id', '=', $animal->id)->get();
        }

        return view('animals.index')->with('animals', $animals)->with('owners', $owners)->with('animalConsultations', $animalConsultations);
    }

    public function index()
    {
        $animals = Animal::paginate(10);
        $owners = Owner::all();
        $animalConsultations = null;
        foreach($animals as $animal){
            $animalConsultations[$animal->id] = $consultations = DB::table('consultations')
                ->join('treatments', 'consultations.treatment_id', '=', 'treatments.id')
                ->where('consultations.animal_id', '=', $animal->id)->get();
        }
//        dd($animalConsultations);

        return view('animals.index')->with('animals', $animals)->with('owners', $owners)->with('animalConsultations', $animalConsultations);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dateBirth' => ['required'],
            'species' => ['required'],
            'breed' => ['required'],
            'owner_id' => ['required']
        ]);

        DB::beginTransaction();

        $animal = new Animal([
            'name' => $request->name,
            'dateBirth' => $request->dateBirth,
            'species' => $request->species,
            'breed' => $request->breed
        ]);

        $owner = Owner::find($request->owner_id);
        $animal->owner()->associate($owner);
        $animal->save();
        DB::commit();

        $request->session()->flash('message', 'Animal cadastrado com sucesso!');

        return redirect('/animals');
    }

    public function delete(Request $request)
    {
        $animal = Animal::find($request->id);

        DB::beginTransaction();

        $consults = Consultation::where('animal_id', $animal->id)->get();
        foreach($consults as $consult){
            $treatmentId = $consult->treatment->id;
            $consult->delete();
            Treatment::destroy($treatmentId);
        }

        $animal->delete();

        DB::commit();

        $request->session()->flash('message', "Animal removido com sucesso!");

        return redirect('/animals');
    }

    public function edit(Request $request)
    {
        $animal = Animal::find($request->id);

        $animal->update([
            'name' => $request->name,
            'dateBirth' => $request->dateBirth,
            'species' => $request->species,
            'breed' => $request->breed
        ]);

        $request->session()->flash('message', 'Animal editado com sucesso!');

        return redirect('/animals');
    }

}
