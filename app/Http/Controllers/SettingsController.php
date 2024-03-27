<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    //

    public function titles() {
        if(!auth()->user()->hasPermissionTo('settings-view')) {
            abort('403');
        }
        $settings = Setting::where('type', 'text')->get();
        return view('settings.titles', compact("settings"));
    }

    public function images($id) {
        if(!auth()->user()->hasPermissionTo('settings-view')) {
            abort('403');
        }
        $settings = Setting::where('type', 'image')->get();
        $setting = Setting::where('id', $id)->first();
        if($id == 1) {
            $setting = Setting::where('type', 'image')->first();
        }
        
        // return $settings;
        return view('settings.assets', compact("settings",'setting'));
    }

    public function destroy($id) {
        if(!auth()->user()->hasPermissionTo('settings-delete')) {
            abort('403');
        }
        $setting = Setting::findOrFail($id);
        
        
        
        // Delete the category
        $setting->delete();
        
        // Redirect back with success message
        return back()->with('success', 'Settings item deleted successfully.');
    }

    public function store(Request $request) {
        if(!auth()->user()->hasPermissionTo('settings-view')) {
            abort('403');
        }
        return "true";
    }

    public function updateAsset(Request $request, $id) {
        $setting = Setting::find($id);
        $setting->value = $request->value;
        $setting->save();
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    
    public function updateTitle(Request $request)
    {
        if(!auth()->user()->hasPermissionTo('settings-view')) {
            abort('403');
        }
        foreach ($request->all() as $slug => $value) {
            // Update each setting in the database
            Setting::where('slug', $slug)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }


}
