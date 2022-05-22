<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regional;

class RegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Regional::all(),200);
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'province' => 'required|string',
            'district' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $regional = Regional::create([
            'province' => $request->province,
            'district' => $request->district,
        ]);

        return response()->json(['massage' => 'Hi '.$regional->province.', Berhasil di buat']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Regional::findOrFail($id));
    }


    public function update(Request $request, $id)
    {
        $regional = Regional::findOrFail($id);
        $validator = \Validator::make($request->all(),[
            'province' => 'required|string',
            'district' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $regional->province = $request->province;
        $regional->district = $request->district;

        $regional->save();
        return response()->json(['massage' => 'Hi '.$regional->province.', Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $regional = Regional::find($id);
        $regional->delete();

        return response()->json(['massage' => 'Province '.$regional->name.', Berhasil di hapus ']);
    }
}
