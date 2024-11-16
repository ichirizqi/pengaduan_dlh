<?php

namespace App\Http\Controllers;

use App\Models\Statuspengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatuspengaduanController extends Controller
{
    // MENAMPILKAN DATA
    public function index()
    {
        return Statuspengaduan::when(request('search'), function($query) {
            $query->where('nama', 'like', '%'. request('search'). '%');
        })->paginate(5);

    }

    // MENAMPILKAN DATA
    public function indexDinas()
    {
      //get data from table
      $status = Statuspengaduan::first()->get();

      //make response JSON
      return response()->json([
          'success' => true,
          'message' => 'List Data',
          'data'    => $status  
      ], 200);

    }

    // MENAMPILKAN DATA SESUAI ID
    public function show($id)
    {
        //find by ID
        $status = Statuspengaduan::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $status 
        ], 200);

    }

    // MENYIMPAN DATA
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required'
        ]);
        
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        //save to database
        $status = Statuspengaduan::create([
            'nama'     => $request->nama
        ]);

            //success save to database
            if($status) {

                return response()->json([
                    'success' => true,
                    'message' => 'Menambahkan Data',
                    'data'    => $status  
                ], 201);

            } 

            //failed save to database
            return response()->json([
                'success' => false,
                'message' => 'Data gagal disimpan',
            ], 409);

    }

    // UPDATE DATA
    public function update(Request $request, Statuspengaduan $status, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required'
        ]);
        
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        //find by ID
        $status = Statuspengaduan::findOrFail($id);

            if($status) {

                //update
                $status->update([
                    'nama'     => $request->nama
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Data Update',
                    'data'    => $status  
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
        $status = Statuspengaduan::findOrfail($id);

            if($status) {

                //delete
                $status->delete();

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
