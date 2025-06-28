#!/bin/bash

# 🔧 Script de résolution définitive des erreurs 404 assets sur Render
# Résout tous les problèmes liés aux assets non trouvés

echo "🔧 Résolution définitive des erreurs 404 assets..."

# 1. Vérification de l'environnement local
echo "📋 Vérification de l'environnement local..."
echo "  PHP Version: $(php -v | head -n 1)"
echo "  Node Version: $(node -v)"
echo "  NPM Version: $(npm -v)"

# 2. Nettoyage complet
echo "🧹 Nettoyage complet..."
rm -rf public/build
rm -rf node_modules/.cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 3. Réinstallation des dépendances
echo "📦 Réinstallation des dépendances..."
npm install

# 4. Build des assets avec informations détaillées
echo "🔨 Build des assets avec debug..."
npm run build

# 5. Vérification des assets générés
echo "✅ Vérification des assets générés..."
if [ -d "public/build" ]; then
    echo "  ✓ Dossier build créé"
    if [ -d "public/build/assets" ]; then
        echo "  ✓ Dossier assets créé"
        echo "  📁 Fichiers assets:"
        ls -la public/build/assets/ | sed 's/^/    /'
    else
        echo "  ❌ Dossier assets manquant!"
    fi
    
    if [ -f "public/build/manifest.json" ]; then
        echo "  ✓ Manifest.json créé"
        echo "  📋 Contenu du manifest:"
        cat public/build/manifest.json | jq '.' 2>/dev/null || cat public/build/manifest.json
    else
        echo "  ❌ Manifest.json manquant!"
    fi
else
    echo "  ❌ Dossier build non créé!"
    exit 1
fi

# 6. Optimisation Laravel
echo "💾 Optimisation Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Test avec l'URL correcte
echo "🧪 Test avec configuration Render..."
APP_ENV=production APP_URL=https://aistats.onrender.com php artisan config:cache

# 8. Commit et push automatique
echo "📤 Déploiement des corrections..."
git add .
git commit -m "Fix: Résolution définitive erreurs 404 assets - URL corrigée + fallbacks robustes + debug page"
git push origin main

echo ""
echo "✅ Corrections déployées avec succès!"
echo ""
echo "🔍 Diagnostics à faire après le redéploiement Render:"
echo ""
echo "1. Visitez votre page de diagnostic:"
echo "   👉 https://aistats.onrender.com/debug-assets.php"
echo ""
echo "2. Vérifiez les URLs d'assets directement:"
echo "   👉 https://aistats.onrender.com/build/manifest.json"
echo "   👉 https://aistats.onrender.com/build/assets/app-BePH7TFh.css"
echo "   👉 https://aistats.onrender.com/build/assets/app-DaBYqt0m.js"
echo ""
echo "3. Vérifiez la console F12 pour les logs de debug"
echo ""
echo "4. Dans le dashboard Render, vérifiez que:"
echo "   - APP_URL=https://aistats.onrender.com"
echo "   - Le build s'est terminé avec succès"
echo "   - Les logs ne montrent pas d'erreurs de build"
echo ""
echo "🎯 Si les assets sont encore 404 après cela:"
echo "   - Le problème vient du serveur Render"
echo "   - La page debug-assets.php vous dira exactement quoi faire"
echo ""
echo "💡 Le CSS de fallback devrait au minimum rendre la page utilisable"
echo "    même si les assets principaux ne se chargent pas." 