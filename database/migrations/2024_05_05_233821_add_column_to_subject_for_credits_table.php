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
            $table->integer('recom_app')->default(0);
            $table->integer('approved')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_for_credits', function (Blueprint $table) {
            //
            $table->dropColumn('recom_app');
            $table->dropColumn('approved');
        });
    }
};
