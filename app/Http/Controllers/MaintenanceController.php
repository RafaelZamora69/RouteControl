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
            'amount' => $request['amount'],
            'url' => 'http://127.0.0.1:8000/maintenances/' . (DB::table('maintenances')->max('id') + 1)
        ]);
        return redirect()->route('maintenances.calendar');
    }

    public function update(Request $request){
        $conditions = [
            'createdAt' => 'required',
            'report' => 'required'
        ];
        $messages = [
            'createdAt' => ':attribute field is required',
            'report' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        if($request->vehicleId != null){
            $vehicleId = $this->getVehicleId($request['vehicleId']);
            DB::table('maintenances')->where('id',$request->id)->update([
                'vehicleId' => $vehicleId
            ]);
        }
        DB::table('maintenances')->where('id',$request->id)->update([
            'report' => $request['report'],
            'createdAt' => $request['createdAt'],
            'finishedAt' => $request['finishedAt'],
            'amount' => $request['amount']
        ]);
        return redirect()->route('maintenances.index');
    }

    public function index(){
        $maintenances = DB::table('mantenimientos')->get();
        return view('maintenances.index', compact('maintenances'));
    }

    public function show($id){
        $maintenance = DB::table('maintenances')->where('id','=',$id)->get();
        return view('maintenances.show', compact('maintenance'));
    }

    public function calendar(){
        return view('maintenances.calendar');
    }

    public function delete($id){
        DB::table('maintenances')->where('id','=',$id)->delete();
        return redirect()->route('maintenances.index');
    }

    public function edit($id){
        $maintenance = DB::table('maintenances')->where('id','=',$id)->get();
        $labels = DB::table('vehicles')->select('label')->get();
        return view('maintenances.edit', compact('maintenance','labels'));
    }

    public function getMaintenances(){
        return json_encode($maintenances = DB::table('maintenances')->get());
    }

    public function getRoutes(){
        return json_encode($maintenances = DB::table('routes')->get());
    }

    //private functions
    private function getVehicleId($label){
        return DB::table('vehicles')->select('id')->where('label','=',$label)->first();
    }
}
