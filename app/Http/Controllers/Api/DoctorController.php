<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Doctor::all(),200);
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $doctor = Doctor::create([
            'name' => $request->name,
        ]);

        return response()->json(['massage' => 'Hi '.$doctor->name.', Berhasil di buat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Doctor::findOrFail($id),200);
    }


    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $validator = \Validator::make($request->all(),[
            'name' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $doctor->name = $request->name;

        $doctor->save();
        return response()
            ->json(['massage' => 'Doctor '.$doctor->name.', Berhasil dinuat']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->save();

        return response()->json(['massage' => 'Hi '.$doctor->name.',Berhasil di hapus']);
    }
}
