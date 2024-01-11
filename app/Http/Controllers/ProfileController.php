<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\Consultation;
use App\Models\Treatment;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function search(Request $request){
        $search = request('search');

        $users = User::where('name', 'like', '%'.$search.'%')->paginate(10);

        return view('users.index')->with('users', $users);
    }

    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view('users.index')->with('users', $users);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateGambiarra(Request $request) : View
    {
        $user = User::find($request->id);

        $user->fill($request->all());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return view('users.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => [ 'confirmed', Rules\Password::defaults()],
            'publicPlace' => ['string', 'max:255'],
            'district' => [ 'string', 'max:255'],
        ]);

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        DB::beginTransaction();
        $consults = Consultation::where('user_id', $user->id)->get();
        foreach($consults as $consult){
            $treatmentId = $consult->treatment->id;
            $consult->delete();
            Treatment::destroy($treatmentId);
        }
        $user->address()->delete();
        $user->delete();
        DB::commit();
        $request->session()->flash('message', "Usuário removido com sucesso!");

        return redirect()->route('users.index');
    }
}
