<?php

namespace App\Http\Controllers;

use App\Models\Peranpengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeranpenggunaController extends Controller
{
    

    // MENAMPILKAN DATA
    public function index()
    {
        //get data from table
        $peran = Peranpengguna::first()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data',
            'data'    => $peran  
        ], 200);

    }

    // MENAMPILKAN DATA SESUAI ID
    public function show($id)
    {
        //find by ID
        $peran = Peranpengguna::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $peran 
        ], 200);

    }

    // MENYIMPAN DATA
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'prioritas' => 'required'
        ]);
        
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        //save to database
        $peran = Peranpengguna::create([
            'nama'     => $request->nama,
            'prioritas' => $request->prioritas
        ]);

            //success save to database
            if($peran) {

                return response()->json([
                    'success' => true,
                    'message' => 'Menambahkan Data',
                    'data'    => $peran  
                ], 201);

            } 

            //failed save to database
            return response()->json([
                'success' => false,
                'message' => 'Data gagal disimpan',
            ], 409);

    }

    // UPDATE DATA
    public function update(Request $request, Peranpengguna $peran, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'prioritas'   => 'required'
        ]);
        
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        //find by ID
        $peran = Peranpengguna::findOrFail($id);

            if($peran) {

                //update
                $peran->update([
                    'nama'     => $request->nama,
                    'prioritas'     => $request->prioritas
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Data Update',
                    'data'    => $peran  
                ], 200);

            }

            //data not found
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);

    }


    // HAPUS DATA
    public function destroy($id)
    {
        //find by ID
        $peran = Peranpengguna::findOrfail($id);

            if($peran) {

                //delete
                $peran->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Data dihapus',
                ], 200);

            }

            //data not found
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
    }
}
