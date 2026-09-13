<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Password;

class InstallController extends Controller
{
    public function index()
    {
        if ($this->isInstalled()) {
            return redirect('/admin');
        }

        return view('install.index');
    }

    public function step1()
    {
        if ($this->isInstalled()) {
            return redirect('/admin');
        }

        $requirements = $this->checkSystemRequirements();

        return view('install.step1', compact('requirements'));
    }

    public function step2()
    {
        if ($this->isInstalled()) {
            return redirect('/admin');
        }

        return view('install.step2');
    }

    public function testDatabase(Request $request)
    {
        try {
            $validated = $request->validate([
                'db_host' => 'required|string',
                'db_port' => 'required|integer',
                'db_database' => 'required|string',
                'db_username' => 'required|string',
                'db_password' => 'nullable|string',
            ]);

            $connection = new \PDO(
                "mysql:host={$validated['db_host']}:{$validated['db_port']}",
                $validated['db_username'],
                $validated['db_password']
            );

            return response()->json(['success' => true, 'message' => 'Database connection successful']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function step3()
    {
        if ($this->isInstalled()) {
            return redirect('/admin');
        }

        return view('install.step3');
    }

    public function step4()
    {
        if ($this->isInstalled()) {
            return redirect('/admin');
        }

        return view('install.step4');
    }

    public function process(Request $request)
    {
        if ($this->isInstalled()) {
            return response()->json(['success' => false, 'message' => 'System already installed'], 400);
        }

        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
            'db_host' => 'required|string',
            'db_port' => 'required|integer',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users',
            'admin_password' => ['required', Password::min(8)],
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email',
            'business_phone' => 'required|string',
            'country' => 'required|string',
            'currency' => 'required|string',
            'timezone' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Update environment file
            $this->updateEnvFile($validated);

            // Run migrations
            Artisan::call('migrate', ['--force' => true]);

            // Run seeders
            Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\RolePermissionSeeder', '--force' => true]);
            Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SettingsSeeder', '--force' => true]);

            // Create super admin
            $this->createSuperAdmin($validated);

            // Mark installation as completed
            Setting::set('installation_completed', true, 'system', 'boolean');
            Setting::set('app_name', $validated['app_name'], 'general');
            Setting::set('app_url', $validated['app_url'], 'general');
            Setting::set('business_name', $validated['business_name'], 'store');
            Setting::set('business_email', $validated['business_email'], 'store');
            Setting::set('business_phone', $validated['business_phone'], 'store');
            Setting::set('country', $validated['country'], 'store');
            Setting::set('currency', $validated['currency'], 'store');
            Setting::set('timezone', $validated['timezone'], 'store');

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Installation completed successfully', 'redirect' => '/admin']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    protected function isInstalled(): bool
    {
        if (!Schema::hasTable('settings')) {
            return false;
        }

        return Setting::where('key', 'installation_completed')->exists();
    }

    protected function checkSystemRequirements(): array
    {
        $requirements = [
            'php_version' => [
                'name' => 'PHP Version',
                'required' => '8.1',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.1', '>='),
            ],
            'pdo' => [
                'name' => 'PDO Extension',
                'status' => extension_loaded('pdo'),
            ],
            'openssl' => [
                'name' => 'OpenSSL Extension',
                'status' => extension_loaded('openssl'),
            ],
            'mbstring' => [
                'name' => 'Mbstring Extension',
                'status' => extension_loaded('mbstring'),
            ],
            'tokenizer' => [
                'name' => 'Tokenizer Extension',
                'status' => extension_loaded('tokenizer'),
            ],
            'xml' => [
                'name' => 'XML Extension',
                'status' => extension_loaded('xml'),
            ],
            'ctype' => [
                'name' => 'Ctype Extension',
                'status' => extension_loaded('ctype'),
            ],
            'json' => [
                'name' => 'JSON Extension',
                'status' => extension_loaded('json'),
            ],
            'bcmath' => [
                'name' => 'BCMath Extension',
                'status' => extension_loaded('bcmath'),
            ],
            'fileinfo' => [
                'name' => 'Fileinfo Extension',
                'status' => extension_loaded('fileinfo'),
            ],
            'gd' => [
                'name' => 'GD Extension',
                'status' => extension_loaded('gd'),
            ],
            'curl' => [
                'name' => 'cURL Extension',
                'status' => extension_loaded('curl'),
            ],
            'storage_writable' => [
                'name' => 'Storage Directory Writable',
                'status' => is_writable(storage_path()),
            ],
            'bootstrap_writable' => [
                'name' => 'Bootstrap Directory Writable',
                'status' => is_writable(base_path('bootstrap')),
            ],
        ];

        return $requirements;
    }

    protected function updateEnvFile(array $data): void
    {
        $envPath = base_path('.env');
        $content = file_get_contents($envPath);

        $content = preg_replace('/APP_NAME=.*/i', 'APP_NAME="' . $data['app_name'] . '"', $content);
        $content = preg_replace('/APP_URL=.*/i', 'APP_URL=' . $data['app_url'], $content);
        $content = preg_replace('/DB_HOST=.*/i', 'DB_HOST=' . $data['db_host'], $content);
        $content = preg_replace('/DB_PORT=.*/i', 'DB_PORT=' . $data['db_port'], $content);
        $content = preg_replace('/DB_DATABASE=.*/i', 'DB_DATABASE=' . $data['db_database'], $content);
        $content = preg_replace('/DB_USERNAME=.*/i', 'DB_USERNAME=' . $data['db_username'], $content);
        $content = preg_replace('/DB_PASSWORD=.*/i', 'DB_PASSWORD=' . $data['db_password'], $content);

        file_put_contents($envPath, $content);
    }

    protected function createSuperAdmin(array $data): void
    {
        $admin = User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => bcrypt($data['admin_password']),
            'type' => 'admin',
            'active' => true,
            'email_verified_at' => now(),
        ]);

        $superAdminRole = Role::where('slug', 'super_admin')->first();
        if ($superAdminRole) {
            $admin->roles()->attach($superAdminRole->id);
        }
    }
}
