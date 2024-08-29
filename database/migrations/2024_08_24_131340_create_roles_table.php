<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Name of the role
            $table->string('description')->nullable(); // Optional description of the role
            $table->timestamps();
        });

        // Create role_user table (pivot table)
        Schema::create('roles_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('roles_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'roles_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
