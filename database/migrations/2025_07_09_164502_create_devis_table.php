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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            
            // Type de devis
            $table->enum('type', ['services_carte', 'pack_landing', 'devis_libre']);
            
            // Informations du devis
            $table->string('numero_devis')->unique();
            $table->string('titre');
            $table->text('description')->nullable();
            
            // Services et détails
            $table->json('services')->nullable(); // Services sélectionnés
            $table->string('pack_choisi')->nullable(); // Si c'est un pack de la landing
            $table->integer('nb_individus')->nullable();
            $table->integer('nb_variables')->nullable();
            $table->string('delais')->nullable();
            $table->text('remarques')->nullable();
            
            // Prix et conditions
            $table->decimal('prix_ht', 10, 2);
            $table->decimal('tva', 5, 2)->default(20.00); // TVA en pourcentage
            $table->decimal('prix_ttc', 10, 2);
            $table->text('conditions')->nullable();
            
            // Statut
            $table->enum('statut', ['brouillon', 'envoye', 'accepte', 'refuse', 'expire'])->default('brouillon');
            $table->date('date_validite');
            $table->timestamp('date_envoi')->nullable();
            $table->timestamp('date_reponse')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
