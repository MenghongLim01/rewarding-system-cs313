<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
           $table->id('order_id'); // Auto-incrementing ID
            $table->foreignId('user_id')->constrained('users'); // Foreign key to users table
            $table->foreignId('company_id')->constrained('companies'); // Foreign key to companies table
            $table->foreignId('staff_id')->constrained('staff'); // Foreign key to staff table
            $table->decimal('total', 10, 2); // Total order price
            $table->integer('points_awarded')->default(0); // Points awarded
            $table->json('order_items'); // Store food items as JSON
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
