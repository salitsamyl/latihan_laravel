<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSettingController extends Controller
{
    public function index()
    {
        $settings = LandingSetting::orderBy('key')->get();
        return view('admin.landing.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key'    => 'required|string|unique:landing_settings,key',
            'type'   => 'required|string|in:text,textarea,image,json',
            'status' => 'required|in:0,1',
            'value'  => 'nullable', // Untuk non-image
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' // Untuk image
        ]);

        $value = $request->value;

        // Handle file upload untuk type image
        if ($request->type === 'image' && $request->hasFile('image')) {
            $value = $request->file('image')->store('landing', 'public');
        }

        LandingSetting::create([
            'key'    => $request->key,
            'value'  => $value,
            'type'   => $request->type,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.landing.settings.index')
            ->with('success', 'Setting created successfully');
    }

    public function update(Request $request, $id)
    {
        $setting = LandingSetting::findOrFail($id);

        $request->validate([
            'key'    => 'required|string|unique:landing_settings,key,' . $id,
            'type'   => 'required|string|in:text,textarea,image,json',
            'status' => 'required|in:0,1',
            'value'  => 'nullable', // Untuk non-image
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' // Untuk image
        ]);

        // Update basic fields
        $setting->key = $request->key;
        $setting->type = $request->type;
        $setting->status = $request->status;

        // Handle value berdasarkan type
        if ($request->type === 'image') {
            // Jika upload file baru
            if ($request->hasFile('image')) {
                // Hapus file lama jika ada
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }
                // Simpan file baru
                $setting->value = $request->file('image')->store('landing', 'public');
            }
            // Jika tidak upload file baru, biarkan value yang lama
        } else {
            // Untuk type text, textarea, json
            $setting->value = $request->value;
        }

        $setting->save();

        return redirect()
            ->route('admin.landing.settings.index')
            ->with('success', 'Setting updated successfully');
    }
}