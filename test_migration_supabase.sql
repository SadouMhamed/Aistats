-- ============================================================================
-- SCRIPT DE TEST POST-MIGRATION - SUPABASE CLOUD
-- À exécuter après la migration pour vérifier que tout fonctionne
-- ============================================================================

-- Test 1: Vérifier que les tables existent
SELECT 
    table_name,
    table_type
FROM information_schema.tables 
WHERE table_schema = 'public' 
AND table_name IN ('devis', 'factures', 'users')
ORDER BY table_name;

-- Test 2: Compter les colonnes des nouvelles tables
SELECT 
    table_name,
    COUNT(column_name) as nb_colonnes
FROM information_schema.columns 
WHERE table_schema = 'public' 
AND table_name IN ('devis', 'factures')
GROUP BY table_name
ORDER BY table_name;

-- Test 3: Vérifier les nouvelles colonnes dans users
SELECT column_name 
FROM information_schema.columns 
WHERE table_schema = 'public' 
AND table_name = 'users' 
AND column_name LIKE 'devis_%'
ORDER BY column_name;

-- Test 4: Tester les fonctions de génération de numéros
SELECT 
    'Test génération numéros' as test,
    generate_devis_number() as numero_devis,
    generate_facture_number() as numero_facture;

-- Test 5: Vérifier les index créés
SELECT 
    schemaname,
    tablename,
    indexname
FROM pg_indexes 
WHERE schemaname = 'public' 
AND tablename IN ('devis', 'factures')
ORDER BY tablename, indexname;

-- Test 6: Vérifier les triggers
SELECT 
    trigger_name,
    event_object_table,
    trigger_schema
FROM information_schema.triggers 
WHERE event_object_schema = 'public' 
AND event_object_table IN ('devis', 'factures')
ORDER BY event_object_table, trigger_name;

-- Test 7: Vérifier les politiques RLS
SELECT 
    schemaname,
    tablename,
    policyname,
    cmd,
    roles
FROM pg_policies 
WHERE schemaname = 'public' 
AND tablename IN ('devis', 'factures')
ORDER BY tablename, policyname;

-- Test 8: Essai d'insertion de test (optionnel - décommentez si vous voulez tester)
/*
-- Créer un utilisateur de test d'abord
INSERT INTO users (name, email, password, role) 
VALUES ('Test User', 'test@example.com', 'password_hash', 'user')
ON CONFLICT (email) DO NOTHING;

-- Récupérer l'ID de l'utilisateur test
WITH test_user AS (
    SELECT id FROM users WHERE email = 'test@example.com' LIMIT 1
)
-- Insérer un devis de test
INSERT INTO devis (
    user_id, 
    admin_id, 
    type, 
    numero, 
    titre, 
    date_validite,
    prix_base,
    total_ttc
)
SELECT 
    id,
    id, 
    'devis_libre',
    generate_devis_number(),
    'Test Migration',
    CURRENT_DATE + INTERVAL '30 days',
    1000.00,
    1200.00
FROM test_user;

-- Vérifier l'insertion
SELECT 
    id,
    numero,
    titre,
    statut,
    created_at
FROM devis 
WHERE titre = 'Test Migration';
*/

-- Message final
SELECT '🎉 Tests de migration terminés avec succès !' as resultat; 