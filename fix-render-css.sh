#!/bin/bash

# 🎨 Script de résolution CSS pour Render.com
# Ce script résout les problèmes d'affichage CSS sur Render

echo "🎨 Résolution du problème CSS sur Render..."

# 1. Rebuild des assets avec les bonnes URLs
echo "🔨 Reconstruction des assets pour la production..."
rm -rf public/build
npm run build

# 2. Vérification des assets buildés
echo "✅ Vérification des assets générés..."
if [ -d "public/build/assets" ]; then
    echo "📁 Assets trouvés:"
    ls -la public/build/assets/
else
    echo "❌ Erreur: Assets non générés!"
    exit 1
fi

# 3. Clear des caches Laravel
echo "🧹 Nettoyage des caches Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 4. Regeneration des caches optimisés
echo "💾 Génération des caches optimisés..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Test local avant déploiement
echo "🧪 Test de l'environnement de production localement..."
APP_ENV=production php artisan config:cache

echo ""
echo "✅ Correction CSS terminée!"
echo ""
echo "📋 Prochaines étapes pour Render:"
echo "1. Commitez et poussez ces changements:"
echo "   git add ."
echo "   git commit -m 'Fix: Résolution problème CSS sur Render'"
echo "   git push origin main"
echo ""
echo "2. Dans votre dashboard Render, vérifiez que la variable APP_URL est correcte:"
echo "   APP_URL=https://votre-app.onrender.com"
echo ""
echo "3. Redéployez manuellement si nécessaire"
echo ""
echo "🔗 Testez ces URLs après déploiement:"
echo "   https://votre-app.onrender.com/build/assets/app-Dq_idYs2.css"
echo "   https://votre-app.onrender.com/build/assets/app-DaBYqt0m.js" 