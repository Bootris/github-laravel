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
        Schema::create('popularity_scores', function (Blueprint $table) {
           
            $table->string('term');
            $table->integer('positive_results')->default(0);
            $table->integer('negative_results')->default(0);
            $table->integer('total_results')->default(0);
            $table->float('score')->default(0);
            $table->string('provider');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('popularity_scores', function (Blueprint $table) {
            $table->dropColumn(['term', 'positive_results', 'negative_results', 'total_results', 'score', 'provider']);
        });
    }
};
