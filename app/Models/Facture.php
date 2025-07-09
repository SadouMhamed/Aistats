<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'devis_id',
        'numero',
        'titre',
        'description',
        'services',
        'details_services',
        'prix_base',
        'ajustement_complexite',
        'remise_pourcentage',
        'tva_pourcentage',
        'sous_total',
        'montant_tva',
        'total_ttc',
        'services_inclus',
        'conditions_paiement',
        'statut',
        'date_echeance',
        'date_envoi',
        'date_paiement',
        'methode_paiement',
        'reference_paiement',
        'created_by',
    ];

    protected $casts = [
        'services' => 'array',
        'details_services' => 'array',
        'prix_base' => 'decimal:2',
        'ajustement_complexite' => 'decimal:2',
        'remise_pourcentage' => 'decimal:2',
        'tva_pourcentage' => 'decimal:2',
        'sous_total' => 'decimal:2',
        'montant_tva' => 'decimal:2',
        'total_ttc' => 'decimal:2',
        'date_echeance' => 'date',
        'date_envoi' => 'datetime',
        'date_paiement' => 'datetime',
    ];

    /**
     * Relation avec le client
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'admin qui a créé la facture
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relation avec le devis
     */
    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }

    /**
     * Générer un numéro de facture unique
     */
    public static function generateNumeroFacture(): string
    {
        $year = date('Y');
        $month = date('m');
        $count = self::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count() + 1;
        
        return "FAC-{$year}{$month}-" . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Calculer le prix TTC
     */
    public function calculatePrixTTC(): void
    {
        $this->prix_ttc = $this->prix_ht * (1 + $this->tva / 100);
    }

    /**
     * Vérifier si la facture est en retard
     */
    public function isOverdue(): bool
    {
        return $this->date_echeance < now() && $this->statut !== 'payee';
    }

    /**
     * Obtenir le label du statut
     */
    public function getStatutLabel(): string
    {
        return match($this->statut) {
            'brouillon' => 'Brouillon',
            'envoyee' => 'Envoyée',
            'payee' => 'Payée',
            'en_retard' => 'En retard',
            'annulee' => 'Annulée',
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
            'envoyee' => 'blue',
            'payee' => 'green',
            'en_retard' => 'red',
            'annulee' => 'orange',
            default => 'gray'
        };
    }

    /**
     * Obtenir le label de la méthode de paiement
     */
    public function getMethodePaiementLabel(): string
    {
        return match($this->methode_paiement) {
            'virement' => 'Virement bancaire',
            'carte' => 'Carte bancaire',
            'cheque' => 'Chèque',
            'especes' => 'Espèces',
            'autre' => 'Autre',
            default => 'Non défini'
        };
    }
}
