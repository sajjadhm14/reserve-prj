<?php

namespace App\Http\Controllers\Consulter;

use App\Http\Controllers\Controller;
use App\Models\consulter;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ConsulterController extends Controller
{
    public function index()
    {
        return view('consulter.consulter-dashboard');
    }

    public function reservationCheck()
    {
        return view ('consulter.pages.reservation-check');
    }

    public function ConsulterInfo()
    {
        return view ('consulter.pages.info');
    }
}
