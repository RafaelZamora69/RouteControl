<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RouteController extends Controller
{
    public function create() {
        $labels = DB::table('vehicles')->select('label')->get();
        return view('routes.register', compact('labels'));
    }

    public function store(Request $request) {
        $conditions = [
            'vehicleId' => 'required',
            'colony' => 'required',
            'time' => 'required',
            'streets' => 'required'
        ];
        $messages = [
            'vehicleId' => ':attribute field is required',
            'colony' => ':attribute field is required',
            'time' => ':attribute field is required',
            'streets' => ':attribute field is required'
        ];
        $this->validate($request, $conditions, $messages);
        $idVehicle = $this->getVehicleId($request['vehicleId']);
        DB::table('routes')->insert([
            'vehicleId' => $idVehicle->id,
            'colony' => $request['colony'],
            'time' => $request['time'],
            'streets' => (string)$request['streets']
        ]);
        return redirect()->route('main');
    }

    public function index(){
        $rutas = DB::table('rutas')->get();
        return view('routes.index', compact('rutas'));
    }

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
