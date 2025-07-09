<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis {{ $devis->numero }}</title>
    <style>
        @media print {
            @page {
                margin: 1cm;
                size: A4;
            }
            .no-print {
                display: none !important;
            }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 21cm;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }
        
        .header {
            border-bottom: 3px solid #2563eb;
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
            font-size: 28px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .devis-info {
            text-align: right;
            flex: 1;
        }
        
        .devis-number {
            font-size: 24px;
            font-weight: bold;
            color: #059669;
            margin-bottom: 10px;
        }
        
        .client-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 5px;
        }
        
        .info-item {
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #4b5563;
            display: inline-block;
            width: 120px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-brouillon { background: #fef2f2; color: #991b1b; }
        .status-envoye { background: #eff6ff; color: #1e40af; }
        .status-accepte { background: #f0fdf4; color: #166534; }
        .status-refuse { background: #fffbeb; color: #92400e; }
        .status-expire { background: #f9fafb; color: #374151; }
        
        .content-section {
            margin-bottom: 30px;
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        
        .devis-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
        }
        
        .description {
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        
        .services-list {
            background: white;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #e5e7eb;
        }
        
        .conditions-box {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        
        .pricing-section {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
        }
        
        .pricing-details .price-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .price-row:last-child {
            border-bottom: none;
        }
        
        .price-label {
            color: #6b7280;
        }
        
        .price-value {
            font-weight: 600;
        }
        
        .price-positive {
            color: #dc2626;
        }
        
        .price-negative {
            color: #059669;
        }
        
        .total-section {
            background: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            border: 2px solid #e5e7eb;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .total-final {
            font-size: 20px;
            font-weight: bold;
            color: #059669;
            padding-top: 15px;
            border-top: 2px solid #059669;
            margin-top: 10px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            z-index: 1000;
        }
        
        .print-button:hover {
            background: #2563eb;
        }
        

    </style>
</head>
<body>
    @if(!isset($isPdfGeneration) || !$isPdfGeneration)
        <button class="print-button no-print" onclick="window.print()">📄 Imprimer PDF</button>
    @endif
    
    <!-- Header -->
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
        <div class="devis-info">
            <div class="devis-number">DEVIS {{ $devis->numero }}</div>
            <div class="info-item">
                <span class="status-badge status-{{ $devis->statut }}">{{ ucfirst($devis->statut) }}</span>
            </div>
            <div style="margin-top: 15px; font-size: 12px; color: #6b7280;">
                <div>Date: {{ $devis->created_at->format('d/m/Y') }}</div>
                @if($devis->date_validite)
                    <div>Valide jusqu'au: {{ $devis->date_validite->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Client and Company Info -->
    <div class="client-section">
        <div>
            <h3 class="section-title">Informations Client</h3>
            <div class="info-item">
                <span class="info-label">Nom:</span>
                {{ $devis->user->nom }} {{ $devis->user->prenom }}
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                {{ $devis->user->email }}
            </div>
            @if($devis->user->telephone)
                <div class="info-item">
                    <span class="info-label">Téléphone:</span>
                    {{ $devis->user->telephone }}
                </div>
            @endif
            @if($devis->user->profession)
                <div class="info-item">
                    <span class="info-label">Profession:</span>
                    {{ $devis->user->profession }}
                </div>
            @endif
        </div>
        
        <div>
            <h3 class="section-title">Détails du Devis</h3>
            <div class="info-item">
                <span class="info-label">Type:</span>
                @if($devis->type === 'services_carte')
                    Services à la carte
                @elseif($devis->type === 'pack_landing')
                    Pack Landing
                @else
                    Personnalisé
                @endif
            </div>
            <div class="info-item">
                <span class="info-label">Créé le:</span>
                {{ $devis->created_at->format('d/m/Y à H:i') }}
            </div>
            @if($devis->date_echeance)
                <div class="info-item">
                    <span class="info-label">Échéance:</span>
                    {{ $devis->date_echeance->format('d/m/Y') }}
                </div>
            @endif
            <div class="info-item">
                <span class="info-label">Validité:</span>
                {{ $devis->validite_jours }} jours
            </div>
        </div>
    </div>
    
    <!-- Devis Content -->
    <div class="content-section">
        <h2 class="devis-title">{{ $devis->titre }}</h2>
        
        @if($devis->description)
            <div class="description">{{ $devis->description }}</div>
        @endif
        
        @if($devis->services_inclus)
            <h4 style="margin-bottom: 10px; color: #374151;">Services Inclus</h4>
            <div class="services-list">
                <pre style="white-space: pre-wrap; font-family: inherit; margin: 0; color: #374151;">{{ $devis->services_inclus }}</pre>
            </div>
        @endif
        
        @if($devis->conditions)
            <h4 style="margin-bottom: 10px; color: #374151;">Conditions Particulières</h4>
            <div class="conditions-box">
                <pre style="white-space: pre-wrap; font-family: inherit; margin: 0; color: #92400e;">{{ $devis->conditions }}</pre>
            </div>
        @endif
    </div>
    
    <!-- Pricing -->
    <div class="pricing-section">
        <h3 class="section-title">Détail des Prix</h3>
        <div class="pricing-grid">
            <div class="pricing-details">
                <div class="price-row">
                    <span class="price-label">Prix de base :</span>
                    <span class="price-value">{{ number_format($devis->prix_base, 2) }} DZD</span>
                </div>
                @if($devis->ajustement_complexite != 0)
                    <div class="price-row">
                        <span class="price-label">Ajustement complexité :</span>
                        <span class="price-value {{ $devis->ajustement_complexite > 0 ? 'price-positive' : 'price-negative' }}">
                            {{ $devis->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($devis->ajustement_complexite, 2) }} DZD
                        </span>
                    </div>
                @endif
                @if($devis->remise_pourcentage > 0)
                    <div class="price-row">
                        <span class="price-label">Remise ({{ $devis->remise_pourcentage }}%) :</span>
                        <span class="price-value price-negative">
                            -{{ number_format(($devis->prix_base + $devis->ajustement_complexite) * $devis->remise_pourcentage / 100, 2) }} DZD
                        </span>
                    </div>
                @endif
            </div>
            
            <div class="total-section">
                <div class="total-row">
                    <span>Sous-total :</span>
                    <span style="font-weight: 600;">{{ number_format($devis->sous_total, 2) }} DZD</span>
                </div>
                <div class="total-row">
                    <span>TVA ({{ $devis->tva_pourcentage }}%) :</span>
                    <span style="font-weight: 600;">{{ number_format($devis->montant_tva, 2) }} DZD</span>
                </div>
                <div class="total-row total-final">
                    <span>Total TTC :</span>
                    <span>{{ number_format($devis->total_ttc, 2) }} DZD</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>AIStats - Services d'Analyse Statistique</strong></p>
        <p>Ce devis est valable {{ $devis->validite_jours }} jours à compter de sa date d'émission.</p>
        <p>Devis généré le {{ now()->format('d/m/Y à H:i') }} | Document référence: {{ $devis->numero }}</p>
    </div>
</body>
</html> 