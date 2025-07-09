# Services à la carte - Documentation

## 📋 Fonctionnalités implémentées

### 1. Section "Services à la carte" sur la page d'accueil

**Localisation :** `resources/views/welcome.blade.php`

-   ✅ Titre principal changé en "Services à la carte :"
-   ✅ Interface avec checkboxes pour sélectionner multiple services
-   ✅ Liste complète des services disponibles :
    -   Calcul de la taille échantillonnale
    -   Établissement d'un plan d'analyses statistiques
    -   Nettoyage + organisation des données
    -   Visualisation des données (graphique + interprétation)
    -   Analyse descriptive
    -   Analyses bivariées : Test t / Chi² / ANOVA / corrélations
    -   Courbe ROC et validité d'un test diagnostique
    -   Analyse de survie / Kaplan-Meier
    -   Analyse multivariée (ACP, ACM, AFC...)
    -   Régressions : linéaires multiples / logistiques
    -   Modèle de Cox
    -   Élaboration de protocole

### 2. Formulaire d'informations projet

**Champs disponibles :**

-   🔢 Nombre d'individus total (optionnel)
-   🔢 Nombre de variables (obligatoire)
-   ⏱️ Délais de réalisation (obligatoire) - Liste déroulante
-   📝 Remarques (optionnel)

### 3. Validation et redirection

**JavaScript :** Validation côté client avec :

-   ✅ Vérification qu'au moins un service est sélectionné
-   ✅ Validation des champs obligatoires
-   ✅ Sauvegarde dans localStorage
-   ✅ Redirection vers inscription avec paramètre `?devis=1`

### 4. Page d'inscription enrichie

**Localisation :** `resources/views/auth/register.blade.php`

-   ✅ Section spéciale affichée si `?devis=1` dans l'URL
-   ✅ Récupération automatique des données depuis localStorage
-   ✅ Affichage formaté des services sélectionnés
-   ✅ Affichage des informations du projet
-   ✅ Champs cachés pour transmettre les données au serveur

### 5. Traitement serveur

**Localisation :** `app/Http/Controllers/Auth/RegisteredUserController.php`

-   ✅ Validation des nouvelles données de devis
-   ✅ Détection automatique des demandes de devis
-   ✅ Envoi d'email automatique à l'admin

### 6. Email de notification admin

**Localisation :** `resources/views/emails/devis-notification.blade.php`

-   ✅ Template HTML professionnel
-   ✅ Informations complètes du client
-   ✅ Liste détaillée des services demandés
-   ✅ Détails du projet (variables, délais, remarques)
-   ✅ Actions recommandées pour l'admin

## 🔧 Utilisation

### Flow utilisateur :

1. L'utilisateur visite la page d'accueil
2. Scroll jusqu'à la section "Services à la carte"
3. Sélectionne les services souhaités
4. Remplit les informations du projet
5. Clique sur "Obtenir un devis"
6. Est redirigé vers la page d'inscription
7. Voit un résumé de sa demande
8. S'inscrit normalement
9. L'admin reçoit automatiquement un email avec tous les détails

### Flow admin :

1. Reçoit un email de notification
2. Voit toutes les informations client et projet
3. Peut contacter le client rapidement
4. Prépare un devis personnalisé

## 🎨 Design

-   Interface moderne avec Tailwind CSS
-   Cases à cocher stylées avec hover effects
-   Design responsive pour mobile/desktop
-   Validation visuelle et feedback utilisateur
-   Email HTML professionnel avec styles inline

## 🧪 Test

Un fichier de test est disponible : `test-services-flow.html`

-   Permet de tester le flow complet
-   Simule la sélection de services
-   Vérifie le localStorage
-   Teste la redirection

## 📱 Compatibilité

-   ✅ Compatible avec tous les navigateurs modernes
-   ✅ Support localStorage
-   ✅ Design responsive
-   ✅ CSS inline pour compatibilité email
-   ✅ Compatible avec Render (déploiement)

## 🚀 Prêt pour production

Toutes les fonctionnalités sont prêtes pour le déploiement :

-   CSS inline pour éviter les problèmes de Render
-   Validation robuste côté client et serveur
-   Gestion d'erreurs email
-   Template professionnel
-   UX optimisée
