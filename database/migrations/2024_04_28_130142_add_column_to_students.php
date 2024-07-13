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
        Schema::table('students', function (Blueprint $table) {
            //
            $table->string('major')->nullable();
            $table->string('last_school')->nullable();
            $table->string('previous_course')->nullable();
            $table->string('period_of_attendance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('major');
            $table->dropColumn('last_school');
            $table->dropColumn('previous_course');
            $table->dropColumn('period_of_attendance');
        });
    }
};
