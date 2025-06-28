<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Fichiers - {{ $user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            color: #6b7280;
        }
        .stats {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .stat-item {
            text-align: center;
            flex: 1;
            margin: 10px;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        .stat-label {
            color: #6b7280;
            font-size: 14px;
        }
        .files-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .files-table th {
            background-color: #f3f4f6;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-weight: bold;
        }
        .files-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .files-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .file-icon {
            font-size: 18px;
            margin-right: 8px;
        }
        .file-type {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .file-status {
            background-color: #d1fae5;
            color: #047857;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .file-types-summary {
            margin-top: 20px;
        }
        .type-item {
            display: inline-block;
            margin: 5px;
            padding: 5px 10px;
            background-color: #e5e7eb;
            border-radius: 15px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📁 Rapport des Fichiers</h1>
        <p><strong>Utilisateur:</strong> {{ $user->name }} ({{ $user->email }})</p>
        <p><strong>Date de génération:</strong> {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="stats">
        <h2>📊 Statistiques Générales</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">{{ $totalFiles }}</div>
                <div class="stat-label">Fichiers Total</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ number_format($totalSize / (1024*1024), 2) }} MB</div>
                <div class="stat-label">Taille Totale</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $fileTypes->count() }}</div>
                <div class="stat-label">Types de Fichiers</div>
            </div>
        </div>

        @if($fileTypes->count() > 0)
        <div class="file-types-summary">
            <h3>Types de fichiers:</h3>
            @foreach($fileTypes as $type => $count)
                <span class="type-item">{{ strtoupper($type) }}: {{ $count }}</span>
            @endforeach
        </div>
        @endif
    </div>

    @if($files->count() > 0)
    <h2>📋 Liste Détaillée des Fichiers</h2>
    <table class="files-table">
        <thead>
            <tr>
                <th>Fichier</th>
                <th>Type</th>
                <th>Taille</th>
                <th>Statut</th>
                <th>Date d'upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td>
                    <span class="file-icon">{{ $file->icon }}</span>
                    <strong>{{ $file->original_name }}</strong>
                    @if($file->description)
                        <br><small style="color: #6b7280;">{{ $file->description }}</small>
                    @endif
                </td>
                <td>
                    <span class="file-type">{{ strtoupper($file->file_extension) }}</span>
                </td>
                <td>{{ $file->formatted_size }}</td>
                <td>
                    <span class="file-status">{{ ucfirst($file->status) }}</span>
                </td>
                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="text-align: center; padding: 40px;">
        <h3>Aucun fichier trouvé</h3>
        <p>Vous n'avez pas encore uploadé de fichiers.</p>
    </div>
    @endif

    <div class="footer">
        <p>Rapport généré automatiquement par l'application AiStats</p>
        <p>{{ now()->format('d/m/Y à H:i:s') }}</p>
    </div>
</body>
</html> 