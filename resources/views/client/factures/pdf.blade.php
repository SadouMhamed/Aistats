<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture {{ $facture->numero }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .company-info {
            flex: 1;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .company-tagline {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }
        .facture-info {
            text-align: right;
            flex: 1;
        }
        .facture-number {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .client-section, .facture-section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            padding: 3px 10px 3px 0;
            font-weight: bold;
            width: 30%;
        }
        .info-value {
            display: table-cell;
            padding: 3px 0;
        }
        .services-list {
            margin: 10px 0;
        }
        .services-list li {
            margin: 3px 0;
        }
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .pricing-table th, .pricing-table td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            text-align: left;
        }
        .pricing-table th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .pricing-total {
            background-color: #eff6ff;
            font-weight: bold;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-envoyee { background-color: #dbeafe; color: #1e40af; }
        .status-payee { background-color: #dcfce7; color: #166534; }
        .status-en_retard { background-color: #fee2e2; color: #991b1b; }
        .status-annulee { background-color: #fef3c7; color: #92400e; }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #6b7280;
            text-align: center;
        }
        .conditions {
            margin-top: 20px;
            font-size: 10px;
            color: #6b7280;
        }
        .payment-info {
            background-color: #f0f9ff;
            border: 1px solid #7dd3fc;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <div class="company-info">
            <div class="company-name">NV AIStats</div>
            <div class="company-tagline">Services d'analyse statistique professionnels</div>
            <div style="margin-top: 10px; color: #6b7280; font-size: 12px;">
                Email: nvwalid@gmail.com | Tél: +213 551 234 567
            </div>
            <div style="margin-top: 5px; color: #6b7280; font-size: 12px;">
                Adresse: Alger, Algérie | SIRET: 123 456 789 00012
            </div>
        </div>
        <div class="facture-info">
            <div class="facture-number">FACTURE {{ $facture->numero }}</div>
            <div style="margin: 5px 0;">
                <span class="status-badge status-{{ $facture->statut }}">
                    @if($facture->statut === 'envoyee') ENVOYÉE
                    @elseif($facture->statut === 'payee') PAYÉE  
                    @elseif($facture->statut === 'en_retard') EN RETARD
                    @elseif($facture->statut === 'annulee') ANNULÉE
                    @else {{ strtoupper($facture->statut) }}
                    @endif
                </span>
            </div>
            <div>Date: {{ $facture->created_at->format('d/m/Y') }}</div>
            <div>Échéance: {{ $facture->date_echeance->format('d/m/Y') }}</div>
            @if($facture->date_paiement)
                <div style="color: #059669; font-weight: bold;">Payée le: {{ $facture->date_paiement->format('d/m/Y') }}</div>
            @endif
        </div>
    </div>

    <!-- Informations client -->
    <div class="client-section">
        <div class="section-title">INFORMATIONS CLIENT</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nom:</div>
                <div class="info-value">{{ $facture->user->nom }} {{ $facture->user->prenom }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $facture->user->email }}</div>
            </div>
            @if($facture->user->telephone)
            <div class="info-row">
                <div class="info-label">Téléphone:</div>
                <div class="info-value">{{ $facture->user->telephone }}</div>
            </div>
            @endif
            @if($facture->user->profession)
            <div class="info-row">
                <div class="info-label">Profession:</div>
                <div class="info-value">{{ $facture->user->profession }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Détails de la facture -->
    <div class="facture-section">
        <div class="section-title">DÉTAILS DE LA FACTURE</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Titre:</div>
                <div class="info-value"><strong>{{ $facture->titre }}</strong></div>
            </div>
            @if($facture->devis)
            <div class="info-row">
                <div class="info-label">Devis associé:</div>
                <div class="info-value">{{ $facture->devis->numero }}</div>
            </div>
            @endif
            @if($facture->description)
            <div class="info-row">
                <div class="info-label">Description:</div>
                <div class="info-value">{{ $facture->description }}</div>
            </div>
            @endif
        </div>

        @if($facture->services && count($facture->services) > 0)
        <div style="margin-top: 15px;">
            <strong>Services facturés:</strong>
            <ul class="services-list">
                @foreach($facture->services as $service)
                <li>• {{ $service }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($facture->details_services && count($facture->details_services) > 0)
        <div style="margin-top: 15px;">
            <strong>Détails des services:</strong>
            <ul class="services-list">
                @foreach($facture->details_services as $detail)
                <li>• {{ $detail }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- Détail des prix -->
    <div class="section-title">DÉTAIL DES PRIX</div>
    <table class="pricing-table">
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align: right; width: 150px;">Montant (DZD)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Prix de base</td>
                <td style="text-align: right;">{{ number_format($facture->prix_base, 2, ',', ' ') }}</td>
            </tr>
            @if($facture->ajustement_complexite != 0)
            <tr>
                <td>Ajustement complexité</td>
                <td style="text-align: right;">{{ $facture->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($facture->ajustement_complexite, 2, ',', ' ') }}</td>
            </tr>
            @endif
            @if($facture->remise_pourcentage > 0)
            <tr>
                <td>Remise ({{ $facture->remise_pourcentage }}%)</td>
                <td style="text-align: right; color: #059669;">-{{ number_format($facture->sous_total * $facture->remise_pourcentage / 100, 2, ',', ' ') }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Sous-total HT</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($facture->sous_total, 2, ',', ' ') }}</strong></td>
            </tr>
            @if($facture->tva_pourcentage > 0)
            <tr>
                <td>TVA ({{ $facture->tva_pourcentage }}%)</td>
                <td style="text-align: right;">{{ number_format($facture->montant_tva, 2, ',', ' ') }}</td>
            </tr>
            @endif
            <tr class="pricing-total">
                <td><strong>TOTAL TTC</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($facture->total_ttc, 2, ',', ' ') }} DZD</strong></td>
            </tr>
        </tbody>
    </table>

    @if($facture->services_inclus)
    <div style="margin-top: 20px;">
        <div class="section-title">SERVICES INCLUS</div>
        <div style="white-space: pre-line;">{{ $facture->services_inclus }}</div>
    </div>
    @endif

    @if($facture->conditions_paiement)
    <div class="conditions">
        <div class="section-title">CONDITIONS DE PAIEMENT</div>
        <div style="white-space: pre-line;">{{ $facture->conditions_paiement }}</div>
    </div>
    @endif

    <!-- Informations de paiement (si payée) -->
    @if($facture->statut === 'payee' && ($facture->methode_paiement || $facture->reference_paiement))
    <div class="payment-info">
        <div style="font-weight: bold; margin-bottom: 10px; color: #1e40af;">INFORMATIONS DE PAIEMENT</div>
        @if($facture->methode_paiement)
        <div style="margin-bottom: 5px;">
            <strong>Méthode:</strong> 
            @switch($facture->methode_paiement)
                @case('virement') Virement bancaire @break
                @case('carte') Carte bancaire @break
                @case('cheque') Chèque @break
                @case('especes') Espèces @break
                @default {{ $facture->methode_paiement }}
            @endswitch
        </div>
        @endif
        @if($facture->reference_paiement)
        <div>
            <strong>Référence:</strong> {{ $facture->reference_paiement }}
        </div>
        @endif
    </div>
    @endif

    <div class="footer">
        NV AIStats - Services d'analyse statistique professionnels<br>
        Email: nvwalid@gmail.com | Tél: +213 551 234 567 | Alger, Algérie
    </div>
</body>
</html> 