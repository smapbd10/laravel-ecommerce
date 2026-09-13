<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'app_name', 'value' => 'Gadget50', 'group' => 'general', 'type' => 'string', 'description' => 'Application name'],
            ['key' => 'app_url', 'value' => 'http://localhost', 'group' => 'general', 'type' => 'string', 'description' => 'Application URL'],
            ['key' => 'app_timezone', 'value' => 'UTC', 'group' => 'general', 'type' => 'string', 'description' => 'Application timezone'],
            ['key' => 'app_locale', 'value' => 'en', 'group' => 'general', 'type' => 'string', 'description' => 'Application locale'],

            // Store Settings
            ['key' => 'business_name', 'value' => 'Gadget50', 'group' => 'store', 'type' => 'string', 'description' => 'Business name'],
            ['key' => 'business_email', 'value' => 'contact@gadget50.com', 'group' => 'store', 'type' => 'string', 'description' => 'Business email'],
            ['key' => 'business_phone', 'value' => '+1234567890', 'group' => 'store', 'type' => 'string', 'description' => 'Business phone'],
            ['key' => 'business_address', 'value' => '123 Main St, City, Country', 'group' => 'store', 'type' => 'string', 'description' => 'Business address'],
            ['key' => 'currency', 'value' => 'USD', 'group' => 'store', 'type' => 'string', 'description' => 'Store currency'],
            ['key' => 'currency_symbol', 'value' => '$', 'group' => 'store', 'type' => 'string', 'description' => 'Currency symbol'],
            ['key' => 'country', 'value' => 'US', 'group' => 'store', 'type' => 'string', 'description' => 'Store country'],

            // Branding Settings
            ['key' => 'logo', 'value' => null, 'group' => 'branding', 'type' => 'string', 'description' => 'Store logo'],
            ['key' => 'dark_logo', 'value' => null, 'group' => 'branding', 'type' => 'string', 'description' => 'Dark mode logo'],
            ['key' => 'favicon', 'value' => null, 'group' => 'branding', 'type' => 'string', 'description' => 'Favicon'],
            ['key' => 'og_image', 'value' => null, 'group' => 'branding', 'type' => 'string', 'description' => 'Open Graph image'],
            ['key' => 'copyright_text', 'value' => '© {YEAR} Gadget50. All Rights Reserved.', 'group' => 'branding', 'type' => 'string', 'description' => 'Copyright text'],
            ['key' => 'powered_by_text', 'value' => 'Powered by Gadget50.com', 'group' => 'branding', 'type' => 'string', 'description' => 'Powered by text'],
            ['key' => 'show_powered_by', 'value' => true, 'group' => 'branding', 'type' => 'boolean', 'description' => 'Show powered by text'],

            // Header Settings
            ['key' => 'header_layout', 'value' => 'default', 'group' => 'header', 'type' => 'string', 'description' => 'Header layout'],
            ['key' => 'show_search', 'value' => true, 'group' => 'header', 'type' => 'boolean', 'description' => 'Show search bar'],
            ['key' => 'show_wishlist', 'value' => true, 'group' => 'header', 'type' => 'boolean', 'description' => 'Show wishlist'],
            ['key' => 'show_cart', 'value' => true, 'group' => 'header', 'type' => 'boolean', 'description' => 'Show cart'],

            // Footer Settings
            ['key' => 'footer_columns', 'value' => 4, 'group' => 'footer', 'type' => 'string', 'description' => 'Footer columns'],
            ['key' => 'show_newsletter', 'value' => true, 'group' => 'footer', 'type' => 'boolean', 'description' => 'Show newsletter signup'],
            ['key' => 'show_social_links', 'value' => true, 'group' => 'footer', 'type' => 'boolean', 'description' => 'Show social links'],

            // Theme Settings
            ['key' => 'primary_color', 'value' => '#FF6B6B', 'group' => 'theme', 'type' => 'string', 'description' => 'Primary color'],
            ['key' => 'secondary_color', 'value' => '#4ECDC4', 'group' => 'theme', 'type' => 'string', 'description' => 'Secondary color'],
            ['key' => 'accent_color', 'value' => '#FFE66D', 'group' => 'theme', 'type' => 'string', 'description' => 'Accent color'],
            ['key' => 'dark_mode', 'value' => false, 'group' => 'theme', 'type' => 'boolean', 'description' => 'Dark mode enabled'],

            // Customer Settings
            ['key' => 'enable_registration', 'value' => true, 'group' => 'customers', 'type' => 'boolean', 'description' => 'Enable customer registration'],
            ['key' => 'enable_guest_checkout', 'value' => true, 'group' => 'customers', 'type' => 'boolean', 'description' => 'Enable guest checkout'],
            ['key' => 'email_verification_required', 'value' => false, 'group' => 'customers', 'type' => 'boolean', 'description' => 'Email verification required'],

            // Product Settings
            ['key' => 'enable_reviews', 'value' => true, 'group' => 'products', 'type' => 'boolean', 'description' => 'Enable product reviews'],
            ['key' => 'approve_reviews_manually', 'value' => true, 'group' => 'products', 'type' => 'boolean', 'description' => 'Manually approve reviews'],
            ['key' => 'products_per_page', 'value' => 12, 'group' => 'products', 'type' => 'string', 'description' => 'Products per page'],

            // Order Settings
            ['key' => 'enable_orders', 'value' => true, 'group' => 'orders', 'type' => 'boolean', 'description' => 'Enable orders'],
            ['key' => 'order_status_flow', 'value' => '["pending", "confirmed", "processing", "packed", "shipped", "delivered"]', 'group' => 'orders', 'type' => 'json', 'description' => 'Order status flow'],

            // System Settings
            ['key' => 'maintenance_mode', 'value' => false, 'group' => 'system', 'type' => 'boolean', 'description' => 'Maintenance mode enabled'],
            ['key' => 'installation_completed', 'value' => false, 'group' => 'system', 'type' => 'boolean', 'description' => 'Installation completed'],
            ['key' => 'demo_mode', 'value' => true, 'group' => 'system', 'type' => 'boolean', 'description' => 'Demo mode enabled'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
