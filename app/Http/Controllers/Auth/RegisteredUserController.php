<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dateBirth' => ['required'],
            'phone' => ['required'],
            'workTime' => ['required'],
            'cep' => ['required'],
            'publicPlace' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'uf' => ['required'],
            'city' => ['required'],
            'num' => ['required']
        ]);


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

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dateBirth' => $request->dateBirth,
            'phone' => $request->phone,
            'workTime' => $request->workTime,
            'isAdmin' => false,
        ]);

        $user->address()->associate($address);
        $user->save();

        DB::commit();

        $request->session()->flash('message', 'Funcionário cadastrado com sucesso!');

        return redirect('/users');
    }
}
