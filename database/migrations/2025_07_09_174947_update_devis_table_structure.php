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
        Schema::table('devis', function (Blueprint $table) {
            // Rename numero_devis to numero for consistency
            $table->renameColumn('numero_devis', 'numero');
            
            // Add missing pricing fields
            $table->decimal('prix_base', 10, 2)->after('remarques')->default(0);
            $table->decimal('ajustement_complexite', 10, 2)->after('prix_base')->default(0);
            $table->decimal('remise_pourcentage', 5, 2)->after('ajustement_complexite')->default(0);
            $table->decimal('tva_pourcentage', 5, 2)->after('remise_pourcentage')->default(20);
            $table->decimal('sous_total', 10, 2)->after('tva_pourcentage')->default(0);
            $table->decimal('montant_tva', 10, 2)->after('sous_total')->default(0);
            $table->decimal('total_ttc', 10, 2)->after('montant_tva')->default(0);
            
            // Add additional fields
            $table->text('services_inclus')->after('total_ttc')->nullable();
            $table->date('date_echeance')->after('date_validite')->nullable();
            $table->integer('validite_jours')->after('date_echeance')->default(30);
            $table->unsignedBigInteger('created_by')->after('validite_jours')->nullable();
            
            // Remove old pricing columns
            $table->dropColumn(['prix_ht', 'prix_ttc']);
            
            // Update enum values for statut
            $table->dropColumn('statut');
        });
        
        // Re-add statut column with updated enum values
        Schema::table('devis', function (Blueprint $table) {
            $table->enum('statut', ['brouillon', 'envoye', 'accepte', 'refuse', 'expire'])->after('conditions')->default('brouillon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devis', function (Blueprint $table) {
            // Rename back
            $table->renameColumn('numero', 'numero_devis');
            
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
                'date_echeance',
                'validite_jours',
                'created_by'
            ]);
            
            // Re-add old columns
            $table->decimal('prix_ht', 10, 2)->after('remarques');
            $table->decimal('prix_ttc', 10, 2)->after('prix_ht');
        });
    }
};
