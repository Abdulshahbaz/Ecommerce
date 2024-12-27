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
        Schema::create('coupans', function (Blueprint $table) {
                        $table->id();
                        $table->string('title');
                        $table->string('coupan_code')->unique();
                        $table->string('value');
                        $table->enum('type',['fixed','percent']);
                        $table->integer('status')->default(0);
                        $table->integer('maxuse')->default(2);
                        $table->string('cart_value');
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupans');
    }
};
