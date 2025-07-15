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
        Schema::table('staff', function (Blueprint $table) {
             $table->unsignedBigInteger('company_id')->nullable()->after('staff_id');; // Add company_id column
            $table->foreign('company_id')->references('staff_id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['company_id']); // Drop foreign key
            $table->dropColumn('company_id'); // Drop the column
        });
    }
};
