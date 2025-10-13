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

        Schema::create('wallet', function (Blueprint $table) {
            $table->string('wallet_number', 9)->primary();
            $table->decimal('wallet_balance', 18, 2)->default(0.00);
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
            $table->string('background_image')->nullable();
            $table->unsignedBigInteger('role_id'); 
            $table->string('wallet_number')->nullable();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('wallet_number')->references('wallet_number')->on('wallet')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            #$table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('payment_history', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_number', 9);
            $table->decimal('amount', 18, 2);
            $table->timestamp('transaction_date')->useCurrent();
            $table->foreign('wallet_number')->references('wallet_number')->on('wallet')->onDelete('cascade');    
            $table->timestamps();        
        });
    }

    public function down(): void {
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('users');
        Schema::dropIfExists('wallet');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('payment_history');
    }
};