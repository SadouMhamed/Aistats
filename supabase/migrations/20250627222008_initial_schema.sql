-- ============================================================================
-- INITIAL SCHEMA MIGRATION - CONVERTED FROM LARAVEL MIGRATIONS
-- This migration converts all existing Laravel migrations to Supabase format
-- ============================================================================

-- Create users table with all modifications from Laravel migrations
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nom VARCHAR(255),
    prenom VARCHAR(255), 
    profession VARCHAR(255),
    telephone VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP WITH TIME ZONE,
    role VARCHAR(255) DEFAULT 'user' NOT NULL,
    pack VARCHAR(255),
    meeting_preference VARCHAR(255),
    payment_preference VARCHAR(255),
    payment_status VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Create password_reset_tokens table
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE
);

-- Create sessions table
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

-- Create cache table
CREATE TABLE IF NOT EXISTS cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- Create cache_locks table
CREATE TABLE IF NOT EXISTS cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INTEGER NOT NULL
);

-- Create jobs table
CREATE TABLE IF NOT EXISTS jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INTEGER,
    available_at INTEGER NOT NULL,
    created_at INTEGER NOT NULL
);

-- Create job_batches table
CREATE TABLE IF NOT EXISTS job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT,
    cancelled_at INTEGER,
    created_at INTEGER NOT NULL,
    finished_at INTEGER
);

-- Create failed_jobs table
CREATE TABLE IF NOT EXISTS failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) UNIQUE NOT NULL,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Create files table
CREATE TABLE IF NOT EXISTS files (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    original_name VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    mime_type VARCHAR(255) NOT NULL,
    file_extension VARCHAR(255) NOT NULL,
    file_size BIGINT NOT NULL,
    status VARCHAR(255) DEFAULT 'uploaded' NOT NULL,
    description TEXT,
    metadata JSONB,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Create admin_user_files table
CREATE TABLE IF NOT EXISTS admin_user_files (
    id BIGSERIAL PRIMARY KEY,
    admin_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    original_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(255) NOT NULL,
    file_size BIGINT NOT NULL,
    message TEXT,
    is_read BOOLEAN DEFAULT FALSE NOT NULL,
    download_permission BOOLEAN DEFAULT FALSE NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- ============================================================================
-- INDEXES FOR PERFORMANCE
-- ============================================================================

-- Users table indexes
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);
CREATE INDEX IF NOT EXISTS idx_users_role ON users(role);
CREATE INDEX IF NOT EXISTS idx_users_pack ON users(pack);
CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at);

-- Sessions table indexes
CREATE INDEX IF NOT EXISTS idx_sessions_user_id ON sessions(user_id);
CREATE INDEX IF NOT EXISTS idx_sessions_last_activity ON sessions(last_activity);

-- Cache table indexes
CREATE INDEX IF NOT EXISTS idx_cache_expiration ON cache(expiration);

-- Jobs table indexes
CREATE INDEX IF NOT EXISTS idx_jobs_queue ON jobs(queue);
CREATE INDEX IF NOT EXISTS idx_jobs_reserved_at ON jobs(reserved_at);
CREATE INDEX IF NOT EXISTS idx_jobs_available_at ON jobs(available_at);

-- Files table indexes
CREATE INDEX IF NOT EXISTS idx_files_user_id ON files(user_id);
CREATE INDEX IF NOT EXISTS idx_files_status ON files(status);
CREATE INDEX IF NOT EXISTS idx_files_created_at ON files(created_at);
CREATE INDEX IF NOT EXISTS idx_files_file_extension ON files(file_extension);

-- Admin user files table indexes
CREATE INDEX IF NOT EXISTS idx_admin_user_files_admin_id ON admin_user_files(admin_id);
CREATE INDEX IF NOT EXISTS idx_admin_user_files_user_id ON admin_user_files(user_id);
CREATE INDEX IF NOT EXISTS idx_admin_user_files_is_read ON admin_user_files(is_read);
CREATE INDEX IF NOT EXISTS idx_admin_user_files_created_at ON admin_user_files(created_at);

-- ============================================================================
-- ROW LEVEL SECURITY (RLS) POLICIES
-- ============================================================================

-- Enable RLS on users table
ALTER TABLE users ENABLE ROW LEVEL SECURITY;

-- Allow authenticated users to view users table (simplified for now)
CREATE POLICY "Authenticated users can view users" ON users
    FOR SELECT TO authenticated
    USING (true);

-- Allow authenticated users to update users table (you can refine this later)
CREATE POLICY "Authenticated users can update users" ON users
    FOR UPDATE TO authenticated
    USING (true);

-- Enable RLS on files table
ALTER TABLE files ENABLE ROW LEVEL SECURITY;

-- Allow authenticated users to manage files (simplified for now)
CREATE POLICY "Authenticated users can manage files" ON files
    FOR ALL TO authenticated
    USING (true);

-- Enable RLS on admin_user_files table
ALTER TABLE admin_user_files ENABLE ROW LEVEL SECURITY;

-- Allow authenticated users to manage admin user files (simplified for now)
CREATE POLICY "Authenticated users can manage admin user files" ON admin_user_files
    FOR ALL TO authenticated
    USING (true);

-- ============================================================================
-- FUNCTIONS AND TRIGGERS FOR UPDATED_AT
-- ============================================================================

-- Create function to update updated_at timestamp
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ language 'plpgsql';

-- Create triggers for updated_at
CREATE TRIGGER update_users_updated_at BEFORE UPDATE ON users
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_files_updated_at BEFORE UPDATE ON files
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_admin_user_files_updated_at BEFORE UPDATE ON admin_user_files
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- ============================================================================
-- INITIAL DATA (OPTIONAL)
-- ============================================================================

-- Create an admin user (you can modify this or remove it)
INSERT INTO users (name, email, role, password, created_at, updated_at) 
VALUES (
    'Admin User', 
    'admin@example.com', 
    'admin', 
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: 'password'
    NOW(), 
    NOW()
) ON CONFLICT (email) DO NOTHING;
