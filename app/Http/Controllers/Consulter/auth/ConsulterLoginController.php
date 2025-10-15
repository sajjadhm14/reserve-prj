<?php

namespace App\Http\Controllers\Consulter\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsulterLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('consulter.auth.consulter-login');
    }

    public function login(Request $request)
    {

    }

}
