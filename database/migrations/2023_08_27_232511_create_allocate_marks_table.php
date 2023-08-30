<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('allocate_marks', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50)->nullable();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('class_test_one', 20)->nullable();
            $table->string('class_test_two', 20)->nullable();
            $table->string('mid_term', 20)->nullable();
            $table->string('assessment', 20)->nullable();
            $table->string('attendance', 20)->nullable();
            $table->string('final_exam', 20)->nullable();

            
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('the_sections');
            
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('department_sessions');
            
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('enrollment_id');
            $table->foreign('enrollment_id')->references('id')->on('enrollments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocate_marks');
    }
};