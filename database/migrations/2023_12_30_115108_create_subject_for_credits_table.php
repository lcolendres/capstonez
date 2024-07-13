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
        Schema::create('subject_for_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('code_id');
            $table->foreign('code_id')->references('id')->on('codes')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('subject_code_to_be_credited');
            $table->string('subject_title_to_be_credited');
            $table->float('grade', 3, 2);
            $table->unsignedInteger('status')->default(1); // 1 - Pending, 2 - Approved, 3 - Reject
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_for_credits');
    }
};
