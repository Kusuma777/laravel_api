<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Society;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $society = Society::where('token', $request->token)->first();
        if ($society) {

            $validator = \Validator::make($request->all(),[
                'disease_history' => 'required|string',
                'current_symptoms' => 'required|string',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            Consultation::create([
                'doctor_id' => '1',
                'society_id' => $society->id,
                'disease_history' => $request->disease_history,
                'current_symptoms' => $request->current_symptoms,
            ]);

            return response()->json(['message' => 'Request consultation sent successful'],200);
        } else {
            return response()->json(['message' => 'Unauthorized user'],401);
        }
    }

    public function show(Request $request)
    {
        $society = Society::where('token', $request->token)->first();
        if ($society) {
            return response()->json(['consultation' => Consultation::where('society_id', $society->id)
                ->with('doctor')->first()],200);
        } else {
            return response()->json(['message' => 'Unauthorized user'],401);
        }
    }
}
