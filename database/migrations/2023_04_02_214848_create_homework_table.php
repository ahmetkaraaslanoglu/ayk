<?php

use App\Models\School;
use App\Models\User;
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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School::class)->references('id')->on('schools');
            $table->foreignIdFor(User::class)->references('id')->on('users'); // teacher
            $table->string('subject');
            $table->string('photo');
            $table->longText('content');
            $table->string('link');
            $table->timestamp('deadline_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
