<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Mail\SendEmailToOwners;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('mail.message');
    }

    public function send(Request $request)
    {
        $owners = Owner::all();

        foreach($owners as $index => $owner){
            $multiplicador = $index + 1;
            $email = new SendEmailToOwners($request->header, $request->greetings, $request->firstParagraph, $request->secondParagraph, $request->thanks, Auth::user()->name);
            $when = now()->addSeconds($multiplicador * 5);
            Mail::to($owner)->later($when, $email);
        }

        $request->session()->flash('message', 'E-mails enviados com sucesso!');

        return redirect('/email/index');
    }
}
