<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Isu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use DB;
use Carbon\Carbon;
use App\Exports\Verifikasi;
use Maatwebsite\Excel\Facades\Excel;

class PengaduanController extends Controller
{
    protected $status = null;
    protected $error = null;
    protected $data = null;

     // MENAMPILKAN DATA
     public function index()
     {
        return Pengaduan::when(request('search'), function($query) {
            $query->where('kode_lacak', 'like', '%'. request('search'). '%')
            ->orWhere('nama', 'like', '%'. request('search'). '%');
        })->with('get_isu')->paginate(5);

     }

    // MENYIMPAN DATA
    public function store(Request $request)  
    {      
      $data = new Pengaduan();  
      $date = Carbon::now()->toDateString();
      $data ->kode_lacak = $this->generateUniqueCode();
      $data->id_isu = $request->id_isu;  
      $data->nama = $request->nama;  
      $data->masalah = $request->masalah;  
      $data->email = $request->email;  
      $data->tanggal_mulai = $request->tanggal_mulai = $date; 
      
      $data->save();  
      $success['name'] =  $data;
      
    
      $kode = $data ->kode_lacak;
      $pelapor = $data->nama;
      $masalah = $data->masalah;
      $tujuan =  $data->email;
      Mail::to($tujuan)->send(New SendEmail($kode, $pelapor, $masalah));

      return response()->json([
        'success' => true,
        'message' => 'List Data',
        'data'    => $success  
        ], 200);
    }  

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Pengaduan::where("kode_lacak", "=", $code)->first());
  
        return $code;
    }

    public function destroy($id)
    {
        //find by ID
        $pengaduan = Pengaduan::findOrfail($id);

            if($pengaduan) {

                //delete
                $pengaduan->delete();

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
    
     // MENAMPILKAN DATA SESUAI ID
     public function show($id)
     {
         //find by ID
         $pengaduan = Pengaduan::with('get_isu')->findOrfail($id);
 
         //make response JSON
         return response()->json([
             'success' => true,
             'message' => 'Detail Data',
             'data'    => $pengaduan 
         ], 200);
 
     }

    public function countData(){
        $count = Pengaduan::count();
        return response()->json([
            "status" => true,
            "data" => $count
        ]);
    }
    
    public function update(Request $request, Pengaduan $pengaduan, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'tanggal_selesai'   => 'required'
        ]);
        
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        //find by ID
        $pengaduan = Pengaduan::findOrfail($id);

            if($pengaduan) {

                //update
                $pengaduan->update([
                    'tanggal_selesai'     => $request->tanggal_selesai
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Data Update',
                    'data'    => $pengaduan  
                ], 200);

            }

            //data not found
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);

    }

    public function search(Request $request){
        $search = $request->get('q');
        return Pengaduan::where('kode_lacak', 'like', '%'.$search.'%')
            ->with('get_isu')->get();  
    }

    public function export(Request $request)
	{
        $year = $request->year;
       

        // return Excel::download(new Verifikasi($transaction), 'pengaduan-verifikasi.xlsx');

        return Excel::download(new Verifikasi($year), 'pengaduan-verifikasi.xlsx');

	}
}
