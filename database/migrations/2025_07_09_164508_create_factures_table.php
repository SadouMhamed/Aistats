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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('devis_id')->nullable()->constrained('devis')->onDelete('set null');
            
            // Informations de la facture
            $table->string('numero_facture')->unique();
            $table->string('titre');
            $table->text('description')->nullable();
            
            // Services et détails
            $table->json('services'); // Services facturés
            $table->json('details_services')->nullable(); // Détails supplémentaires
            
            // Prix et facturation
            $table->decimal('prix_ht', 10, 2);
            $table->decimal('tva', 5, 2)->default(20.00);
            $table->decimal('prix_ttc', 10, 2);
            $table->text('conditions_paiement')->nullable();
            
            // Statut et paiement
            $table->enum('statut', ['brouillon', 'envoyee', 'payee', 'en_retard', 'annulee'])->default('brouillon');
            $table->date('date_echeance');
            $table->timestamp('date_envoi')->nullable();
            $table->timestamp('date_paiement')->nullable();
            
            // Moyens de paiement
            $table->enum('mode_paiement', ['virement', 'carte', 'cheque', 'especes', 'autre'])->nullable();
            $table->string('reference_paiement')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
