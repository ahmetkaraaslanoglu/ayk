<?php

use App\Enums\AbsenceReason;
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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'owner_id'); // teacher
            $table->foreignIdFor(User::class, 'target_id'); // student
            $table->enum('reason', array_map(fn (AbsenceReason $reason) => $reason->value, AbsenceReason::cases()))->nullable()->default(AbsenceReason::Other->value);
            $table->timestamp('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
