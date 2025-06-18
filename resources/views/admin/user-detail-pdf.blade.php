<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'utilisateur - {{ $user->name }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; font-size: 12px; line-height: 1.6; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { margin: 0; font-size: 24px; color: #222; }
        .header p { margin: 5px 0; color: #666; }
        .section-title { font-size: 16px; font-weight: bold; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-top: 30px; margin-bottom: 15px; }
        .details-grid { width: 100%; border-collapse: collapse; }
        .details-grid td { padding: 8px 0; vertical-align: top; }
        .details-grid .label { font-weight: bold; color: #555; width: 150px; }
        .files-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .files-table th, .files-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .files-table th { background-color: #f7f7f7; font-weight: bold; }
        .footer { text-align: center; margin-top: 40px; font-size: 10px; color: #aaa; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Profil Utilisateur</h1>
            <p>Généré le {{ date('d/m/Y H:i') }}</p>
        </div>

        <h2 class="section-title">Informations sur le Compte</h2>
        <table class="details-grid">
            <tr>
                <td class="label">Nom d'utilisateur:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td class="label">Rôle:</td>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
            <tr>
                <td class="label">Pack Souscrit:</td>
                <td>{{ $user->pack ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <td class="label">Date d'inscription:</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>

        <h2 class="section-title">Préférences de l'utilisateur</h2>
        <table class="details-grid">
            <tr>
                <td class="label">Préférence de réunion:</td>
                <td>{{ $user->meeting_preference ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <td class="label">Préférence de paiement:</td>
                <td>{{ $user->payment_preference ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <td class="label">État du paiement:</td>
                <td>{{ $user->payment_status ?? 'Non spécifié' }}</td>
            </tr>
        </table>

        <h2 class="section-title">Informations Personnelles</h2>
        <table class="details-grid">
            <tr>
                <td class="label">Nom:</td>
                <td>{{ $user->nom }}</td>
            </tr>
            <tr>
                <td class="label">Prénom:</td>
                <td>{{ $user->prenom }}</td>
            </tr>
            <tr>
                <td class="label">Profession:</td>
                <td>{{ $user->profession ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <td class="label">Numéro de téléphone:</td>
                <td>{{ $user->telephone ?? 'Non spécifié' }}</td>
            </tr>
        </table>

        <h2 class="section-title">Fichiers Téléchargés ({{ $user->files->count() }})</h2>
        @if($user->files->count() > 0)
            <table class="files-table">
                <thead>
                    <tr>
                        <th>Nom du fichier</th>
                        <th>Taille</th>
                        <th>Date de dépôt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->files as $file)
                        <tr>
                            <td>{{ $file->original_name }}</td>
                            <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                            <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Cet utilisateur n'a téléchargé aucun fichier.</p>
        @endif

        <div class="footer">
            Rapport généré par le système de gestion.
        </div>
    </div>
</body>
</html> 