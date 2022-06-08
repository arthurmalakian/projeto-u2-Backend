<?php

namespace App\Http\Controllers\API\V1\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Devices\StoreRequest;
use App\Http\Requests\Devices\UpdateRequest;

/**
 * @group Dispositivos
 * 
 * Rotas para gerenciamento de dispositivos
 */

class DevicesController extends Controller
{
    /**
     * Todos dispositívos do usuário
     * @authenticated
     * @return JsonResponse
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
     * Criação de dispositívo
     * @queryParam name string required Nome do dispositivo
     * @queryParam type integer required Tipo do dispositivo (1 = ON/OFF, 2 = LED RGB, 3 = DISPOSITIVO DE BRILHO)
     * @queryParam red integer Valor da cor vermelha (Caso seja LED)
     * @queryParam green integer Valor da cor verde (Caso seja LED)
     * @queryParam blue integer Valor da cor azul (Caso seja LED)
     * @queryParam brightness integer Valor da luminosidade (Caso seja DISPOSITIVO DE BRILHO)
     * @authenticated
     * @return JsonResponse
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
     * Dispositivo Individual
     * @authenticated
     * @return JsonResponse
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
     * Edição de dispositívo
     * @queryParam name string required Nome do dispositivo
     * @queryParam type integer required Tipo do dispositivo (1 = ON/OFF, 2 = LED RGB, 3 = DISPOSITIVO DE BRILHO)
     * @queryParam red integer Valor da cor vermelha (Caso seja LED)
     * @queryParam green integer Valor da cor verde (Caso seja LED)
     * @queryParam blue integer Valor da cor azul (Caso seja LED)
     * @queryParam brightness integer Valor da luminosidade (Caso seja DISPOSITIVO DE BRILHO)
     * @authenticated
     * @return JsonResponse
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
     * Exclusão de dispositivo
     * @authenticated
     * @return JsonResponse
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
