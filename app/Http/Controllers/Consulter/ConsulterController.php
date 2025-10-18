<?php

namespace App\Http\Controllers\Consulter;

use App\Http\Controllers\Controller;
use App\Models\consulter;
use App\Models\Reservation;
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
        $auth = auth('consulter')->id();

        $reservations = Reservation::where('consulter_id', $auth)
            ->with('user')
            ->get();

        return view ('consulter.pages.reservation-check' , compact('reservations'));
    }

    public function ConsulterInfo()
    {
        return view ('consulter.pages.info');
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('consulter/login');
    }
}
