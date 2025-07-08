<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('reward_id')->nullable();
            $table->string('admin_email')->unique();
            $table->string('admin_pw');
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
