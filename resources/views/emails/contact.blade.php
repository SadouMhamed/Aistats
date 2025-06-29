<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle demande de contact - AIStats</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb; border-bottom: 2px solid #2563eb; padding-bottom: 10px;">
            📧 Nouvelle demande de contact - AIStats
        </h2>
        
        <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #374151;">Informations du contact :</h3>
            <p><strong>Nom :</strong> {{ $nom }}</p>
            <p><strong>Prénom :</strong> {{ $prenom }}</p>
            <p><strong>Email :</strong> {{ $email }}</p>
            <p><strong>Date :</strong> {{ $date }}</p>
        </div>
        
        <div style="background: #fff; padding: 20px; border-left: 4px solid #2563eb; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #374151;">Message :</h3>
            <p style="white-space: pre-wrap;">{{ $message }}</p>
        </div>
        
        <div style="margin-top: 30px; padding: 15px; background: #f3f4f6; border-radius: 8px; text-align: center;">
            <p style="margin: 0; color: #6b7280; font-size: 14px;">
                Ce message a été envoyé depuis le formulaire de contact du site AIStats.<br>
                Vous pouvez répondre directement à cet email pour contacter {{ $prenom }} {{ $nom }}.
            </p>
        </div>
    </div>
</body>
</html> 