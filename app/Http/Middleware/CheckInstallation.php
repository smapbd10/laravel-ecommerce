<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class CheckInstallation
{
    public function handle(Request $request, Closure $next)
    {
        // Skip check for install routes
        if ($request->is('install*')) {
            return $next($request);
        }

        // Check if installation is completed
        if (!Schema::hasTable('settings')) {
            return redirect('/install');
        }

        $installed = Setting::where('key', 'installation_completed')
            ->where('value', true)
            ->exists();

        if (!$installed) {
            return redirect('/install');
        }

        return $next($request);
    }
}
