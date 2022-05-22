<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Society;
use App\Models\SocietyVaccination;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function show(Request $request)
    {
        $society = Society::where('token', $request->token)->first();
        if ($society) {
            return response()->json(['spots' => Spot::with('availabe_vacine')->get()],200);
        } else {
            return response()->json(['message' => 'Unauthorized user'],401);
        }
    }

    public function showSpot(Request $request, $spot_id)
    {
        $date = date('Y-m-d');
        //jika date kosong set ke tgl sekarang, jika date ada ambil nilai dari kiriman data
        $spot = null;
        $vaccination = null;
        if (empty($request->date)){
            $date;
            $spot = Spot::find($spot_id)->where('date', $date)->with('availabe_vacine')->get();
            $vaccination = SocietyVaccination::where('spot_id', $request->spot_id)->count();
        } else {
            $date = $request->date;
            $spot = Spot::find($spot_id)->where('date', $date)->with('availabe_vacine')->get();
            $vaccination = SocietyVaccination::where('spot_id', $request->spot_id)->count();
        }

        $society = Society::where('token', $request->token)->first();
        if ($society) {
            return response()->json([
                'date' => date('M d, Y', strtotime($date)),
                'spots' => $spot,
                'vaccinations_count' => $vaccination
            ],200);
        } else {
            return response()->json(['message' => 'Unauthorized user'],401);
        }
    }
}
