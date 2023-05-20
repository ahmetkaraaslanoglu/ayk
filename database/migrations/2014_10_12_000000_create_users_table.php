<?php

use App\Enums\Role;
use App\Models\Lesson;
use App\Models\School;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lesson::class)->nullable()->default(null)->references('id')->on('lessons');
            $table->foreignIdFor(School::class)->nullable()->default(null)->references('id')->on('schools');
            $table->enum('role', array_map(fn (Role $role) => $role->value, Role::cases()))->default(Role::Guest->value);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo_url')->nullable()->default(null);
            $table->string('token');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
