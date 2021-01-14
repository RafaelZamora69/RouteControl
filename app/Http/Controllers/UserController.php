<?php

namespace App\Http\Controllers;

use App\Hierarchy;
use App\Main;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Object_;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display register form
     */
    public function register(){
        $jobs = DB::table('hierarchy')->get();
        $labels = DB::table('vehicles')->select('label')->get();
        return view('auth.register', compact('jobs','labels'));
    }

    /**
     * Store a new user in DB
     * @param Request $request
     */
    public function store(Request $request){
        $conditions = [
            'name' => 'required',
            'surnames' => 'required',
            'sex' => 'required',
            'jobId' => 'required',
            'birthday' => 'required',
            'curp' => 'required',
            'rfc' => 'required',
            'adress' => 'required',
            'street' => 'required',
            'phoneNumber' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'name' => ':attribute field is required',
            'surnames' => ':attribute field is required',
            'jobId' => ':attribute field is required',
            'birthday' => ':attribute field is required',
            'curp' => ':attribute field is required',
            'rfc' => ':attribute field is required',
            'adress' => ':attribute field is required',
            'street' => ':attribute field is required',
            'phoneNumber' => ':attribute field is required',
            'password' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        $idVehicle = new \stdClass();
        $idVehicle->id = null;
        if($request['vehicleLabel'] != null){
            $idVehicle = $this->getVehicleId($request['vehicleLabel']);
        }
        $rutaImagen = '';
        if($request->file('profilePick') != null){
            $rutaImagen = $request->file('profilePick')->store('profile-picks','public');
            $img = Image::make($request->file('profilePick')->getRealPath())->fit(500,500);
            $img->stream();
        }
        DB::table('users')->insert([
            'name' => $request['name'],
            'surnames' => $request['surnames'],
            'sex' => $request['sex'],
            'jobId' => $request['jobId'],
            'birthday' => $request['birthday'],
            'curp' => $request['curp'],
            'rfc' => $request['rfc'],
            'adress' => $request['adress'],
            'street' => $request['street'],
            'phoneNumber' => $request['phoneNumber'],
            'password' => Hash::make($request['password']),
            'civilStatus' => $request['civilStatus'],
            'postalCode' => $request['postalCode'],
            'scholarship' => $request['scholarship'],
            'vehicleId' => $idVehicle->id,
            'profilePick' => $rutaImagen,
        ]);
        return redirect()->route('main');
    }

    public function show(User $user){
        return json_encode($user);
    }

    public function index(){
        $Usuarios = DB::table('usuarios')->get();
        return view('users.index', compact('Usuarios'));
    }

    public function edit($usuario){
        $usuario = DB::table('users')->select('*')->where('id','=',$usuario)->first();
        $jobs = DB::table('hierarchy')->get();
        $labels = DB::table('vehicles')->select('label')->get();
        return view('users.edit', compact('jobs','labels', 'usuario'));
    }

    public function update(Request $request){
        $conditions = [
            'name' => 'required',
            'surnames' => 'required',
            'sex' => 'required',
            'jobId' => 'required',
            'birthday' => 'required',
            'curp' => 'required',
            'rfc' => 'required',
            'adress' => 'required',
            'street' => 'required',
            'phoneNumber' => 'required'
        ];
        $messages = [
            'name' => ':attribute field is required',
            'surnames' => ':attribute field is required',
            'jobId' => ':attribute field is required',
            'birthday' => ':attribute field is required',
            'curp' => ':attribute field is required',
            'rfc' => ':attribute field is required',
            'adress' => ':attribute field is required',
            'street' => ':attribute field is required',
            'phoneNumber' => ':attribute field is required',
            'password' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        DB::table('users')->where('id','=',$request->id)->update([
            'name' => $request['name'],
            'surnames' => $request['surnames'],
            'jobId' => $request['jobId'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
            'civilStatus' => $request['civilStatus'],
            'curp' => $request['curp'],
            'rfc' => $request['rfc'],
            'adress' => $request['adress'],
            'street' => $request['street'],
            'postalCode' => $request['postalCode'],
            'phoneNumber' => $request['phoneNumber'],
            'scholarship' => $request['scholarship'],
        ]);
        if($request['password'] != null){
            DB::table('users')->where('id','=',$request->id)->update([
                'password' => Hash::make($request['password'])
            ]);
        }
        if($request['vehicleLabel'] != null){
            $idVehicle = $this->getVehicleId($request['vehicleLabel']);
            DB::table('users')->where('id','=',$request->id)->update([
                'vehicleId' => $idVehicle
            ]);
        }
        if($request->file('profilePick') != null){
            $rutaImagen = $request->file('profilePick')->store('profile-picks','public');
            $img = Image::make($request->file('profilePick')->getRealPath())->fit(500,500);
            $img->stream();
            DB::table('users')->where('id','=',$request->id)->update([
               'profilePick' => $rutaImagen
            ]);
        }
        return redirect()->route('user.index');
    }

    public function delete(User $user){
        //DB::table('users')->delete($user);
        return json_encode(array('Msg' => 'Eliminado'));
    }

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
