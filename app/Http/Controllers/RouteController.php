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
            'streets' => 'required',
            'created_at' => 'required'
        ];
        $messages = [
            'vehicleId' => ':attribute field is required',
            'created_at' => ':attribute field is required',
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
            'streets' => (string)$request['streets'],
            'created_at' => $request['created_at'],
            'url' => 'http://127.0.0.1:8000/routes/' . (DB::table('routes')->max('id') + 1)
        ]);
        return redirect()->route('maintenances.calendar');
    }

    public function index(){
        $rutas = DB::table('rutas')->get();
        return view('routes.index', compact('rutas'));
    }

    public function show($id){
        $route = DB::table('routes')->where('id','=',$id)->get();
        return view('routes.show', compact('route'));
    }

    public function edit($id){
        $route = DB::table('routes')->where('id','=',$id)->get();
        $labels = DB::table('vehicles')->select('label')->get();
        return view('routes.edit',compact('route','labels'));
    }

    public function update(Request $request){
        $conditions = [
            'colony' => 'required',
            'time' => 'required',
            'streets' => 'required'
        ];
        $messages = [
            'colony' => ':attribute field is required',
            'time' => ':attribute field is required',
            'streets' => ':attribute field is required'
        ];
        $this->validate($request, $conditions, $messages);
        if($request['vehicleId'] != null){
            $idVehicle = $this->getVehicleId($request['vehicleId']);
            DB::table('routes')->where('id','=',$request->id)->update([
                'vehicleId' => $idVehicle->id
            ]);
        }
        DB::table('routes')->where('id','=',$request->id)->update([
            'colony' => $request['colony'],
            'time' => $request['time'],
            'streets' => (string)$request['streets']
        ]);
        return redirect()->route('routes.index');
    }

    public function delete($id){
        DB::table('routes')->where('id','=',$id)->delete();
        return redirect()->route('routes.index');
    }

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
