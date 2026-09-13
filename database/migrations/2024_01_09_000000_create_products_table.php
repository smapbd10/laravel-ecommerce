<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->decimal('compare_price', 12, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('low_stock_threshold')->default(10);
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->enum('type', ['simple', 'variable', 'grouped', 'bundle', 'digital'])->default('simple');
            $table->boolean('featured')->default(false);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_digital')->default(false);
            $table->boolean('is_downloadable')->default(false);
            $table->string('warranty')->nullable();
            $table->text('return_policy')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->string('shipping_class')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->integer('view_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['slug', 'sku', 'category_id', 'brand_id', 'status', 'featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
