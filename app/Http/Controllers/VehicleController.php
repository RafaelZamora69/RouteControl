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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hola je";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        //validación wip
        $conditions = [
            'label' => 'required',
            'brand' => 'required',
            'titular' => 'required',
            'model' => 'required',
            'driverId' => 'required'
        ];
        $messages = [
            'label' => ':attribute field is required',
            'brand' => ':attribute field is required',
            'titular' => ':attribute field is required',
            'model' => ':attribute field is required',
            'driverId' => ':attribute field is required'
        ];
        $this->validate($request,$conditions,$messages);
        $driverID = $this->getDriverId($request['driverId']);
        $rutaImagen = $request->file('image')->store('vehicles','public');
        $img = Image::make($request->file('image')->getRealPath())->fit(500,500);
        $img->save();
        DB::table('vehicles')->insert([
            'label' => $request['label'],
            'brand' => $request['brand'],
            'titular' => $request['titular'],
            'driverId' => $driverID,
            'date' => $request['date'],
            'image' => $rutaImagen,
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
        return redirect()->route('main');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
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
