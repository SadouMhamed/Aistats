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
        Schema::table('users', function (Blueprint $table) {
            // Données du devis services à la carte
            $table->json('devis_services')->nullable()->after('payment_status');
            $table->integer('devis_nb_individus')->nullable()->after('devis_services');
            $table->integer('devis_nb_variables')->nullable()->after('devis_nb_individus');
            $table->string('devis_delais')->nullable()->after('devis_nb_variables');
            $table->text('devis_remarques')->nullable()->after('devis_delais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'devis_services',
                'devis_nb_individus',
                'devis_nb_variables', 
                'devis_delais',
                'devis_remarques'
            ]);
        });
    }
};
