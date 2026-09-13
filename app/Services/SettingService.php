<?php

namespace App\Services;

use App\Models\Setting as SettingModel;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public const CACHE_KEY = 'app_settings';
    public const CACHE_TTL = 3600; // 1 hour

    public function get($key, $default = null)
    {
        $settings = $this->all();
        return $settings[$key] ?? $default;
    }

    public function set($key, $value, $group = 'general', $type = 'string')
    {
        SettingModel::set($key, $value, $group, $type);
        $this->flushCache();
        return true;
    }

    public function all()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return SettingModel::pluck('value', 'key')->toArray();
        });
    }

    public function getByGroup($group)
    {
        return SettingModel::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    public function flushCache()
    {
        Cache::forget(self::CACHE_KEY);
    }
}
