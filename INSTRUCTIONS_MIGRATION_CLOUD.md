# 🚀 Instructions Migration Supabase Cloud

## Étapes à suivre (5 minutes)

### 1. 📱 Ouvrir Supabase Dashboard

-   Allez sur [supabase.com](https://supabase.com)
-   Connectez-vous à votre compte
-   Sélectionnez le projet **nvaistat-prod**

### 2. 📝 Accéder à l'éditeur SQL

-   Cliquez sur **SQL Editor** dans la sidebar gauche
-   Cliquez sur **New query**

### 3. 🔄 Exécuter la migration

1. Ouvrez le fichier `migration_supabase_cloud.sql`
2. **Copiez tout le contenu** (Ctrl+A puis Ctrl+C)
3. **Collez** dans l'éditeur SQL de Supabase (Ctrl+V)
4. Cliquez sur **Run** (ou Ctrl+Enter)

### 4. ✅ Vérifier le succès

Vous devriez voir :

```
🧪 Test génération numéros:
   Devis: DV250001
   Facture: FA250001

📊 Vérification des tables:
   Table devis: 1 (1 = OK)
   Table factures: 1 (1 = OK)

🎉 MIGRATION SUPABASE CLOUD TERMINÉE AVEC SUCCÈS !
```

### 5. 🔍 Vérification finale

-   Cliquez sur **Table Editor** dans la sidebar
-   Vous devriez voir les nouvelles tables :
    -   ✅ `devis`
    -   ✅ `factures`
-   Cliquez sur chaque table pour voir leur structure

## 🎯 Ce qui sera créé

### Tables

-   **`devis`** : 33 colonnes pour gestion des devis
-   **`factures`** : 27 colonnes pour gestion des factures
-   **Modifications `users`** : 5 nouveaux champs

### Fonctionnalités

-   **Numérotation automatique** : DV250001, FA250001...
-   **Index optimisés** pour performance
-   **Row Level Security** activé
-   **Triggers** pour dates automatiques
-   **Contraintes** de validation

## ⚠️ Important

-   La migration est **sécurisée** : `IF NOT EXISTS` évite les erreurs
-   Elle peut être **re-exécutée** sans problème
-   Les politiques RLS sont **permissives** au début (à affiner plus tard)

## 🐛 En cas de problème

-   Vérifiez que vous êtes sur le bon projet `nvaistat-prod`
-   Si erreur, copiez le message et recherchez la ligne correspondante
-   Les erreurs `already exists` sont normales lors de re-exécution

## 🎉 Après la migration

Votre application Laravel pourra utiliser les nouvelles tables :

-   Créer des devis
-   Générer des factures
-   Gérer la facturation client
-   Suivre les statuts et paiements
