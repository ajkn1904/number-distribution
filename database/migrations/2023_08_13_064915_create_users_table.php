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
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('email', 50);
            //it can be existed or not, that's y we are using here nullable()
            $table->string('teacher_id', 30)->nullable();
            $table->string('student_id', 30)->nullable();

            $table->string('password', 100)->nullable();
            
            $table->string('department', 100)->nullable();
            
            $table->string('role', 30);
            $table->boolean('status')->default(false);

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