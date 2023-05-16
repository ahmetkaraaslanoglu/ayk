<?php

use App\Models\Homework;
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
        Schema::create('school_class_homeworks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SchoolClass::class);
            $table->foreignIdFor(Homework::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_class_homework');
    }
};
