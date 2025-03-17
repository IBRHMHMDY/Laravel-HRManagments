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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->onDelete('set null')->after('id');
        });

        Schema::table('shift_attendance', function (Blueprint $table) {
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->onDelete('set null')->after('id');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
