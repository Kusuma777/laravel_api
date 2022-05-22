<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'id_card_number' => 'required|min:16|max:16',
            'password' => 'required|string',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $society = Society::where('id_card_number', $request->id_card_number)->first();
        if($society){
            if(\Hash::check($request->password, $society->password)){
                $society->token = md5($request->id_card_number);
                $society->save();

                return response()->json(Society::where('id_card_number', $request->id_card_number)
                ->with('regional')->first(),200);
            }else{
                return response()->json(['massage' => 'ID card number or Password incorrect'],401);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $society = Society::where('token', $request->token)->firstOrFail();
        if($society){
            $token = null;
            $token->save();

            return response()->json(['massage' => 'Logout Success'],200);
        }else{
            return response()->json(['massage' => 'Token Invalid'],401);
        }
    }


}
