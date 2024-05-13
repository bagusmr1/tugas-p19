<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Device;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return Data::all();
    }

    public function store(Request $request)
    {
        $data = new Data();
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();

        $device = Device::find($request->device_id);
        if ($device) {
            $device->current_value = $request->data;
            $device->save();
        }

        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function web_show(string $id)
    {
        $device = Device::find($id);
        if (!$device) {
            abort(404, 'Device not found');
        }

        return view('device', [
            "title" => "Device",
            "device" => $device,
            "data" => Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
