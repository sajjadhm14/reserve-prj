<?php

namespace App\Http\Controllers\Consulter\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsulterLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsulterLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('consulter.auth.consulter-login');
    }

    public function login(ConsulterLoginRequest $request)
    {

        if (Auth::guard('consulter')->attempt($request->only('email', 'password'))) {
            return redirect()->route('consulter.index');
        }
        $request->session()->regenerate();
        dump(2);
        return redirect()->route('consulter.index');
    }

}
