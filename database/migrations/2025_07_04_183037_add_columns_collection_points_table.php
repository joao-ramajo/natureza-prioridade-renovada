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
        Schema::table('collection_points', function (Blueprint $table) {
            $table->time('open_from'); // <- Aberto das 
            $table->time('open_to'); // <- Aberto até
            $table->string('days_open'); // <- Dias de funcionamento (seg-sex)
            $table->text('description')->nullable(); // <- descrição
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collection_points', function(Blueprint $table) {
            $table->dropcolumn([
                'open_from',
                'open_to',
                'days_open',
                'description',
            ]);
        });
    }
};
