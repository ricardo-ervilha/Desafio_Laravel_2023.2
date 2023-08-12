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
            'password' => Hash::make($request->password),
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
}
