<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Animal;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{

    public function search(Request $request){
        $search = request('search');

        $owners = Owner::where('name', 'like', '%'.$search.'%')->paginate(10);

        return view('owners.index')->with('owners', $owners);
    }

    public function show(Request $request)
    {
        $id = request('id');

        $owner = Owner::find($id);

        return view('owners.show')->with('owner', $owner);
    }

    public function index()
    {
        $owners = Owner::paginate(10);

        return view('owners.index')->with('owners', $owners);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'dateBirth' => ['required'],
            'phone' => ['required'],
            'cpf' => ['required', 'cpf'],
            'cep' => ['required'],
            'publicPlace' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'uf' => ['required'],
            'city' => ['required'],
            'num' => ['required'],
        ]);

        $imageName = null;

        if($request->hasFile('image')){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->image->move(public_path('img/avatars'), $imageName);
        }

        DB::beginTransaction();

        $address = new Address([
            'cep' => $request->cep,
            'publicPlace' => $request->publicPlace,
            'district' => $request->district,
            'uf' => $request->uf,
            'city' => $request->city,
            'num' => $request->num
        ]);

        $address->save();

        $owner = new Owner([
            'name' => $request->name,
            'email' => $request->email,
            'dateBirth' => $request->dateBirth,
            'phone' => $request->phone,
            'cpf' => $request->cpf,
            'isAdmin' => false,
            'profilePhoto' => $imageName
        ]);

        $owner->address()->associate($address);
        $owner->save();

        DB::commit();

        $request->session()->flash('message', 'Proprietário cadastrado com sucesso!');

        return redirect('/owners');
    }

    public function delete(Request $request)
    {
        $owner = Owner::find($request->id);

        DB::beginTransaction();

        //Deleta os animais do proprietário
        $animals = $owner->animals;

        foreach($animals as $animal){
            $consults = Consultation::where('animal_id', $animal->id)->get();
            foreach($consults as $consult){
                $consult->delete();
            }
            $animal->delete();
        }

        //Deleta o proprietário e seu endereço
        $owner->address()->delete();
        $owner->delete();

        DB::commit();

        $request->session()->flash('message', "Proprietário removido com sucesso!");

        return redirect()->route('owners.index');
    }

    public function edit(Request $request){
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:'.User::class],
            'cpf' => ['cpf'],
            'publicPlace' => ['string', 'max:255'],
            'district' => ['string', 'max:255'],
        ]);

        $owner = Owner::find($request->id);

        $imageName = null;

        if($request->hasFile('image')){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->image->move(public_path('img/avatars'), $imageName);
        }
        if($imageName != null){
            $owner->update([
                'name' => $request->name,
                'email' => $request->email,
                'dateBirth' => $request->dateBirth,
                'phone' => $request->phone,
                'cpf' => $request->cpf,
                'profilePhoto' => $imageName
            ]);
        }else{
            $owner->update([
                'name' => $request->name,
                'email' => $request->email,
                'dateBirth' => $request->dateBirth,
                'phone' => $request->phone,
                'cpf' => $request->cpf,
            ]);
        }


        $owner->address()->update([
            'cep' => $request->cep,
            'publicPlace' => $request->publicPlace,
            'district' => $request->district,
            'uf' => $request->uf,
            'city' => $request->city,
            'num' => $request->num
        ]);

        $request->session()->flash('message', "Dados alterados com sucesso!");

        return redirect()->route('owners.index');
    }
}
