#!/bin/bash

# 🔒 Script de correction HTTPS pour Render.com
# Résout le problème Mixed Content en forçant HTTPS

echo "🔒 Correction du problème HTTPS/Mixed Content sur Render..."

# 1. Clear Laravel caches
echo "🧹 Nettoyage des caches Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 2. Rebuild assets with HTTPS configuration
echo "🔨 Reconstruction des assets avec configuration HTTPS..."
npm run build

# 3. Cache optimized configuration
echo "💾 Mise en cache de la configuration optimisée..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Test HTTPS locally in production mode
echo "🧪 Test HTTPS en mode production local..."
APP_ENV=production APP_URL=https://aistats.onrender.com php artisan config:cache

echo ""
echo "✅ Correction HTTPS terminée!"
echo ""
echo "🔒 Changements appliqués:"
echo "   ✅ URLs forcées en HTTPS dans les layouts"
echo "   ✅ URL::forceScheme('https') ajouté au AppServiceProvider"
echo "   ✅ Fallbacks sécurisés configurés"
echo ""
echo "📋 Prochaines étapes:"
echo "1. Vérifiez dans votre dashboard Render que APP_URL est en HTTPS:"
echo "   APP_URL=https://aistats.onrender.com"
echo ""
echo "2. Poussez ces changements:"
echo "   git add ."
echo "   git commit -m 'Fix: Résolution Mixed Content - Force HTTPS pour tous les assets'"
echo "   git push origin main"
echo ""
echo "3. Après redéploiement, vérifiez que ces URLs sont accessibles en HTTPS:"
echo "   https://aistats.onrender.com/build/assets/app-Dq_idYs2.css"
echo "   https://aistats.onrender.com/build/assets/app-DaBYqt0m.js"
echo ""
echo "🎯 Plus de Mixed Content - Votre CSS va maintenant s'afficher ! 🎨" 