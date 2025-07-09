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
        Schema::table('factures', function (Blueprint $table) {
            // Rename numero_facture to numero for consistency
            $table->renameColumn('numero_facture', 'numero');
            
            // Add missing pricing fields
            $table->decimal('prix_base', 10, 2)->after('details_services')->default(0);
            $table->decimal('ajustement_complexite', 10, 2)->after('prix_base')->default(0);
            $table->decimal('remise_pourcentage', 5, 2)->after('ajustement_complexite')->default(0);
            $table->decimal('tva_pourcentage', 5, 2)->after('remise_pourcentage')->default(20);
            $table->decimal('sous_total', 10, 2)->after('tva_pourcentage')->default(0);
            $table->decimal('montant_tva', 10, 2)->after('sous_total')->default(0);
            $table->decimal('total_ttc', 10, 2)->after('montant_tva')->default(0);
            
            // Add additional fields
            $table->text('services_inclus')->after('total_ttc')->nullable();
            $table->string('methode_paiement')->after('conditions_paiement')->nullable();
            $table->unsignedBigInteger('created_by')->after('reference_paiement')->nullable();
            
            // Remove old pricing columns
            $table->dropColumn(['prix_ht', 'prix_ttc']);
            
            // Remove old mode_paiement column
            $table->dropColumn('mode_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            // Rename back
            $table->renameColumn('numero', 'numero_facture');
            
            // Remove added columns
            $table->dropColumn([
                'prix_base',
                'ajustement_complexite', 
                'remise_pourcentage',
                'tva_pourcentage',
                'sous_total',
                'montant_tva',
                'total_ttc',
                'services_inclus',
                'methode_paiement',
                'created_by'
            ]);
            
            // Re-add old columns
            $table->decimal('prix_ht', 10, 2)->after('details_services');
            $table->decimal('prix_ttc', 10, 2)->after('prix_ht');
            $table->enum('mode_paiement', ['virement', 'carte', 'cheque', 'especes', 'autre'])->nullable();
        });
    }
};
