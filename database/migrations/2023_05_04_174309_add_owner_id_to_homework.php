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
        Schema::table('homework', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Teacher::class,'owner_id')->nullable()->default(null)->after('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homework', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }
};
