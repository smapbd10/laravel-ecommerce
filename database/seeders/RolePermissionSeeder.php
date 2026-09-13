<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super_admin',
                'description' => 'Full system access',
                'is_system' => true,
                'priority' => 100,
            ],
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Administrator access',
                'is_system' => true,
                'priority' => 90,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Manager access',
                'is_system' => true,
                'priority' => 70,
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Content editor',
                'is_system' => true,
                'priority' => 50,
            ],
            [
                'name' => 'Shop Manager',
                'slug' => 'shop_manager',
                'description' => 'Shop management',
                'is_system' => true,
                'priority' => 60,
            ],
            [
                'name' => 'Product Manager',
                'slug' => 'product_manager',
                'description' => 'Product management',
                'is_system' => true,
                'priority' => 55,
            ],
            [
                'name' => 'Customer Support',
                'slug' => 'customer_support',
                'description' => 'Customer support access',
                'is_system' => true,
                'priority' => 40,
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }

        // Create Permissions
        $modules = [
            'dashboard' => [
                ['name' => 'View Dashboard', 'slug' => 'view_dashboard'],
            ],
            'users' => [
                ['name' => 'View Users', 'slug' => 'view_users'],
                ['name' => 'Create User', 'slug' => 'create_user'],
                ['name' => 'Edit User', 'slug' => 'edit_user'],
                ['name' => 'Delete User', 'slug' => 'delete_user'],
            ],
            'roles' => [
                ['name' => 'View Roles', 'slug' => 'view_roles'],
                ['name' => 'Create Role', 'slug' => 'create_role'],
                ['name' => 'Edit Role', 'slug' => 'edit_role'],
                ['name' => 'Delete Role', 'slug' => 'delete_role'],
            ],
            'permissions' => [
                ['name' => 'View Permissions', 'slug' => 'view_permissions'],
                ['name' => 'Manage Permissions', 'slug' => 'manage_permissions'],
            ],
            'products' => [
                ['name' => 'View Products', 'slug' => 'view_products'],
                ['name' => 'Create Product', 'slug' => 'create_product'],
                ['name' => 'Edit Product', 'slug' => 'edit_product'],
                ['name' => 'Delete Product', 'slug' => 'delete_product'],
            ],
            'categories' => [
                ['name' => 'View Categories', 'slug' => 'view_categories'],
                ['name' => 'Create Category', 'slug' => 'create_category'],
                ['name' => 'Edit Category', 'slug' => 'edit_category'],
                ['name' => 'Delete Category', 'slug' => 'delete_category'],
            ],
            'brands' => [
                ['name' => 'View Brands', 'slug' => 'view_brands'],
                ['name' => 'Create Brand', 'slug' => 'create_brand'],
                ['name' => 'Edit Brand', 'slug' => 'edit_brand'],
                ['name' => 'Delete Brand', 'slug' => 'delete_brand'],
            ],
            'orders' => [
                ['name' => 'View Orders', 'slug' => 'view_orders'],
                ['name' => 'Edit Order', 'slug' => 'edit_order'],
                ['name' => 'Delete Order', 'slug' => 'delete_order'],
            ],
            'customers' => [
                ['name' => 'View Customers', 'slug' => 'view_customers'],
                ['name' => 'Edit Customer', 'slug' => 'edit_customer'],
                ['name' => 'Delete Customer', 'slug' => 'delete_customer'],
            ],
            'coupons' => [
                ['name' => 'View Coupons', 'slug' => 'view_coupons'],
                ['name' => 'Create Coupon', 'slug' => 'create_coupon'],
                ['name' => 'Edit Coupon', 'slug' => 'edit_coupon'],
                ['name' => 'Delete Coupon', 'slug' => 'delete_coupon'],
            ],
            'settings' => [
                ['name' => 'View Settings', 'slug' => 'view_settings'],
                ['name' => 'Edit Settings', 'slug' => 'edit_settings'],
            ],
            'blog' => [
                ['name' => 'View Blog', 'slug' => 'view_blog'],
                ['name' => 'Create Blog Post', 'slug' => 'create_blog_post'],
                ['name' => 'Edit Blog Post', 'slug' => 'edit_blog_post'],
                ['name' => 'Delete Blog Post', 'slug' => 'delete_blog_post'],
            ],
            'media' => [
                ['name' => 'View Media', 'slug' => 'view_media'],
                ['name' => 'Upload Media', 'slug' => 'upload_media'],
                ['name' => 'Delete Media', 'slug' => 'delete_media'],
            ],
        ];

        foreach ($modules as $module => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(
                    ['slug' => $permission['slug']],
                    array_merge($permission, ['module' => $module])
                );
            }
        }

        // Assign permissions to roles
        $superAdmin = Role::where('slug', 'super_admin')->first();
        $admin = Role::where('slug', 'administrator')->first();
        $manager = Role::where('slug', 'manager')->first();
        $editor = Role::where('slug', 'editor')->first();
        $productManager = Role::where('slug', 'product_manager')->first();

        if ($superAdmin) {
            // Super admin gets all permissions
            $superAdmin->permissions()->sync(Permission::pluck('id'));
        }

        if ($productManager) {
            // Product manager gets product, category, brand permissions
            $productPerms = Permission::whereIn('module', ['products', 'categories', 'brands'])
                ->pluck('id');
            $productManager->permissions()->sync($productPerms);
        }

        if ($editor) {
            // Editor gets blog and media permissions
            $editorPerms = Permission::whereIn('module', ['blog', 'media'])
                ->pluck('id');
            $editor->permissions()->sync($editorPerms);
        }
    }
}
