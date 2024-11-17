<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Models\Isu;
use Illuminate\Support\Facades\Mail;
// use App\Mail\SendEmail;
use App\Mail\BanEmail;
use Illuminate\Support\Facades\DB;
use App\Exports\IsuMasukExport;
use App\Exports\IsuBanExport;
use Maatwebsite\Excel\Facades\Excel;

class IsuController extends Controller
{
    protected $status = null;
    protected $error = null;
    protected $data = null;

    public function index()
    {

        return Isu::where('status', null)->when(request('search'), function($query) {
            $query->where('nama', 'like', '%'. request('search'). '%');
        })->paginate(5);
    }

    public function indexuser()
    {

        

        $posts = Isu::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $posts  
        ], 200);
    }

    public function indexBan()
    {

        return Isu::where('status', "Tidak Diverifikasi")->when(request('search'), function($query) {
            $query->where('nama', 'like', '%'. request('search'). '%');
        })->paginate(5);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'pihak_terduga' => 'required',
            'masalah' => 'required',
            'penyelesaian' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:15000',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                'error' => $validator->errors()
                ], 401);
        }

        // //upload image
        // $image = $request->file('foto');
        // $image->storeAs('public/isu', $image->hashName());


        // //save to database
        // $post = Isu::create([
        //     'nama'      => $request->nama,
        //     'email'     => $request->email,
        //     'nohp'      => $request->nohp,
        //     'pihak_terduga' => $request->pihak_terduga,
        //     'masalah' => $request->masalah,
        //     'penyelesaian' => $request->penyelesaian,
        //     'foto' => $image->hashName(),
        //     // 'status' => $request->status
        // ]);

        // //success save to database
        // if($post) {

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Post Created',
        //         'data'    => $post  
        //     ], 201);

        // } 

        // //failed save to database
        // return response()->json([
        //     'success' => false,
        //     'message' => 'Post Failed to Save',
        // ], 409);

        $document = new Isu();
        $document->nama = $request->nama;
        $document->email = $request->email;
        $document->nohp = $request->nohp;
        $document->pihak_terduga = $request->pihak_terduga;
        $document->masalah = $request->masalah;
        $document->penyelesaian = $request->penyelesaian;
        $document->status = $request->status;

        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('isu'), $file_name);
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


    public function show($id)
    {
        //
        try {
            if ($id) {
                $isu = Isu::where('id', $id)->first();
            } else {
                $isu = Isu::get();
            }
            $this->data = $isu;
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
    
    public function countData(){
        $count = Isu::where('status', null)->count();
        return response()->json([
            "status" => true,
            "data" => $count
        ]);
    }

    public function destroy($id)
    {
        //find by ID
        $status = Isu::findOrfail($id);

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

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'pihak_terduga' => 'required',
            'masalah' => 'required',
            'penyelesaian' => 'required',
            // 'foto' => 'required|mimes:jpg,png,jpeg|max:15000',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all()[0];
            return response()->json([
                'status' => 'failed',
                'message' => $error,
                'data' => []
            ]);
        }
        $isu = Isu::find($id);
        $isu->nama = $request->nama;
        $isu->email = $request->email;
        $isu->nohp = $request->nohp;
        $isu->pihak_terduga = $request->pihak_terduga;
        $isu->masalah = $request->masalah;
        $isu->penyelesaian = $request->penyelesaian;
        $isu->status = $request->status;
        // if ($request->foto && $request->foto->isValid()) {
        //     $file_name = $request->foto->getClientOriginalName();
        //     $request->foto->move(public_path('isu$isu'), $file_name);
        //     $path = $file_name;
        //     $isu->foto = $path;
        // }
        $isu->update();
        return response()->json([
            'status' => 'success',
            'data' => $isu,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function updateBan(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'pihak_terduga' => 'required',
            'masalah' => 'required',
            'penyelesaian' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all()[0];
            return response()->json([
                'status' => 'failed',
                'message' => $error,
                'data' => []
            ]);
        }
        $isu = Isu::find($id);
        $isu->nama = $request->nama;
        $isu->email = $request->email;
        $isu->nohp = $request->nohp;
        $isu->pihak_terduga = $request->pihak_terduga;
        $isu->masalah = $request->masalah;
        $isu->penyelesaian = $request->penyelesaian;
        $isu->status = "Tidak Diverifikasi";
        $isu->update();

        $masalah = $isu->masalah;
        $pelapor = $isu->nama;
        // $kode = "Mohon maaf isu pengaduan yang anda kirimkan tidak dapat diverifikasi karena tidak valid.";
        $tujuan =  $isu->email;
        Mail::to($tujuan)->send(New BanEmail($masalah, $pelapor));

        return response()->json([
            'status' => 'success',
            'data' => $isu,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function exportBan(Request $request)
	{
        $year = $request->year;
        $status = "Tidak Diverifikasi";
        // return (new Verifikasi)->download('coba.xlsx');
        return (new IsuBanExport($year, $status))->download('pengaduan-ban.xlsx');

	}

    public function export(Request $request)
	{
        $year = $request->year;
        $status = null;
        // return (new Verifikasi)->download('coba.xlsx');
        return (new IsuMasukExport($year, $status))->download('pengaduan-masuk.xlsx');

	}

}
