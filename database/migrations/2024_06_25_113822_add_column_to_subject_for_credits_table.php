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
        Schema::table('subject_for_credits', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tor_id')->nullable();
            $table->foreign('tor_id')->references('id')->on('tors')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_for_credits', function (Blueprint $table) {
            //
            //
            $table->dropForeign(['tor_id']);

            // Drop the chairperson_id column
            $table->dropColumn('tor_id');
        });
    }
};
