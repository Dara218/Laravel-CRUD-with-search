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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('post_value');
            $table->dateTime('post_date');
            // $table->timestamp('updated_at')->nullable();
            // $table->timestamp('created_at')->nullable();
            $table->timestamps();
        });

        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('post_value');
            $table->string('email')->unique();
            // $table->timestamp('updated_at')->nullable();
            // $table->timestamp('created_at')->nullable();
            $table->timestamps();
        });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
