<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $vehiculos = DB::table('vehicles')->get();
        return view('vehicles.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $conductores = DB::table('users')->select('name',DB::raw("concat(users.name,',',users.surnames)as name"))->where('jobId',2)->get();
        return view('vehicles.register', compact('conductores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conditions = [
            'label' => 'required',
            'brand' => 'required',
            'titular' => 'required',
            'model' => 'required'
        ];
        $messages = [
            'label' => ':attribute field is required',
            'brand' => ':attribute field is required',
            'titular' => ':attribute field is required',
            'model' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        $driverID = new \stdClass();
        $driverID->id = null;
        if($request['driverId'] != null){
            $driverID = $this->getDriverId($request['driverId']);
        }
        $rutaImagen = '';
        if($request->file('image') != null){
            $rutaImagen = $request->file('image')->store('vehicles','public');
            $img = Image::make($request->file('image')->getRealPath())->fit(500,500);
            $img->stream();
        }
        DB::table('vehicles')->insert([
            'label' => $request['label'],
            'brand' => $request['brand'],
            'titular' => $request['titular'],
            'date' => $request['date'],
            'driverId' => $driverID,
            'model' => $request['model'],
            'propulsion' => $request['propulsion'],
            'color' => $request['color'],
            'engine' => $request['engine'],
            'engineId' => $request['engineId'],
            'type' => $request['type'],
            'cabina' => $request['cabina'],
            'rines' => $request['rines'],
            'llantas' => $request['llantas'],
            'image' => $rutaImagen
        ]);
        return redirect()->route('main');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $conditions = [
            'label' => 'required',
            'brand' => 'required',
            'titular' => 'required',
            'model' => 'required'
        ];
        $messages = [
            'label' => ':attribute field is required',
            'brand' => ':attribute field is required',
            'titular' => ':attribute field is required',
            'model' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        DB::table('vehicles')->where('id','=',$request->id)->update([
            'label' => $request['label'],
            'brand' => $request['brand'],
            'titular' => $request['titular'],
            'date' => $request['date'],
            'model' => $request['model'],
            'propulsion' => $request['propulsion'],
            'color' => $request['color'],
            'engine' => $request['engine'],
            'engineId' => $request['engineId'],
            'type' => $request['type'],
            'cabina' => $request['cabina'],
            'rines' => $request['rines'],
            'llantas' => $request['llantas'],
        ]);
        if($request['driverId'] != null){
            $driverId = $this->getDriverId($request['driverId']);
            DB::table('vehicles')->where('id','=',$request->id)->update([
                'driverId' => $driverId
            ]);
        }
        if($request->file('image') != null){
            $rutaImagen = $request->file('image')->store('vehicles','public');
            $img = Image::make($request->file('image')->getRealPath())->fit(500,500);
            $img->stream();
            DB::table('vehicles')->where('id','=',$request->id)->update([
                'image' => $rutaImagen
            ]);
        }
        return redirect()->route('vehicles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($vehicle)
    {
        $vehiculo = DB::table('vehicles')->select('*')->where('id','=',$vehicle)->first();
        $conductores = DB::table('users')->select('name',DB::raw("concat(users.name,',',users.surnames)as name"))->where('jobId',2)->get();
        return view('vehicles.edit', compact('vehiculo','conductores'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return json_encode($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    private function getDriverId($fullName){
        $name = explode(',', $fullName);
        $user = DB::table('users')->get()->where('name','=',$name[0])->where('surnames','=',$name[1])->first();
        return $user->id;
    }
}
