<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\AktivitasExport;
use Maatwebsite\Excel\Facades\Excel;

class AktivitasController extends Controller
{
    protected $status = null;
    protected $error = null;
    protected $data = null;

     // MENAMPILKAN DATA
     public function index()
     {
        $aktivitas = Aktivitas::with('get_pengaduan')->with('get_status')->get();
        // $aktivitas2 = $aktivitas::with('get_isu')->get();
        $success =  $aktivitas;
        

        // return response()->json($success, 200);
        return response()->json([
            'success' => true,
            'message' => 'List Data',
            'data'    => $success
        ], 200);
     }

    // MENYIMPAN DATA
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id_pengaduan'   => 'required',
            'kode_lacak'   => 'required',
            'narasi'   => 'required',
            'id_status' => 'required',
            'nama_pengadu' =>'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:15000',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                'error' => $validator->errors()
                ], 401);
        }
        $document = new Aktivitas();
        $date = Carbon::now()->toDateString();
        $document->id_pengaduan = $request->id_pengaduan;
        $document->kode_lacak = $request->kode_lacak;
        $document->tanggal = $request->tanggal =$date;
        $document->narasi = $request->narasi;
        $document->id_status = $request->id_status;
        $document->nama_pengadu = $request->nama_pengadu;

        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('aktivitas'), $file_name);
            $path = $file_name;
            $document->foto = $path;
        }

        try {
            $success['name'] =  $document;
            $document->save();
            $this->data = $document;
            $this->status = "success";
        } catch (QueryException $e) {
            $this->status = "failed";
            $this->error = $e;
        }

        return response()->json(['success' => $success]);
    }
    // public function store(Request $request)
    // {
    //     //set validation
    //     $validator = Validator::make($request->all(), [
    //         'id_pengaduan'   => 'required',
    //         'kode_lacak'   => 'required',
    //         'narasi'   => 'required',
    //         'id_status' => 'required',
    //         'nama_pengadu' =>'required'
    //     ]);
        
    //         //response error validation
    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 400);
    //         }

    //     //save to database
    //     $date = Carbon::now()->toDateString();
    //     $aktivitas = Aktivitas::create([
    //         'id_pengaduan'     => $request->id_pengaduan,
    //         'kode_lacak'     => $request->kode_lacak,
    //         'tanggal'   => $request->tanggal =$date,
    //         'narasi'     => $request->narasi,
    //         'id_status'     => $request->id_status,
    //         'nama_pengadu' => $request->nama_pengadu
    //     ]);

    //         //success save to database
    //         if($aktivitas) {

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Menambahkan Data',
    //                 'data'    => $aktivitas  
    //             ], 201);

    //         } 

    //         //failed save to database
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Data gagal disimpan',
    //         ], 409);

    // }


    public function show($id)
    {
        //
        try {
            if ($id) {
                $aktivitas = Aktivitas::with('get_status')->with('get_pengaduan')           
                ->where('id_pengaduan', $id)->get();
            } else {
                $aktivitas = Aktivitas::get();
            }
            $this->data = $aktivitas;
            $this->status = "success";
        } catch (QueryException $e) {
            $this->status = "failed";
            $this->error = $e;
        }
        return response()->json([
            "status" => $this->status,
            "data" => $this->data,
            "error" => $this->error
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        return Aktivitas::where('kode_lacak', 'like', '%'.$search.'%')
        ->with('get_status')->get();
    }

    public function countData(){
        $count = Aktivitas::where('id_status', '14')->count();
        return response()->json([
            "status" => true,
            "data" => $count
        ]);
    }

    public function export(Request $request)
	{
        $id= $request->id;
       

        // return Excel::download(new Verifikasi($transaction), 'pengaduan-verifikasi.xlsx');

        return Excel::download(new AktivitasExport($id), 'aktivitas-penanganan.xlsx');

	}
}
