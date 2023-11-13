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
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('password');
            $table->enum('access', ['to_all', 'only_me'])->default('to_all');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id')->nullable();

            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('password_groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
