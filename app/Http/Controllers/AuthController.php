<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\TokenRepository;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // GET API
    public function userDashboard()
    {
        
        return User::when(request('search'), function($query) {
            $query->where('name', 'like', '%'. request('search'). '%');
        })->with('get_peran')->paginate(5);
        
    }

    public function adminDashboard()
    {
        // if(request('search')){
        //     return Admin::where('name', 'like', '%'. request('search'). '%') 
        //     ->with('get_peran')->paginate(1);
            
        // }else{
        //     return Admin::with('get_peran')->paginate(1);
        // }
       return Admin::when(request('search'), function($query) {
            $query->where('name', 'like', '%'. request('search'). '%');
        })->with('get_peran')->paginate(5);
    }

    public function currentAdmin(Request $request)
    {
        
        $admin= Admin::with('get_peran')->find($request->user());
        return response()->json($admin, 200);
    }

    public function currentUser(Request $request)
    {
        
        $user= User::with('get_peran')->find($request->user());
        return response()->json([
            'success' => true,
            'message' => 'List Data',
            'data'    => $user
        ], 200);
        // return response()->json($user, 200);
    }

    public function updateProfile(Request $request, $id)
    {
        
        //find by ID
        $user = User::find($id);
        if ($user) {
            
            // $user->nip = $request->nip;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->notelp = $request->notelp;
            $user->alamat = $request->alamat;
            // $user->password = $request->password;
          

            if($request->password != null){
                $user->password = bcrypt($request->password);
            }
            else if($request->password == null){
                $user->password = $user['password'];
            }
            
            else if ($request->foto && $request->foto->isValid()) {
                $file_name = $request->foto->getClientOriginalName();
                $request->foto->move(public_path('dinas'), $file_name);
                $path = $file_name;
                $user->foto = $path;
            }
            else{
                unset($user['foto']);
            }
            $user->update();
            return response()->json([
                'message' => 'Data Pribadi berhasil di updated',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'Old password does not matched',

            ], 400);
        }

    }

    // MENAMPILKAN DATA SESUAI ID
    public function getUserbyid($id)
    {
        //find by ID
        $user = User::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $user 
        ], 200);

    }

    // MENAMPILKAN DATA SESUAI ID
    public function showUser($id)
    {
        //find by ID
        $user = User::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $user 
        ], 200);

    }

    // MENAMPILKAN DATA SESUAI ID
    public function showAdmin($id)
    {
        //find by ID
        $admin = Admin::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $admin 
        ], 200);

    }

    // LOGIN
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('nip', $request->nip)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed!',
            ]);
        }

        $success =  $user;
        $success['token'] =  $user->createToken('MyApp',['user'])->accessToken; 

        return response()->json([
            'success' => true,
            'data' => $success]);

    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed!',
            ]);
        }

            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp',['admin'])->accessToken; 

            return response()->json([
                'success' => true,
                'data' => $success]);

    }
    // TAMBAH 
    public function registerUser(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:15000',
            'id_peran' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $document = new User();
        $document->nip = $request->nip;
        $document->name = $request->name;
        $document->email = $request->email;
        $document->password = bcrypt($request->password);
        $document->id_peran = $request->id_peran;

        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('dinas'), $file_name);
            $path = $file_name;
            $document->foto = $path;
        }

        try {
            $success['token'] =  $document->createToken('nApp')->accessToken;
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

    public function registerAdmin(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:15000',
            'id_peran' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                'error' => $validator->errors()
                ], 401);
        }
        $document = new Admin();
        $document->name = $request->name;
        $document->email = $request->email;
        $document->password = bcrypt($request->password);
        $document->id_peran = $request->id_peran;

        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin'), $file_name);
            $path = $file_name;
            $document->foto = $path;
        }

        try {
            $success['token'] =  $document->createToken('nApp')->accessToken;
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

    // EDIT

    public function editUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:15000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'validation fails',
                'errors' => $validator->errors()
            ], 400);
        }

        $user = User::find($id);

            $user->nip = $request->nip;
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->password = Hash::make($request->password);

            if($request->password != null){
                $user->password = bcrypt($request->password);
            }
            else if($request->password == null){
                $user->password = $user['password'];
            }
            else if ($request->foto && $request->foto->isValid()) {
                $file_name = $request->foto->getClientOriginalName();
                $request->foto->move(public_path('user'), $file_name);
                $path = $file_name;
                $user->foto = $path;
            }
            else {
                unset($user['foto']);
            }
            $user->update();
            return response()->json([
                'message' => 'Data Pribadi berhasil di updated',
                'data' => $user
            ], 200);
    }

    public function editAdmin(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:15000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'validation fails',
                'errors' => $validator->errors()
            ], 400);
        }

        $admin = Admin::find($id);

            $admin->name = $request->name;
            $admin->email = $request->email;
            // $admin->password = Hash::make($request->password);

            if($request->password != null){
                $admin->password = bcrypt($request->password);
            }
            else if($request->password == null){
                $admin->password = $admin['password'];
            }
            else if ($request->foto && $request->foto->isValid()) {
                $file_name = $request->foto->getClientOriginalName();
                $request->foto->move(public_path('admin'), $file_name);
                $path = $file_name;
                $admin->foto = $path;
            }
            else {
                unset($admin['foto']);
            }
            $admin->update();
            return response()->json([
                'message' => 'Data Pribadi berhasil di updated',
                'data' => $admin
            ], 200);
    }

    // HAPUS
    public function destroyUser($id)
    {
        //
        $user = User::where('id', $id);
        $user->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }

    public function destroyAdmin($id)
    {
        //
        $admin = Admin::where('id', $id);
        $admin->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }

}
