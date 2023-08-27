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
        Schema::create('the_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section', 50);

            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('department_sessions');
            
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            
            /* $table->string('session', 100); */
            
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('users');
            
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('the_sections');
    }
};