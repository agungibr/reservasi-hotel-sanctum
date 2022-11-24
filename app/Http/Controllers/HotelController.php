<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Transaksi;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Hotel::all();

        return response()->json([
            "message" => "Data Kamar Hotel",
            "data" => $table
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate =Validator::make($request->all(), [
            'nama_kamar' => 'required|string',
            'no_kamar' => 'required|string',
            'kapasitas_kamar' => 'required|integer',
            'jenis_kamar' => 'required|string',
            'harga_kamar' => 'required|string',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:5000'
        ]);

        $file = $request->file('gambar');

        $imagename = uniqid().'-'.date('dmY').$file->getClientOriginalExtension();
        
        $request->file('gambar')->move(public_path('pictures/'), $imagename);

        $data = Hotel::create([
            'nama_kamar' => $request->nama_kamar,
            'no_kamar' => $request->no_kamar,
            'kapasitas_kamar' => $request->kapasitas_kamar,
            'jenis_kamar' =>$request->jenis_kamar,
            'harga_kamar' =>$request->harga_kamar,
            'gambar' => $imagename
        ]);

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data kamar berhasil ditambahkan",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 400,
                'message' => "Data kamar gagal ditambahkan",
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Hotel::find($id);
        if($table){
            return $table;
        }else{
            return ["message" => "Data kamar tidak ditemukan"];
        }
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
        $data = $request->except(['_method']);
        $update = Hotel::where("id", $id)->update($data);

        return response()->json([
            "message" => "data berhasil diubah",
            "data" => $update
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Hotel::find($id);
        if($table){
            $table->delete();
            return ["message" => "Data kamar berhasil dihapus"];
        }else{
            return ["message" => "Data kamar tidak ditemukan"];
        }
    }
}
