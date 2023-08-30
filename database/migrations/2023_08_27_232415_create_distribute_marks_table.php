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
        Schema::create('distribute_marks', function (Blueprint $table) {
          
            $table->id();
            $table->string('class_test_one', 20);
            $table->string('class_test_two', 20);
            $table->string('mid_term', 20);
            $table->string('assessment', 20);
            $table->string('attendance', 20);
            
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('the_sections');
            $table->string('final_exam', 20);
            
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribute_marks');
    }
};