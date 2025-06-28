#!/bin/bash

# 🔍 Test local des assets pour comparaison avec Render

echo "🔍 Test des assets localement vs Render..."

# 1. Vérifier les assets locaux
echo "📁 Assets locaux générés:"
if [ -d "public/build/assets" ]; then
    ls -la public/build/assets/
    echo ""
    echo "📋 Manifest local:"
    cat public/build/manifest.json | jq '.' 2>/dev/null || cat public/build/manifest.json
else
    echo "❌ Pas d'assets locaux!"
fi

echo ""
echo "🌐 URLs que Render devrait servir:"
echo "  https://aistats.onrender.com/build/manifest.json"
echo "  https://aistats.onrender.com/build/assets/app-BePH7TFh.css"
echo "  https://aistats.onrender.com/build/assets/app-DaBYqt0m.js"

echo ""
echo "🔗 Test avec curl (si disponible):"
if command -v curl &> /dev/null; then
    echo "  Testing manifest.json..."
    curl -s -o /dev/null -w "Status: %{http_code}\n" https://aistats.onrender.com/build/manifest.json
    
    echo "  Testing CSS file..."
    curl -s -o /dev/null -w "Status: %{http_code}\n" https://aistats.onrender.com/build/assets/app-BePH7TFh.css
    
    echo "  Testing JS file..."
    curl -s -o /dev/null -w "Status: %{http_code}\n" https://aistats.onrender.com/build/assets/app-DaBYqt0m.js
else
    echo "  curl non disponible - utilisez votre navigateur"
fi

echo ""
echo "🎯 Actions à faire maintenant:"
echo "1. Visitez: https://aistats.onrender.com/debug-assets.php"
echo "2. Vérifiez les logs de build Render dans votre dashboard"
echo "3. Si les assets n'existent pas sur Render, le problème est dans le build" 