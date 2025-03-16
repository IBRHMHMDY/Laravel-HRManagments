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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->date('birth_date');
            $table->date('join_date');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->enum('salary_type', ['شهري', 'حسب الساعات']);
            $table->decimal('fixed_salary', 10, 2)->default(0);
            $table->decimal('hourly_rate', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
