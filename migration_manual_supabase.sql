-- ============================================================================
-- MIGRATION MANUELLE POUR SUPABASE - DEVIS ET FACTURES
-- À exécuter dans l'éditeur SQL de Supabase Dashboard
-- ============================================================================

-- Étape 1: Ajouter les champs devis à la table users
ALTER TABLE users ADD COLUMN IF NOT EXISTS devis_services JSONB;
ALTER TABLE users ADD COLUMN IF NOT EXISTS devis_nb_individus VARCHAR(255);
ALTER TABLE users ADD COLUMN IF NOT EXISTS devis_nb_variables VARCHAR(255);
ALTER TABLE users ADD COLUMN IF NOT EXISTS devis_delais VARCHAR(255);
ALTER TABLE users ADD COLUMN IF NOT EXISTS devis_remarques TEXT;

-- Étape 2: Créer la table devis
CREATE TABLE IF NOT EXISTS devis (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    admin_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    
    -- Type de devis
    type VARCHAR(255) CHECK (type IN ('services_carte', 'pack_landing', 'devis_libre')) NOT NULL,
    
    -- Informations du devis
    numero VARCHAR(255) UNIQUE NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    
    -- Services et détails
    services JSONB, -- Services sélectionnés
    pack_choisi VARCHAR(255), -- Si c'est un pack de la landing
    nb_individus INTEGER,
    nb_variables INTEGER,
    delais VARCHAR(255),
    remarques TEXT,
    
    -- Prix et conditions (structure mise à jour)
    prix_base DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    ajustement_complexite DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    remise_pourcentage DECIMAL(5, 2) DEFAULT 0 NOT NULL,
    tva_pourcentage DECIMAL(5, 2) DEFAULT 20 NOT NULL,
    sous_total DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    montant_tva DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    total_ttc DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    
    -- Services inclus et conditions
    services_inclus TEXT,
    conditions TEXT,
    
    -- Statut et dates
    statut VARCHAR(255) CHECK (statut IN ('brouillon', 'envoye', 'accepte', 'refuse', 'expire')) DEFAULT 'brouillon' NOT NULL,
    date_validite DATE NOT NULL,
    date_echeance DATE,
    validite_jours INTEGER DEFAULT 30 NOT NULL,
    date_envoi TIMESTAMP WITH TIME ZONE,
    date_reponse TIMESTAMP WITH TIME ZONE,
    date_acceptation TIMESTAMP WITH TIME ZONE,
    
    -- Metadata
    created_by BIGINT,
    notes_admin TEXT,
    
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Étape 3: Créer la table factures
CREATE TABLE IF NOT EXISTS factures (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    admin_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    devis_id BIGINT REFERENCES devis(id) ON DELETE SET NULL,
    
    -- Informations de la facture
    numero VARCHAR(255) UNIQUE NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    
    -- Services et détails
    services JSONB, -- Services facturés (nullable maintenant)
    details_services JSONB, -- Détails supplémentaires
    
    -- Prix et facturation (structure mise à jour)
    prix_base DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    ajustement_complexite DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    remise_pourcentage DECIMAL(5, 2) DEFAULT 0 NOT NULL,
    tva_pourcentage DECIMAL(5, 2) DEFAULT 20 NOT NULL,
    sous_total DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    montant_tva DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    total_ttc DECIMAL(10, 2) DEFAULT 0 NOT NULL,
    
    -- Services inclus et conditions
    services_inclus TEXT,
    conditions_paiement TEXT,
    
    -- Statut et paiement
    statut VARCHAR(255) CHECK (statut IN ('brouillon', 'envoyee', 'payee', 'en_retard', 'annulee')) DEFAULT 'brouillon' NOT NULL,
    date_echeance DATE NOT NULL,
    date_envoi TIMESTAMP WITH TIME ZONE,
    date_paiement TIMESTAMP WITH TIME ZONE,
    
    -- Moyens de paiement
    methode_paiement VARCHAR(255),
    reference_paiement VARCHAR(255),
    
    -- Metadata
    created_by BIGINT,
    
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Étape 4: Créer les index pour la performance
CREATE INDEX IF NOT EXISTS idx_devis_user_id ON devis(user_id);
CREATE INDEX IF NOT EXISTS idx_devis_admin_id ON devis(admin_id);
CREATE INDEX IF NOT EXISTS idx_devis_type ON devis(type);
CREATE INDEX IF NOT EXISTS idx_devis_statut ON devis(statut);
CREATE INDEX IF NOT EXISTS idx_devis_numero ON devis(numero);
CREATE INDEX IF NOT EXISTS idx_devis_date_validite ON devis(date_validite);
CREATE INDEX IF NOT EXISTS idx_devis_created_at ON devis(created_at);

CREATE INDEX IF NOT EXISTS idx_factures_user_id ON factures(user_id);
CREATE INDEX IF NOT EXISTS idx_factures_admin_id ON factures(admin_id);
CREATE INDEX IF NOT EXISTS idx_factures_devis_id ON factures(devis_id);
CREATE INDEX IF NOT EXISTS idx_factures_numero ON factures(numero);
CREATE INDEX IF NOT EXISTS idx_factures_statut ON factures(statut);
CREATE INDEX IF NOT EXISTS idx_factures_date_echeance ON factures(date_echeance);
CREATE INDEX IF NOT EXISTS idx_factures_created_at ON factures(created_at);

-- Étape 5: Activer RLS (Row Level Security)
ALTER TABLE devis ENABLE ROW LEVEL SECURITY;
ALTER TABLE factures ENABLE ROW LEVEL SECURITY;

-- Étape 6: Créer les politiques de sécurité

-- Politiques pour la table devis
-- Users can view their own devis, admins can see all
CREATE POLICY "Users can view their own devis" ON devis
    FOR SELECT TO authenticated
    USING (
        auth.uid()::text = user_id::text OR 
        EXISTS (SELECT 1 FROM users WHERE id = auth.uid()::bigint AND role = 'admin')
    );

-- Admins can manage all devis
CREATE POLICY "Admins can manage devis" ON devis
    FOR ALL TO authenticated
    USING (
        EXISTS (SELECT 1 FROM users WHERE id = auth.uid()::bigint AND role = 'admin')
    );

-- Users can update their devis status (accept/reject)
CREATE POLICY "Users can update devis status" ON devis
    FOR UPDATE TO authenticated
    USING (auth.uid()::text = user_id::text)
    WITH CHECK (auth.uid()::text = user_id::text);

-- Politiques pour la table factures
-- Users can view their own factures, admins can see all
CREATE POLICY "Users can view their own factures" ON factures
    FOR SELECT TO authenticated
    USING (
        auth.uid()::text = user_id::text OR 
        EXISTS (SELECT 1 FROM users WHERE id = auth.uid()::bigint AND role = 'admin')
    );

-- Admins can manage all factures
CREATE POLICY "Admins can manage factures" ON factures
    FOR ALL TO authenticated
    USING (
        EXISTS (SELECT 1 FROM users WHERE id = auth.uid()::bigint AND role = 'admin')
    );

-- Étape 7: Créer les triggers pour updated_at

-- Vérifier si la fonction existe déjà, sinon la créer
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Créer les triggers
CREATE TRIGGER update_devis_updated_at BEFORE UPDATE ON devis
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_factures_updated_at BEFORE UPDATE ON factures
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- Étape 8: Créer les fonctions métier

-- Fonction pour générer les numéros de devis
CREATE OR REPLACE FUNCTION generate_devis_number()
RETURNS TEXT AS $$
DECLARE
    year_suffix TEXT;
    count_devis INTEGER;
    new_number TEXT;
BEGIN
    -- Get current year suffix (last 2 digits)
    year_suffix := EXTRACT(YEAR FROM NOW())::TEXT;
    year_suffix := RIGHT(year_suffix, 2);
    
    -- Count existing devis for this year
    SELECT COUNT(*) INTO count_devis 
    FROM devis 
    WHERE numero LIKE 'DV' || year_suffix || '%';
    
    -- Generate new number
    new_number := 'DV' || year_suffix || LPAD((count_devis + 1)::TEXT, 4, '0');
    
    RETURN new_number;
END;
$$ LANGUAGE plpgsql;

-- Fonction pour générer les numéros de facture
CREATE OR REPLACE FUNCTION generate_facture_number()
RETURNS TEXT AS $$
DECLARE
    year_suffix TEXT;
    count_factures INTEGER;
    new_number TEXT;
BEGIN
    -- Get current year suffix (last 2 digits)
    year_suffix := EXTRACT(YEAR FROM NOW())::TEXT;
    year_suffix := RIGHT(year_suffix, 2);
    
    -- Count existing factures for this year
    SELECT COUNT(*) INTO count_factures 
    FROM factures 
    WHERE numero LIKE 'FA' || year_suffix || '%';
    
    -- Generate new number
    new_number := 'FA' || year_suffix || LPAD((count_factures + 1)::TEXT, 4, '0');
    
    RETURN new_number;
END;
$$ LANGUAGE plpgsql;

-- Étape 9: Ajouter les commentaires pour la documentation
COMMENT ON TABLE devis IS 'Table storing client quotes and estimates';
COMMENT ON TABLE factures IS 'Table storing invoices and billing information';

COMMENT ON COLUMN devis.type IS 'Type of quote: services_carte, pack_landing, or devis_libre';
COMMENT ON COLUMN devis.statut IS 'Quote status: brouillon, envoye, accepte, refuse, expire';
COMMENT ON COLUMN devis.services IS 'JSON array of selected services';
COMMENT ON COLUMN devis.prix_base IS 'Base price before adjustments';
COMMENT ON COLUMN devis.ajustement_complexite IS 'Price adjustment for complexity (can be negative)';
COMMENT ON COLUMN devis.remise_pourcentage IS 'Discount percentage applied';

COMMENT ON COLUMN factures.statut IS 'Invoice status: brouillon, envoyee, payee, en_retard, annulee';
COMMENT ON COLUMN factures.services IS 'JSON array of invoiced services (nullable)';
COMMENT ON COLUMN factures.devis_id IS 'Reference to the quote this invoice is based on';
COMMENT ON COLUMN factures.methode_paiement IS 'Payment method used';

-- ============================================================================
-- VERIFICATION DES TABLES CRÉÉES
-- ============================================================================

-- Vérifier que les tables ont été créées
SELECT 
    schemaname,
    tablename,
    tableowner
FROM pg_tables 
WHERE tablename IN ('devis', 'factures')
ORDER BY tablename;

-- Vérifier les colonnes de la table devis
SELECT 
    column_name,
    data_type,
    is_nullable,
    column_default
FROM information_schema.columns 
WHERE table_name = 'devis'
ORDER BY ordinal_position;

-- Vérifier les colonnes de la table factures
SELECT 
    column_name,
    data_type,
    is_nullable,
    column_default
FROM information_schema.columns 
WHERE table_name = 'factures'
ORDER BY ordinal_position;

-- ============================================================================
-- MESSAGE DE SUCCÈS
-- ============================================================================

DO $$
BEGIN
    RAISE NOTICE '✅ Migration terminée avec succès !';
    RAISE NOTICE '📋 Tables créées : devis, factures';
    RAISE NOTICE '🔍 Index de performance ajoutés';
    RAISE NOTICE '🔒 Politiques RLS configurées';
    RAISE NOTICE '⚡ Triggers et fonctions métier créés';
    RAISE NOTICE '';
    RAISE NOTICE '📝 Prochaines étapes :';
    RAISE NOTICE '1. Vérifier les tables dans l''interface Supabase';
    RAISE NOTICE '2. Tester les fonctions generate_devis_number() et generate_facture_number()';
    RAISE NOTICE '3. Mettre à jour la configuration Laravel si nécessaire';
END $$; 