<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('rating')->min(1)->max(5);
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->json('images')->nullable();
            $table->boolean('verified_purchase')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['product_id', 'user_id', 'approved']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
