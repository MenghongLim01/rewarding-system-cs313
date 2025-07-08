<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('redemption_histories', function (Blueprint $table) {
            $table->id('his_id');
            $table->unsignedBigInteger('trans_id');
            $table->string('status');
            $table->integer('point_spent');
            $table->string('changed_by');
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('redemption_histories');
    }
};
