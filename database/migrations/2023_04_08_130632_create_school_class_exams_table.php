<?php

use App\Models\Exam;
use App\Models\SchoolClass;
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
        Schema::create('school_class_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SchoolClass::class)->references('id')->on('school_classes');
            $table->foreignIdFor(Exam::class)->references('id')->on('exams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_class_exams');
    }
};
