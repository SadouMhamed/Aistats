# Guide de Migration Supabase - Devis et Factures

## 📋 Vue d'ensemble

Ce guide vous explique comment migrer les nouvelles tables `devis` et `factures` vers votre base de données Supabase de production.

## 🎯 Tables à créer

-   **`devis`** : Gestion des devis et estimations clients
-   **`factures`** : Gestion des factures et facturation
-   **Modifications `users`** : Ajout de champs pour les préférences de devis

## 🚀 Instructions d'exécution

### Étape 1 : Accéder à Supabase Dashboard

1. Allez sur [supabase.com](https://supabase.com)
2. Connectez-vous à votre compte
3. Sélectionnez le projet **nvaistat-prod**
4. Cliquez sur l'onglet **SQL Editor** dans la sidebar

### Étape 2 : Exécuter la migration

1. Ouvrez le fichier `migration_manual_supabase.sql`
2. Copiez tout le contenu du fichier
3. Collez-le dans l'éditeur SQL de Supabase
4. Cliquez sur **Run** pour exécuter la migration

### Étape 3 : Vérification

La migration inclut des requêtes de vérification qui vont automatiquement :

-   Lister les nouvelles tables créées
-   Afficher la structure des colonnes
-   Confirmer le succès de l'opération

## 📊 Structure des nouvelles tables

### Table `devis`

```sql
- id (BIGSERIAL PRIMARY KEY)
- user_id, admin_id (références vers users)
- type (services_carte, pack_landing, devis_libre)
- numero (unique, ex: DV250001)
- titre, description
- services (JSONB)
- prix_base, ajustement_complexite, remise_pourcentage
- tva_pourcentage, sous_total, montant_tva, total_ttc
- statut (brouillon, envoye, accepte, refuse, expire)
- dates (validite, echeance, envoi, reponse, acceptation)
- metadata (created_by, notes_admin)
```

### Table `factures`

```sql
- id (BIGSERIAL PRIMARY KEY)
- user_id, admin_id, devis_id (références)
- numero (unique, ex: FA250001)
- titre, description
- services, details_services (JSONB)
- prix_base, ajustement_complexite, remise_pourcentage
- tva_pourcentage, sous_total, montant_tva, total_ttc
- statut (brouillon, envoyee, payee, en_retard, annulee)
- dates (echeance, envoi, paiement)
- methode_paiement, reference_paiement
- created_by
```

## 🔒 Sécurité (RLS)

La migration configure automatiquement :

-   **Row Level Security** activé sur les deux tables
-   **Politiques d'accès** :
    -   Les utilisateurs voient uniquement leurs propres devis/factures
    -   Les admins ont accès complet à toutes les données
    -   Les utilisateurs peuvent modifier le statut de leurs devis

## ⚡ Fonctionnalités incluses

### Index de performance

-   Index sur user_id, admin_id, statut, dates
-   Index sur les numéros pour recherche rapide

### Triggers automatiques

-   Mise à jour automatique du champ `updated_at`

### Fonctions métier

-   `generate_devis_number()` : Génère DV250001, DV250002, etc.
-   `generate_facture_number()` : Génère FA250001, FA250002, etc.

## 🔧 Configuration Laravel

Après la migration, vérifiez que Laravel peut se connecter :

```php
// Dans config/database.php
'pgsql' => [
    'driver' => 'pgsql',
    'host' => env('DB_HOST', 'aws-0-eu-west-3.pooler.supabase.com'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'postgres'),
    'username' => env('DB_USERNAME', 'postgres.hrjjjaxmdvhabzbkwbgg'),
    'password' => env('DB_PASSWORD'),
    // ...
],
```

## 🧪 Tests post-migration

Après la migration, testez :

1. **Vérification des tables** :

```sql
SELECT tablename FROM pg_tables WHERE tablename IN ('devis', 'factures');
```

2. **Test des fonctions** :

```sql
SELECT generate_devis_number();
SELECT generate_facture_number();
```

3. **Test des contraintes** :

```sql
-- Test insertion d'un devis de test
INSERT INTO devis (user_id, admin_id, type, numero, titre, date_validite, prix_base, total_ttc)
VALUES (1, 1, 'devis_libre', 'TEST001', 'Test Migration', CURRENT_DATE + INTERVAL '30 days', 1000.00, 1200.00);
```

## ❌ Résolution des problèmes

### Erreur "relation already exists"

-   Normal si vous re-exécutez la migration
-   Les `CREATE TABLE IF NOT EXISTS` évitent les erreurs

### Erreur de référence foreign key

-   Vérifiez que la table `users` existe
-   Vérifiez que des utilisateurs existent dans la table

### Erreur de permissions

-   Vérifiez que vous êtes connecté avec un compte admin Supabase
-   Assurez-vous d'être sur le bon projet

## 📞 Support

Si vous rencontrez des problèmes :

1. Vérifiez les logs dans l'onglet "Logs" de Supabase
2. Consultez la documentation Supabase
3. Contactez le support si nécessaire

---

**Note** : Cette migration est idempotente, vous pouvez la re-exécuter sans problème si nécessaire.
