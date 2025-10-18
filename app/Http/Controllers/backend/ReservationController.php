<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\consulter;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(){
        $consulters = consulter::all();
        return view('user.pages.reservation-index' , compact('consulters'));
    }

    public function store(Request $request)
    {




        $request ->validate([
          'consulter_id' => 'required',
          'date' => 'required|date|after_or_equal:today',
          'time' => 'required',
        ]);

//      i want to check if time exists or not ?

        $exists = Reservation::where('consulter_id' , $request->consulter_id)
                                ->where('date' , $request->date)
                                ->where('time' , $request->time)
                                ->exists();


        if($exists){
            return response()->json([
                'message' => 'consulter is fulled sorry',
            ]);
        }

        $reservation = Reservation::create([
            'user_id' =>Auth::id(),
            'consulter_id' => $request->consulter_id,
            'date' => $request->date,
            "time" => $request->time ??null,
            'status'=>'pending',
        ]);


        return response()->json([
            'message' => 'your time is reserved successfully',
            'data' =>$reservation,
        ]);

    }
}
