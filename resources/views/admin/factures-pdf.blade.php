<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $facture->numero }}</title>
    @if(isset($isPdfGeneration) && $isPdfGeneration)
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'DejaVu Sans', Arial, sans-serif;
                font-size: 11pt;
                line-height: 1.4;
                color: #333;
                background: white;
            }
            
            .header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 2px solid #e5e7eb;
            }
            
            .company-info h1 {
                font-size: 24pt;
                font-weight: bold;
                color: #1f2937;
                margin-bottom: 8px;
            }
            
            .company-info p {
                margin: 2px 0;
                color: #6b7280;
                font-size: 10pt;
            }
            
            .facture-info {
                text-align: right;
            }
            
            .facture-info h2 {
                font-size: 18pt;
                font-weight: bold;
                color: #dc2626;
                margin-bottom: 8px;
            }
            
            .facture-info p {
                margin: 2px 0;
                font-size: 10pt;
            }
            
            .client-section {
                margin-bottom: 30px;
            }
            
            .client-section h3 {
                font-size: 12pt;
                font-weight: bold;
                color: #374151;
                margin-bottom: 8px;
                padding: 8px 12px;
                background: #f9fafb;
                border-left: 4px solid #3b82f6;
            }
            
            .client-info {
                padding: 12px;
                background: #f8fafc;
                border-radius: 6px;
            }
            
            .client-info p {
                margin: 3px 0;
                font-size: 10pt;
            }
            
            .content-section {
                margin-bottom: 25px;
            }
            
            .content-section h3 {
                font-size: 12pt;
                font-weight: bold;
                color: #374151;
                margin-bottom: 10px;
                padding: 8px 12px;
                background: #f9fafb;
                border-left: 4px solid #10b981;
            }
            
            .content-text {
                padding: 12px;
                font-size: 10pt;
                line-height: 1.5;
                color: #4b5563;
                background: #fafafa;
                border-radius: 4px;
            }
            
            .services-grid {
                margin-bottom: 25px;
            }
            
            .services-list {
                padding: 12px;
                background: #f8fafc;
                border-radius: 6px;
                border: 1px solid #e5e7eb;
            }
            
            .services-list ul {
                margin: 0;
                padding-left: 18px;
            }
            
            .services-list li {
                margin: 4px 0;
                font-size: 10pt;
                color: #374151;
            }
            
            .pricing-section {
                margin-top: 30px;
                padding-top: 20px;
                border-top: 2px solid #e5e7eb;
            }
            
            .pricing-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            
            .pricing-table th,
            .pricing-table td {
                padding: 8px 12px;
                text-align: left;
                border-bottom: 1px solid #e5e7eb;
                font-size: 10pt;
            }
            
            .pricing-table th {
                background: #f9fafb;
                font-weight: bold;
                color: #374151;
            }
            
            .pricing-table .amount {
                text-align: right;
                font-weight: 600;
            }
            
            .total-row {
                background: #f0f9ff;
                font-weight: bold;
            }
            
            .total-row td {
                border-top: 2px solid #3b82f6;
                font-size: 12pt;
                color: #1e40af;
            }
            
            .payment-terms {
                margin-top: 25px;
                padding: 15px;
                background: #fef3c7;
                border: 1px solid #f59e0b;
                border-radius: 6px;
            }
            
            .payment-terms h4 {
                font-size: 11pt;
                font-weight: bold;
                color: #92400e;
                margin-bottom: 8px;
            }
            
            .payment-terms p {
                font-size: 9pt;
                color: #92400e;
                line-height: 1.4;
            }
            
            .footer {
                margin-top: 40px;
                padding-top: 20px;
                border-top: 1px solid #e5e7eb;
                text-align: center;
                font-size: 9pt;
                color: #6b7280;
            }
            
            .status-badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 9pt;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            .status-envoyee {
                background: #dbeafe;
                color: #1e40af;
            }
            
            .status-payee {
                background: #dcfce7;
                color: #166534;
            }
            
            .status-brouillon {
                background: #fee2e2;
                color: #991b1b;
            }
            
            .status-annulee {
                background: #fef3c7;
                color: #92400e;
            }
            
            .page-break {
                page-break-after: always;
            }
        </style>
    @else
        <style>
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                background: #f8fafc;
                margin: 0;
                padding: 20px;
            }
            
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endif
</head>
<body>
    @if(!isset($isPdfGeneration) || !$isPdfGeneration)
    <div class="container">
    @endif
    
    <!-- Header -->
    <div class="header">
        <div class="company-info">
            <h1>NV AIStats</h1>
            <p><strong>Email:</strong> nvwalid@gmail.com</p>
            <p><strong>Téléphone:</strong> +213 551 234 567</p>
            <p><strong>Adresse:</strong> Alger, Algérie</p>
            <p><strong>SIRET:</strong> 123 456 789 00012</p>
        </div>
        <div class="facture-info">
            <h2>FACTURE</h2>
            <p><strong>Numéro:</strong> {{ $facture->numero }}</p>
            <p><strong>Date:</strong> {{ $facture->created_at->format('d/m/Y') }}</p>
            @if($facture->date_echeance)
                <p><strong>Échéance:</strong> {{ $facture->date_echeance->format('d/m/Y') }}</p>
            @endif
            <p><strong>Statut:</strong> 
                <span class="status-badge status-{{ $facture->statut }}">
                    @if($facture->statut === 'envoyee') Envoyée
                    @elseif($facture->statut === 'payee') Payée
                    @elseif($facture->statut === 'brouillon') Brouillon
                    @elseif($facture->statut === 'annulee') Annulée
                    @else En retard @endif
                </span>
            </p>
        </div>
    </div>

    <!-- Client Information -->
    <div class="client-section">
        <h3>Informations Client</h3>
        <div class="client-info">
            <p><strong>Nom:</strong> {{ $facture->user->nom }} {{ $facture->user->prenom }}</p>
            <p><strong>Email:</strong> {{ $facture->user->email }}</p>
            @if($facture->user->telephone)
                <p><strong>Téléphone:</strong> {{ $facture->user->telephone }}</p>
            @endif
            @if($facture->user->profession)
                <p><strong>Profession:</strong> {{ $facture->user->profession }}</p>
            @endif
            @if($facture->user->pack)
                <p><strong>Pack souscrit:</strong> {{ ucfirst(str_replace('_', ' ', $facture->user->pack)) }}</p>
            @endif
        </div>
    </div>

    <!-- Facture Title and Description -->
    <div class="content-section">
        <h3>{{ $facture->titre }}</h3>
        @if($facture->description)
            <div class="content-text">
                {{ $facture->description }}
            </div>
        @endif
    </div>

    <!-- Services -->
    @if($facture->services_inclus)
    <div class="services-grid">
        <h3>Services Inclus</h3>
        <div class="services-list">
            <pre style="font-family: inherit; white-space: pre-wrap; margin: 0; font-size: 10pt; line-height: 1.5;">{{ $facture->services_inclus }}</pre>
        </div>
    </div>
    @endif

    <!-- Pricing Details -->
    <div class="pricing-section">
        <h3>Détail de la Facturation</h3>
        <table class="pricing-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="amount">Montant (DZD)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prix de base</td>
                    <td class="amount">{{ number_format($facture->prix_base, 2, ',', ' ') }}</td>
                </tr>
                @if($facture->ajustement_complexite != 0)
                <tr>
                    <td>Ajustement complexité</td>
                    <td class="amount" style="color: {{ $facture->ajustement_complexite > 0 ? '#dc2626' : '#10b981' }};">
                        {{ $facture->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($facture->ajustement_complexite, 2, ',', ' ') }}
                    </td>
                </tr>
                @endif
                @if($facture->remise_pourcentage > 0)
                <tr>
                    <td>Remise ({{ $facture->remise_pourcentage }}%)</td>
                    <td class="amount" style="color: #10b981;">
                        -{{ number_format(($facture->prix_base + $facture->ajustement_complexite) * $facture->remise_pourcentage / 100, 2, ',', ' ') }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td><strong>Sous-total HT</strong></td>
                    <td class="amount"><strong>{{ number_format($facture->sous_total, 2, ',', ' ') }}</strong></td>
                </tr>
                <tr>
                    <td>TVA ({{ $facture->tva_pourcentage }}%)</td>
                    <td class="amount">{{ number_format($facture->montant_tva, 2, ',', ' ') }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>TOTAL TTC</strong></td>
                    <td class="amount"><strong>{{ number_format($facture->total_ttc, 2, ',', ' ') }} DZD</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Payment Terms -->
    @if($facture->conditions_paiement)
    <div class="payment-terms">
        <h4>🔔 Conditions de Paiement</h4>
        <p>{{ $facture->conditions_paiement }}</p>
    </div>
    @endif

    <!-- Payment Status -->
    @if($facture->statut === 'payee' && $facture->date_paiement)
    <div style="margin-top: 25px; padding: 15px; background: #dcfce7; border: 1px solid #10b981; border-radius: 6px;">
        <h4 style="font-size: 11pt; font-weight: bold; color: #166534; margin-bottom: 8px;">✅ Facture Payée</h4>
        <p style="font-size: 9pt; color: #166534; margin: 0;">
            Payée le {{ $facture->date_paiement->format('d/m/Y à H:i') }}
            @if($facture->methode_paiement && $facture->methode_paiement !== 'non_specifie')
                • Méthode: {{ ucfirst($facture->methode_paiement) }}
            @endif
            @if($facture->reference_paiement)
                • Référence: {{ $facture->reference_paiement }}
            @endif
        </p>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Facture générée automatiquement le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>NV AIStats - Services de conseil en statistiques et analyse de données</p>
        @if($facture->devis)
            <p>Facture basée sur le devis {{ $facture->devis->numero }} accepté le {{ $facture->devis->date_acceptation ? $facture->devis->date_acceptation->format('d/m/Y') : 'N/A' }}</p>
        @endif
    </div>

    @if(!isset($isPdfGeneration) || !$isPdfGeneration)
    </div>
    @endif
</body>
</html> 