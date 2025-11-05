<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            // dùng cart_id làm primary key (unsignedBigInteger tự động)
            $table->id('cart_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // tham chiếu users.id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
}
