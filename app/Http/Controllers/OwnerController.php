<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        return view('owners.index')->with('owners', $owners);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'dateBirth' => ['required'],
            'phone' => ['required'],
            'cpf' => ['required'],
            'cep' => ['required'],
            'publicPlace' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'uf' => ['required'],
            'city' => ['required'],
            'num' => ['required'],
        ]);

        $profilePhoto = null;

        if($request->hasFile('profilePhoto')){

            $profilePhoto = $request->file('profilePhoto')->store('public/avatars');

        }
        $profilePhoto = str_replace("public/", "", $profilePhoto);

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
            'profilePhoto' => $profilePhoto
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
        $owner->address()->delete();
        $owner->delete();
        DB::commit();
        $request->session()->flash('message', "Proprietário removido com sucesso!");

        return redirect()->route('owners.index');
    }

    public function edit(Request $request){
        $owner = Owner::find($request->id);

        $profilePhoto = null;

        if($request->hasFile('profilePhoto')){

            $profilePhoto = $request->file('profilePhoto')->store('public/avatars');

        }
        $profilePhoto = str_replace("public/", "", $profilePhoto);

        $owner->update([
            'name' => $request->name,
            'email' => $request->email,
            'dateBirth' => $request->dateBirth,
            'phone' => $request->phone,
            'cpf' => $request->cpf,
            'profilePhoto' => $profilePhoto
        ]);

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
