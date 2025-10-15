<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(){
        return view('admin.pages.reservation-index');
    }

    public function store(Request $request)
    {
        $request ->validate([
          'consultant_id' => 'required',
          'date' => 'required|date|after_or_equal:today',
        ]);

//      i want to check if time exicts or not ?

        $exists = Reservation::where('consulter_id' , $request->consulter_id)
//                                ->where('date' , $request->date)
                                ->exists();


        if($exists){
            return response()->json([
                'message' => 'consulter is fulled sorry',
            ]);
        }

        $reservation = Reservation::create([
            'user_id' =>Auth::id(),
            'consultant_id' => $request->consulter_id,
//            'date' => $request->date,
        ]);

        return response()->json([
            'message' => 'your time is reserved successfully',
            'data' =>$reservation,
        ]);

    }
}
