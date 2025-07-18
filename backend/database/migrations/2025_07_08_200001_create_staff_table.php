<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('staff_name');
            $table->string('staff_email')->unique();
            $table->string('profile_image')->nullable();
            $table->string('staff_pw');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
