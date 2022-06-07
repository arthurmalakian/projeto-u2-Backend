<?php

namespace App\Http\Controllers\API\V1\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Devices\StoreRequest;
use App\Http\Requests\Devices\UpdateRequest;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $devices = Device::where('user_id',Auth::user()->id)->get();
            return response($devices,200);
        }catch(\Exception $exception){
            return response([
                'error' => $exception
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try{
            $deviceData = $request->only('name','type','red','green','blue','brightness');
            $deviceData['user_id'] = Auth::user()->id;
            $device = Device::create($deviceData);
            return response([
                'device' => $device
            ],201);
        }catch(\Exception $exception){
            return response([
                'error' => $exception
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $device = Device::findOrFail($id);
            return response([
                'device' => $device
            ],200);
        }catch(\Exception $exception){
            return response([
                'error' => $exception
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $newDeviceData = $request->only('name','type','red','green','blue','brightness');
            $device = Device::findOrFail($id);
            $device->update($newDeviceData);
            return response([
                'device' => $device
            ],200);
        }catch(\Exception $exception){
            return response([
                'error' => $exception
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $device = Device::findOrFail($id);
            $device->delete();
            return response([
                'message' => 'Dispositivo deletado.'
            ],200);
        }catch(\Exception $exception){
            return response([
                'error' => $exception
            ],500);
        }
    }
}
