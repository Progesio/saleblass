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
        Schema::create('user_wa_poliesters', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('user_id')->unique();
            $table->string('domain_hit')->default('https://caseoptheligaandnewligawkwkkw.progesio.my.id');
            $table->integer('token_limit')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wa_poliesters');
    }
};
