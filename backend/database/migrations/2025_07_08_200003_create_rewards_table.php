<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id('reward_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('reward_name');
            $table->text('reward_desc');
            $table->integer('reward_stock');
            $table->string('reward_image')->nullable(); // Path to the image
            $table->integer('point_required');
            
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
