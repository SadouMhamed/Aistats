<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Devis extends Model
{
    use HasFactory;

    protected $table = 'devis';

    protected $fillable = [
        'user_id',
        'admin_id',
        'type',
        'numero',
        'titre',
        'description',
        'services',
        'pack_choisi',
        'nb_individus',
        'nb_variables',
        'delais',
        'remarques',
        'prix_base',
        'ajustement_complexite',
        'remise_pourcentage',
        'tva_pourcentage',
        'sous_total',
        'montant_tva',
        'total_ttc',
        'services_inclus',
        'conditions',
        'statut',
        'date_validite',
        'date_echeance',
        'validite_jours',
        'date_envoi',
        'date_reponse',
        'created_by',
    ];

    protected $casts = [
        'services' => 'array',
        'prix_base' => 'decimal:2',
        'ajustement_complexite' => 'decimal:2',
        'remise_pourcentage' => 'decimal:2',
        'tva_pourcentage' => 'decimal:2',
        'sous_total' => 'decimal:2',
        'montant_tva' => 'decimal:2',
        'total_ttc' => 'decimal:2',
        'date_validite' => 'date',
        'date_echeance' => 'date',
        'date_envoi' => 'datetime',
        'date_reponse' => 'datetime',
    ];

    /**
     * Relation avec le client
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'admin qui a créé le devis
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relation avec les factures
     */
    public function factures(): HasMany
    {
        return $this->hasMany(Facture::class);
    }

    /**
     * Générer un numéro de devis unique
     */
    public static function generateNumeroDevis(): string
    {
        $year = date('Y');
        $month = date('m');
        $count = self::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count() + 1;
        
        return "DEV-{$year}{$month}-" . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Calculer le prix TTC
     */
    public function calculatePrixTTC(): void
    {
        $this->prix_ttc = $this->prix_ht * (1 + $this->tva / 100);
    }

    /**
     * Vérifier si le devis est expiré
     */
    public function isExpired(): bool
    {
        return $this->date_validite < now();
    }

    /**
     * Obtenir le label du type de devis
     */
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'services_carte' => 'Services à la carte',
            'pack_landing' => 'Pack de la landing page',
            'devis_libre' => 'Devis libre',
            default => 'Non défini'
        };
    }

    /**
     * Obtenir le label du statut
     */
    public function getStatutLabel(): string
    {
        return match($this->statut) {
            'brouillon' => 'Brouillon',
            'envoye' => 'Envoyé',
            'accepte' => 'Accepté',
            'refuse' => 'Refusé',
            'expire' => 'Expiré',
            default => 'Non défini'
        };
    }

    /**
     * Obtenir la couleur du statut
     */
    public function getStatutColor(): string
    {
        return match($this->statut) {
            'brouillon' => 'gray',
            'envoye' => 'blue',
            'accepte' => 'green',
            'refuse' => 'red',
            'expire' => 'orange',
            default => 'gray'
        };
    }
}
