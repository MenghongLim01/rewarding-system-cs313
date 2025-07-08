<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('points_transactions', function (Blueprint $table) {
            $table->id('trans_id');
            $table->unsignedBigInteger('red_id')->nullable();
            $table->integer('point_change');
            $table->string('trans_type');
            $table->text('trans_desc')->nullable();
            $table->decimal('dis_value', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('points_transactions');
    }
};
