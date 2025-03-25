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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('shift_id')->nullable()->constrained('shifts')->onDelete();
            $table->date('date');
            $table->integer('late_minutes')->default(0); // دقائق التأخير
            $table->enum('type_late',['half_day','full_day'])->nullable(); // 25 Minute = half day | 45 Minute = full day
            $table->time('check_in')->nullable();
            $table->decimal('hours_works', 4, 2); // ساعات العمل الفعلية
            $table->time('check_out')->nullable();
            $table->integer('overtime_minutes')->default(0); // الساعات الإضافية
            $table->integer('early_leave_minutes')->default(0); // دقائق المغادرة المبكرة
            $table->enum('status', ['present', 'absent', 'on_leave', 'late'])->default('absent');
            $table->enum('leave_type', ['sick', 'annual', 'emergency', 'unpaid'])->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
