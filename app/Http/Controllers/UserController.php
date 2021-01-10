<?php

namespace App\Http\Controllers;

use App\Hierarchy;
use App\Main;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
        $idVehicle = $this->getVehicleId($request['vehicleLabel']);
        $rutaImagen = $request->file('profilePick')->store('profile-picks','public');
        $img = Image::make($request->file('profilePick')->getRealPath())->fit(500,500);
        $img->save();
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

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
