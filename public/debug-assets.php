<?php
// 🔍 Debug Assets - Diagnostic des fichiers sur Render

echo "<h1>🔍 Debug Assets sur Render</h1>";
echo "<style>body{font-family:Arial;line-height:1.6;margin:20px;} .success{color:green;} .error{color:red;} .info{color:blue;}</style>";

// 1. Informations générales
echo "<h2>📋 Informations Générales</h2>";
echo "<p><strong>Environnement:</strong> " . ($_ENV['APP_ENV'] ?? 'N/A') . "</p>";
echo "<p><strong>APP_URL:</strong> " . ($_ENV['APP_URL'] ?? 'N/A') . "</p>";
echo "<p><strong>Host actuel:</strong> " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p><strong>Protocole:</strong> " . (isset($_SERVER['HTTPS']) ? 'HTTPS' : 'HTTP') . "</p>";

// 2. Vérification du dossier build
echo "<h2>📁 Vérification du dossier build</h2>";
$buildPath = __DIR__ . '/build';
if (is_dir($buildPath)) {
    echo "<p class='success'>✅ Dossier /build existe</p>";
    
    // Lister le contenu
    $buildContents = scandir($buildPath);
    echo "<ul>";
    foreach ($buildContents as $item) {
        if ($item !== '.' && $item !== '..') {
            echo "<li>📄 " . $item . "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p class='error'>❌ Dossier /build n'existe pas!</p>";
}

// 3. Vérification du dossier assets
echo "<h2>🎨 Vérification du dossier assets</h2>";
$assetsPath = __DIR__ . '/build/assets';
if (is_dir($assetsPath)) {
    echo "<p class='success'>✅ Dossier /build/assets existe</p>";
    
    // Lister les fichiers assets
    $assetFiles = scandir($assetsPath);
    echo "<ul>";
    foreach ($assetFiles as $file) {
        if ($file !== '.' && $file !== '..' && is_file($assetsPath . '/' . $file)) {
            $size = round(filesize($assetsPath . '/' . $file) / 1024, 2);
            echo "<li>🎯 <strong>" . $file . "</strong> (" . $size . " KB)</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p class='error'>❌ Dossier /build/assets n'existe pas!</p>";
}

// 4. Vérification du manifest.json
echo "<h2>📋 Vérification du manifest.json</h2>";
$manifestPath = __DIR__ . '/build/manifest.json';
if (file_exists($manifestPath)) {
    echo "<p class='success'>✅ manifest.json existe</p>";
    $manifest = json_decode(file_get_contents($manifestPath), true);
    echo "<pre>" . json_encode($manifest, JSON_PRETTY_PRINT) . "</pre>";
} else {
    echo "<p class='error'>❌ manifest.json n'existe pas!</p>";
}

// 5. Test des URLs d'assets
echo "<h2>🔗 Test des URLs d'assets</h2>";
if (isset($manifest)) {
    $baseUrl = 'https://' . $_SERVER['HTTP_HOST'];
    
    foreach ($manifest as $key => $asset) {
        $assetUrl = $baseUrl . '/build/' . $asset['file'];
        echo "<p><strong>" . $key . ":</strong></p>";
        echo "<p class='info'>URL: <a href='" . $assetUrl . "' target='_blank'>" . $assetUrl . "</a></p>";
        
        // Vérifier si le fichier existe localement
        $localFile = __DIR__ . '/build/' . $asset['file'];
        if (file_exists($localFile)) {
            echo "<p class='success'>✅ Fichier existe localement</p>";
        } else {
            echo "<p class='error'>❌ Fichier n'existe pas localement</p>";
        }
        echo "<hr>";
    }
}

// 6. Informations PHP
echo "<h2>🐘 Informations PHP</h2>";
echo "<p><strong>PHP Version:</strong> " . PHP_VERSION . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Path:</strong> " . __FILE__ . "</p>";

echo "<hr>";
echo "<p><small>🕒 Généré le: " . date('Y-m-d H:i:s') . "</small></p>";
?> 