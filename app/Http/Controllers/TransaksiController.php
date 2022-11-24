<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Hotel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Transaksi::all();

        return response()->json([
            "message" => "Data Pemesanan",
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
        if (auth('sanctum')->user()->is_admin == 1) {
            $table = new Transaksis();
            $table->nama = $request->nama ? $request->nama : $table->nama;
            $table->email = $request->email ? $request->email : $table->email;
            $table->telp = $request->telp ? $request->telp : $table->telp;
            $table->tanggal_masuk = $request->tanggal_masuk ? $request->tanggal_masuk : $table->tanggal_masuk;
            $table->tanggal_keluar = $request->tanggal_keluar ? $request->tanggal_keluar : $table->tanggal_keluar;
            $table->pembayaran = $request->pembayaran ? $request->pembayaran : $table->pembayaran;
            $table->save();

        return response()->json([
            "message" => "Data pemesanan berhasil ditambahkan",
            "data" => $table
        ], 201);} else {
            return response()->json([
                "message" => "Hanya bisa diakses oleh user",
            ], 404);
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
        $table = Transaksi::find($id);
        if($table){
            return $table;
        }else{
            return ["message" => "Data pemesanan tidak ditemukan"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Transaksi::find($id);
        if($table){
            $table->delete();
            return ["message" => "Data pemesanan berhasil dihapus"];
        }else{
            return ["message" => "Data pemesanan tidak ditemukan"];
        }
    }
}
