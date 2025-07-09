<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Devis {{ $devis->numero }}</title>
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
        .devis-info {
            text-align: right;
            flex: 1;
        }
        .devis-number {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .client-section, .devis-section {
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
        .status-envoye { background-color: #dbeafe; color: #1e40af; }
        .status-accepte { background-color: #dcfce7; color: #166534; }
        .status-refuse { background-color: #fee2e2; color: #991b1b; }
        .status-expire { background-color: #fef3c7; color: #92400e; }
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
        <div class="devis-info">
            <div class="devis-number">DEVIS {{ $devis->numero }}</div>
            <div style="margin: 5px 0;">
                <span class="status-badge status-{{ $devis->statut }}">
                    @if($devis->statut === 'envoye') ENVOYÉ
                    @elseif($devis->statut === 'accepte') ACCEPTÉ  
                    @elseif($devis->statut === 'refuse') REFUSÉ
                    @elseif($devis->statut === 'expire') EXPIRÉ
                    @else {{ strtoupper($devis->statut) }}
                    @endif
                </span>
            </div>
            <div>Date: {{ $devis->created_at->format('d/m/Y') }}</div>
            <div>Valide jusqu'au: {{ $devis->date_validite->format('d/m/Y') }}</div>
        </div>
    </div>

    <!-- Informations client -->
    <div class="client-section">
        <div class="section-title">INFORMATIONS CLIENT</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nom:</div>
                <div class="info-value">{{ $devis->user->nom }} {{ $devis->user->prenom }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $devis->user->email }}</div>
            </div>
            @if($devis->user->telephone)
            <div class="info-row">
                <div class="info-label">Téléphone:</div>
                <div class="info-value">{{ $devis->user->telephone }}</div>
            </div>
            @endif
            @if($devis->user->profession)
            <div class="info-row">
                <div class="info-label">Profession:</div>
                <div class="info-value">{{ $devis->user->profession }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Détails du devis -->
    <div class="devis-section">
        <div class="section-title">DÉTAILS DU DEVIS</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Titre:</div>
                <div class="info-value"><strong>{{ $devis->titre }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">Type:</div>
                <div class="info-value">
                    @if($devis->type === 'services_carte')
                        Services à la carte
                    @elseif($devis->type === 'pack_landing')
                        Pack {{ $devis->pack_choisi }}
                    @else
                        Devis personnalisé
                    @endif
                </div>
            </div>
            @if($devis->description)
            <div class="info-row">
                <div class="info-label">Description:</div>
                <div class="info-value">{{ $devis->description }}</div>
            </div>
            @endif
            @if($devis->nb_individus)
            <div class="info-row">
                <div class="info-label">Nb individus:</div>
                <div class="info-value">{{ $devis->nb_individus }}</div>
            </div>
            @endif
            @if($devis->nb_variables)
            <div class="info-row">
                <div class="info-label">Nb variables:</div>
                <div class="info-value">{{ $devis->nb_variables }}</div>
            </div>
            @endif
            @if($devis->delais)
            <div class="info-row">
                <div class="info-label">Délais:</div>
                <div class="info-value">{{ $devis->delais }}</div>
            </div>
            @endif
        </div>

        @if($devis->services && count($devis->services) > 0)
        <div style="margin-top: 15px;">
            <strong>Services inclus:</strong>
            <ul class="services-list">
                @foreach($devis->services as $service)
                <li>• {{ $service }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($devis->remarques)
        <div style="margin-top: 15px;">
            <strong>Remarques:</strong>
            <div style="margin-top: 5px;">{{ $devis->remarques }}</div>
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
                <td style="text-align: right;">{{ number_format($devis->prix_base, 2, ',', ' ') }}</td>
            </tr>
            @if($devis->ajustement_complexite != 0)
            <tr>
                <td>Ajustement complexité</td>
                <td style="text-align: right;">{{ $devis->ajustement_complexite > 0 ? '+' : '' }}{{ number_format($devis->ajustement_complexite, 2, ',', ' ') }}</td>
            </tr>
            @endif
            @if($devis->remise_pourcentage > 0)
            <tr>
                <td>Remise ({{ $devis->remise_pourcentage }}%)</td>
                <td style="text-align: right; color: #059669;">-{{ number_format($devis->sous_total * $devis->remise_pourcentage / 100, 2, ',', ' ') }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Sous-total HT</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($devis->sous_total, 2, ',', ' ') }}</strong></td>
            </tr>
            @if($devis->tva_pourcentage > 0)
            <tr>
                <td>TVA ({{ $devis->tva_pourcentage }}%)</td>
                <td style="text-align: right;">{{ number_format($devis->montant_tva, 2, ',', ' ') }}</td>
            </tr>
            @endif
            <tr class="pricing-total">
                <td><strong>TOTAL TTC</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($devis->total_ttc, 2, ',', ' ') }} DZD</strong></td>
            </tr>
        </tbody>
    </table>

    @if($devis->services_inclus)
    <div style="margin-top: 20px;">
        <div class="section-title">SERVICES INCLUS</div>
        <div style="white-space: pre-line;">{{ $devis->services_inclus }}</div>
    </div>
    @endif

    @if($devis->conditions)
    <div class="conditions">
        <div class="section-title">CONDITIONS</div>
        <div style="white-space: pre-line;">{{ $devis->conditions }}</div>
    </div>
    @endif

    <div class="footer">
        NV AIStats - Services d'analyse statistique professionnels<br>
        Email: nvwalid@gmail.com | Tél: +213 551 234 567 | Alger, Algérie
    </div>
</body>
</html> 