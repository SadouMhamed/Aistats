<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de devis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }
        .user-info {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #3b82f6;
        }
        .services-list {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #10b981;
        }
        .project-info {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f59e0b;
        }
        .footer {
            background-color: #374151;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        ul {
            margin: 0;
            padding-left: 20px;
        }
        li {
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            color: #374151;
        }
        .value {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Nouvelle demande de devis</h1>
        <p>Un nouveau client s'est inscrit avec une demande de services à la carte</p>
    </div>

    <div class="content">
        <!-- Informations du client -->
        <div class="user-info">
            <h2>👤 Informations du client</h2>
            <p><span class="label">Nom complet :</span> <span class="value">{{ $user->prenom }} {{ $user->nom }}</span></p>
            <p><span class="label">Email :</span> <span class="value">{{ $user->email }}</span></p>
            <p><span class="label">Téléphone :</span> <span class="value">{{ $user->telephone ?: 'Non renseigné' }}</span></p>
            <p><span class="label">Profession :</span> <span class="value">{{ $user->profession ?: 'Non renseignée' }}</span></p>
            <p><span class="label">Préférence réunion :</span> <span class="value">{{ $user->meeting_preference }}</span></p>
            <p><span class="label">Préférence paiement :</span> <span class="value">{{ $user->payment_preference }}</span></p>
        </div>

        <!-- Services demandés -->
        <div class="services-list">
            <h2>🔧 Services demandés</h2>
            @if(!empty($services))
                <ul>
                    @foreach($services as $service)
                        <li>{{ $service }}</li>
                    @endforeach
                </ul>
            @else
                <p class="value">Aucun service spécifique sélectionné</p>
            @endif
        </div>

        <!-- Informations du projet -->
        <div class="project-info">
            <h2>📊 Détails du projet</h2>
            <p><span class="label">Nombre d'individus :</span> <span class="value">{{ $nb_individus ?: 'Non spécifié' }}</span></p>
            <p><span class="label">Nombre de variables :</span> <span class="value">{{ $nb_variables ?: 'Non spécifié' }}</span></p>
            <p><span class="label">Délai souhaité :</span> <span class="value">{{ $delais ?: 'Non spécifié' }}</span></p>
            
            @if($remarques)
                <div style="margin-top: 15px; padding: 10px; background-color: #f3f4f6; border-radius: 4px;">
                    <p class="label">Remarques :</p>
                    <p class="value" style="font-style: italic;">{{ $remarques }}</p>
                </div>
            @endif
        </div>

        <!-- Actions recommandées -->
        <div style="background-color: #eff6ff; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6;">
            <h3>💡 Actions recommandées</h3>
            <ul>
                <li>Contacter le client dans les 24h pour discuter des détails</li>
                <li>Préparer un devis personnalisé basé sur les services demandés</li>
                <li>Programmer une réunion {{ $user->meeting_preference }}</li>
                <li>Prévoir le mode de paiement {{ $user->payment_preference }}</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Email envoyé automatiquement depuis {{ config('app.name') }}</p>
        <p>{{ now()->format('d/m/Y à H:i') }}</p>
    </div>
</body>
</html> 