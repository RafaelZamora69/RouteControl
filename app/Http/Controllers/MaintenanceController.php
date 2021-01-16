<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller {

    public function create() {
        $labels = DB::table('vehicles')->select('label')->get();
        return view('maintenances.register', compact('labels'));
    }

    public function store(Request $request){
        $conditions = [
            'vehicleId' => 'required',
            'createdAt' => 'required',
            //'partnerId' => 'required',
            'report' => 'required'
        ];
        $messages = [
            'vehicleId' => ':attribute field is required',
            'createdAt' => ':attribute field is required',
            //'partnerId' => ':attribute field is required',
            'report' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        $vehicleId = $this->getVehicleId($request['vehicleId']);
        DB::table('maintenances')->insert([
            'vehicleId' => $vehicleId->id,
            'report' => $request['report'],
            'createdAt' => $request['createdAt'],
            'amount' => $request['amount']
            //'partnerId' => $request['partnerId']
        ]);
        return redirect()->route('maintenances.new');
    }

    public function calendar(){
        return view('maintenances.calendar');
    }

    public function index(){
        $maintenances = DB::table('mantenimientos')->get();
        return view('maintenances.index', compact('maintenances'));
    }

    public function show($id){
        $maintenance = DB::table('maintenances')->where('id','=',$id)->get();
        return view('maintenances.show', compact('maintenance'));
    }

    public function getData(){
        return json_encode($maintenances = DB::table('maintenances')->get());
    }

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
