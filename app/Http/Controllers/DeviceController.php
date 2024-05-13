<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        return Device::all();
    }

    public function store(Request $request)
    {
        $device = new Device;
        $device->name = $request->name;
        $device->min_value = $request->min_value;
        $device->max_value = $request->max_value;
        $device->current_value = $request->current_value;
        $device->save();
        return response()->json([
            "message" => "Device telah ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }
        return $device;
    }

    public function update(Request $request, string $id)
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }

        $device->name = $request->input('name', $device->name);
        $device->min_value = $request->input('min_value', $device->min_value);
        $device->max_value = $request->input('max_value', $device->max_value);
        $device->current_value = $request->input('current_value', $device->current_value);
        $device->save();

        return response()->json([
            "message" => "Device telah diperbarui."
        ], 200);
    }

    public function destroy(string $id)
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }

        $device->delete();

        return response()->json([
            "message" => "Device telah dihapus."
        ], 200);
    }


    public function web_index()
    {
        return view('devices', [
            "title" => "Devices",
            "devices" => Device::all()
        ]);
    }

    public function web_show($id)
    {
        $device = Device::find($id);
        if (!$device) {
            abort(404, 'Device not found');
        }

        return view('device', [
            "title" => "Device",
            "device" => $device
        ]);
    }
}
