<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(private SettingService $settingService)
    {
        $this->middleware('auth');
        $this->middleware('admin_only');
    }

    public function general()
    {
        $settings = $this->settingService->getByGroup('general');
        return view('admin.settings.general', compact('settings'));
    }

    public function store(Request $request, $group = 'general')
    {
        $validated = $request->validate([
            'app_name' => 'nullable|string|max:255',
            'app_url' => 'nullable|url',
            'app_timezone' => 'nullable|timezone',
            'business_name' => 'nullable|string|max:255',
            'business_email' => 'nullable|email',
            'business_phone' => 'nullable|string',
            'currency' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            $this->settingService->set($key, $value, $group);
        }

        return back()->with('success', 'Settings updated successfully');
    }

    public function branding()
    {
        $settings = $this->settingService->getByGroup('branding');
        return view('admin.settings.branding', compact('settings'));
    }

    public function theme()
    {
        $settings = $this->settingService->getByGroup('theme');
        return view('admin.settings.theme', compact('settings'));
    }

    public function header()
    {
        $settings = $this->settingService->getByGroup('header');
        return view('admin.settings.header', compact('settings'));
    }

    public function footer()
    {
        $settings = $this->settingService->getByGroup('footer');
        return view('admin.settings.footer', compact('settings'));
    }
}
