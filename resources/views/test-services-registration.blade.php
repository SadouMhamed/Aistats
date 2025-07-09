<!DOCTYPE html>
<html>
<head>
    <title>Test Services à la Carte Registration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea, select { width: 300px; padding: 8px; margin-top: 5px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .debug { background: #f8f9fa; padding: 15px; margin: 20px 0; border: 1px solid #dee2e6; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Test d'inscription Services à la Carte</h1>
    
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    
    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="debug">
        <h3>Données de test pré-remplies :</h3>
        <pre>{{ json_encode($testData, JSON_PRETTY_PRINT) }}</pre>
    </div>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Nom d'utilisateur</label>
            <input type="text" name="name" value="{{ $testData['name'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="{{ $testData['nom'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="{{ $testData['prenom'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" name="profession" value="{{ $testData['profession'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" value="{{ $testData['telephone'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $testData['email'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" value="{{ $testData['password'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" value="{{ $testData['password_confirmation'] }}" required>
        </div>
        
        <div class="form-group">
            <label for="meeting_preference">Préférence réunion</label>
            <select name="meeting_preference" required>
                <option value="en ligne" {{ $testData['meeting_preference'] == 'en ligne' ? 'selected' : '' }}>En ligne</option>
                <option value="en présentiel" {{ $testData['meeting_preference'] == 'en présentiel' ? 'selected' : '' }}>En présentiel</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="payment_preference">Préférence paiement</label>
            <select name="payment_preference" required>
                <option value="en ligne" {{ $testData['payment_preference'] == 'en ligne' ? 'selected' : '' }}>En ligne</option>
                <option value="main à main" {{ $testData['payment_preference'] == 'main à main' ? 'selected' : '' }}>Main à main</option>
            </select>
        </div>
        
        <!-- Services à la carte data -->
        <input type="hidden" name="pack" value="{{ $testData['pack'] }}">
        <input type="hidden" name="devis_services" value="{{ $testData['devis_services'] }}">
        <input type="hidden" name="devis_nb_individus" value="{{ $testData['devis_nb_individus'] }}">
        <input type="hidden" name="devis_nb_variables" value="{{ $testData['devis_nb_variables'] }}">
        <input type="hidden" name="devis_delais" value="{{ $testData['devis_delais'] }}">
        <input type="hidden" name="devis_remarques" value="{{ $testData['devis_remarques'] }}">
        
        <div class="debug">
            <h3>Données services à la carte :</h3>
            <p><strong>Services :</strong> {{ $testData['devis_services'] }}</p>
            <p><strong>Nb individus :</strong> {{ $testData['devis_nb_individus'] }}</p>
            <p><strong>Nb variables :</strong> {{ $testData['devis_nb_variables'] }}</p>
            <p><strong>Délais :</strong> {{ $testData['devis_delais'] }}</p>
            <p><strong>Remarques :</strong> {{ $testData['devis_remarques'] }}</p>
        </div>
        
        <button type="submit">Tester l'inscription</button>
    </form>
    
    <hr style="margin: 40px 0;">
    
    <h2>Actions de debug :</h2>
    <a href="{{ route('login') }}">Page de connexion</a> | 
    <a href="{{ route('admin.users') }}">Liste des utilisateurs (admin)</a> |
    <a href="javascript:localStorage.clear(); alert('localStorage vidé');">Vider localStorage</a>
</body>
</html> 