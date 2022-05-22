<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Society;

class SocietyController extends Controller
{
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'id_card_number' => 'required|exists:societies|min:16|max:16',
            'password' => 'required|string|min:8',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $society = Society::where('id_card_number', $request->id_card_number)->first();
        if($society){
            if(\Hash::check($request->password, $society->password)) {
                $society->token = md5($request->id_card_number);
                $society->save();

                return response()->json(Society::where('id_card_number', $request->id_card_number)
                ->with('regional')->get(),200);

            }else{
                return response()->json(['massage' , 'Incorrect ID card number or Password'],401);
            }
        }
    }

    public function logout(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'token' => 'required|string',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $society = Society::where('token', $request->token)->firstOrFail();
        if($society){
            $society->token = null;
            $society->save();

            return response()->json(['massage' => 'logout success'],200);
        }else{
            return response()->json(['massage' => 'Invalid token'],401);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Society::all(),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'regional_id' => 'required|exists:regionals,id',
            'id_card_number' => 'required|unique:societies|min:16|max:16',
            'name' => 'required|string',
            'born_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $society = Society::create([
            'regional_id' => $request->regional_id,
            'id_card_number' => $request->id_card_number,
            'name' => $request->name,
            'born_date' => $request->born_date,
            'gender' => $request->gender,
            'address' => $request->address,
            'password' => \Hash::make($request->password),
        ]);

        return response()->json(['massage' => 'Hi '.$society->name.',Berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Society::find($id),200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $society = Society::findOrFail($id);
        $validator = \Validator::make($request->all(),[
            'regional_id' => 'required|exists:regionals,id',
            'name' => 'required|string',
            'born_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $society->name = $request->name;
        $society->born_date = $request->born_date;
        $society->gender = $request->gender;
        $society->address = $request->address;

        $society->save();
        return response()->json(['massage' => 'Hi '.$society->name.', Berhasil di ubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $society = \Society::findOrFail($id);
        $society->delete();

        return response()->json(['massage' => 'Hi '.$society->name.',Berhasil di hapus ']);
    }
}
