<?php

namespace App\Http\Controllers\Consulter\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsulterLoginRequest;
use Illuminate\Http\Request;

class ConsulterLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('consulter.auth.consulter-login');
    }

    public function login(ConsulterLoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('consulter.index');
    }

}
