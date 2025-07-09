-- ============================================================================
-- MIGRATION SUPABASE CLOUD - DEVIS ET FACTURES
-- Version optimisée pour Supabase Cloud (évite les problèmes RLS)
-- ============================================================================

-- Étape 1: Ajouter les champs devis à la table users
ALTER TABLE public.users ADD COLUMN IF NOT EXISTS devis_services JSONB;
ALTER TABLE public.users ADD COLUMN IF NOT EXISTS devis_nb_individus VARCHAR(255);
ALTER TABLE public.users ADD COLUMN IF NOT EXISTS devis_nb_variables VARCHAR(255);
ALTER TABLE public.users ADD COLUMN IF NOT EXISTS devis_delais VARCHAR(255);
ALTER TABLE public.users ADD COLUMN IF NOT EXISTS devis_remarques TEXT;

-- Étape 2: Créer la table devis
CREATE TABLE IF NOT EXISTS public.devis (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    admin_id BIGINT NOT NULL,
    
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
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    
    -- Foreign key constraints
    CONSTRAINT fk_devis_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_devis_admin FOREIGN KEY (admin_id) REFERENCES public.users(id) ON DELETE CASCADE
);

-- Étape 3: Créer la table factures
CREATE TABLE IF NOT EXISTS public.factures (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    admin_id BIGINT NOT NULL,
    devis_id BIGINT,
    
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
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    
    -- Foreign key constraints
    CONSTRAINT fk_factures_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_factures_admin FOREIGN KEY (admin_id) REFERENCES public.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_factures_devis FOREIGN KEY (devis_id) REFERENCES public.devis(id) ON DELETE SET NULL
);

-- Étape 4: Créer les index pour la performance
CREATE INDEX IF NOT EXISTS idx_devis_user_id ON public.devis(user_id);
CREATE INDEX IF NOT EXISTS idx_devis_admin_id ON public.devis(admin_id);
CREATE INDEX IF NOT EXISTS idx_devis_type ON public.devis(type);
CREATE INDEX IF NOT EXISTS idx_devis_statut ON public.devis(statut);
CREATE INDEX IF NOT EXISTS idx_devis_numero ON public.devis(numero);
CREATE INDEX IF NOT EXISTS idx_devis_date_validite ON public.devis(date_validite);
CREATE INDEX IF NOT EXISTS idx_devis_created_at ON public.devis(created_at);

CREATE INDEX IF NOT EXISTS idx_factures_user_id ON public.factures(user_id);
CREATE INDEX IF NOT EXISTS idx_factures_admin_id ON public.factures(admin_id);
CREATE INDEX IF NOT EXISTS idx_factures_devis_id ON public.factures(devis_id);
CREATE INDEX IF NOT EXISTS idx_factures_numero ON public.factures(numero);
CREATE INDEX IF NOT EXISTS idx_factures_statut ON public.factures(statut);
CREATE INDEX IF NOT EXISTS idx_factures_date_echeance ON public.factures(date_echeance);
CREATE INDEX IF NOT EXISTS idx_factures_created_at ON public.factures(created_at);

-- Étape 5: Créer les fonctions métier

-- Fonction pour générer les numéros de devis
CREATE OR REPLACE FUNCTION public.generate_devis_number()
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
    FROM public.devis 
    WHERE numero LIKE 'DV' || year_suffix || '%';
    
    -- Generate new number
    new_number := 'DV' || year_suffix || LPAD((count_devis + 1)::TEXT, 4, '0');
    
    RETURN new_number;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- Fonction pour générer les numéros de facture
CREATE OR REPLACE FUNCTION public.generate_facture_number()
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
    FROM public.factures 
    WHERE numero LIKE 'FA' || year_suffix || '%';
    
    -- Generate new number
    new_number := 'FA' || year_suffix || LPAD((count_factures + 1)::TEXT, 4, '0');
    
    RETURN new_number;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- Étape 6: Créer les triggers pour updated_at

-- Fonction trigger pour updated_at (si elle n'existe pas déjà)
CREATE OR REPLACE FUNCTION public.update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Créer les triggers
DROP TRIGGER IF EXISTS update_devis_updated_at ON public.devis;
CREATE TRIGGER update_devis_updated_at 
    BEFORE UPDATE ON public.devis
    FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

DROP TRIGGER IF EXISTS update_factures_updated_at ON public.factures;
CREATE TRIGGER update_factures_updated_at 
    BEFORE UPDATE ON public.factures
    FOR EACH ROW EXECUTE FUNCTION public.update_updated_at_column();

-- Étape 7: Activer RLS et créer les politiques (version simplifiée)
ALTER TABLE public.devis ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.factures ENABLE ROW LEVEL SECURITY;

-- Politique temporaire pour permettre l'accès complet (à affiner plus tard)
DROP POLICY IF EXISTS "Enable read access for all authenticated users" ON public.devis;
CREATE POLICY "Enable read access for all authenticated users" 
ON public.devis FOR SELECT 
TO authenticated 
USING (true);

DROP POLICY IF EXISTS "Enable insert access for all authenticated users" ON public.devis;
CREATE POLICY "Enable insert access for all authenticated users" 
ON public.devis FOR INSERT 
TO authenticated 
WITH CHECK (true);

DROP POLICY IF EXISTS "Enable update access for all authenticated users" ON public.devis;
CREATE POLICY "Enable update access for all authenticated users" 
ON public.devis FOR UPDATE 
TO authenticated 
USING (true) WITH CHECK (true);

DROP POLICY IF EXISTS "Enable delete access for all authenticated users" ON public.devis;
CREATE POLICY "Enable delete access for all authenticated users" 
ON public.devis FOR DELETE 
TO authenticated 
USING (true);

-- Mêmes politiques pour factures
DROP POLICY IF EXISTS "Enable read access for all authenticated users" ON public.factures;
CREATE POLICY "Enable read access for all authenticated users" 
ON public.factures FOR SELECT 
TO authenticated 
USING (true);

DROP POLICY IF EXISTS "Enable insert access for all authenticated users" ON public.factures;
CREATE POLICY "Enable insert access for all authenticated users" 
ON public.factures FOR INSERT 
TO authenticated 
WITH CHECK (true);

DROP POLICY IF EXISTS "Enable update access for all authenticated users" ON public.factures;
CREATE POLICY "Enable update access for all authenticated users" 
ON public.factures FOR UPDATE 
TO authenticated 
USING (true) WITH CHECK (true);

DROP POLICY IF EXISTS "Enable delete access for all authenticated users" ON public.factures;
CREATE POLICY "Enable delete access for all authenticated users" 
ON public.factures FOR DELETE 
TO authenticated 
USING (true);

-- Étape 8: Ajouter les commentaires pour la documentation
COMMENT ON TABLE public.devis IS 'Table storing client quotes and estimates';
COMMENT ON TABLE public.factures IS 'Table storing invoices and billing information';

COMMENT ON COLUMN public.devis.type IS 'Type of quote: services_carte, pack_landing, or devis_libre';
COMMENT ON COLUMN public.devis.statut IS 'Quote status: brouillon, envoye, accepte, refuse, expire';
COMMENT ON COLUMN public.devis.services IS 'JSON array of selected services';
COMMENT ON COLUMN public.devis.prix_base IS 'Base price before adjustments';
COMMENT ON COLUMN public.devis.ajustement_complexite IS 'Price adjustment for complexity (can be negative)';
COMMENT ON COLUMN public.devis.remise_pourcentage IS 'Discount percentage applied';

COMMENT ON COLUMN public.factures.statut IS 'Invoice status: brouillon, envoyee, payee, en_retard, annulee';
COMMENT ON COLUMN public.factures.services IS 'JSON array of invoiced services (nullable)';
COMMENT ON COLUMN public.factures.devis_id IS 'Reference to the quote this invoice is based on';
COMMENT ON COLUMN public.factures.methode_paiement IS 'Payment method used';

-- Étape 9: Tests de validation

-- Test des fonctions de génération de numéros
DO $$
DECLARE
    test_devis_num TEXT;
    test_facture_num TEXT;
BEGIN
    -- Tester la génération de numéros
    SELECT public.generate_devis_number() INTO test_devis_num;
    SELECT public.generate_facture_number() INTO test_facture_num;
    
    RAISE NOTICE '🧪 Test génération numéros:';
    RAISE NOTICE '   Devis: %', test_devis_num;
    RAISE NOTICE '   Facture: %', test_facture_num;
END $$;

-- Vérification des tables créées
DO $$
DECLARE
    devis_count INTEGER;
    factures_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO devis_count FROM information_schema.tables WHERE table_name = 'devis' AND table_schema = 'public';
    SELECT COUNT(*) INTO factures_count FROM information_schema.tables WHERE table_name = 'factures' AND table_schema = 'public';
    
    RAISE NOTICE '📊 Vérification des tables:';
    RAISE NOTICE '   Table devis: % (1 = OK)', devis_count;
    RAISE NOTICE '   Table factures: % (1 = OK)', factures_count;
END $$;

-- Message de succès final
DO $$
BEGIN
    RAISE NOTICE '';
    RAISE NOTICE '🎉 =====================================================';
    RAISE NOTICE '✅ MIGRATION SUPABASE CLOUD TERMINÉE AVEC SUCCÈS !';
    RAISE NOTICE '🎉 =====================================================';
    RAISE NOTICE '';
    RAISE NOTICE '📋 Tables créées :';
    RAISE NOTICE '   • public.devis (avec 33 colonnes)';
    RAISE NOTICE '   • public.factures (avec 27 colonnes)';
    RAISE NOTICE '   • Champs ajoutés à public.users';
    RAISE NOTICE '';
    RAISE NOTICE '🔍 Fonctionnalités ajoutées :';
    RAISE NOTICE '   • Index de performance optimisés';
    RAISE NOTICE '   • Fonctions generate_devis_number() et generate_facture_number()';
    RAISE NOTICE '   • Triggers pour updated_at automatique';
    RAISE NOTICE '   • Politiques RLS configurées';
    RAISE NOTICE '   • Contraintes et validations';
    RAISE NOTICE '';
    RAISE NOTICE '🚀 Prochaines étapes :';
    RAISE NOTICE '   1. Tester les fonctions dans l''onglet SQL Editor';
    RAISE NOTICE '   2. Vérifier les tables dans Table Editor';
    RAISE NOTICE '   3. Configurer Laravel pour utiliser les nouvelles tables';
    RAISE NOTICE '   4. Ajuster les politiques RLS selon vos besoins';
    RAISE NOTICE '';
END $$; 