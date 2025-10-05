<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('permission_name')->unique();
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id'); // khóa ngoại
            $table->unsignedBigInteger('permission_id'); // khóa ngoại
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('sdt')->nullable();
            $table->string('address')->nullable();
            $table->boolean('sex')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('role_id'); // khóa ngoại
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('web_users');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};