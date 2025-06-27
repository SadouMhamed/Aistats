# Supabase Local Development Setup

## 🚀 Getting Started

Your Supabase local development environment is now running! Here's everything you need to know:

## 📋 Service URLs

| Service      | URL                                                       | Description                 |
| ------------ | --------------------------------------------------------- | --------------------------- |
| **API**      | `http://127.0.0.1:54321`                                  | Main Supabase API endpoint  |
| **GraphQL**  | `http://127.0.0.1:54321/graphql/v1`                       | GraphQL endpoint            |
| **Storage**  | `http://127.0.0.1:54321/storage/v1/s3`                    | File storage API            |
| **Database** | `postgresql://postgres:postgres@127.0.0.1:54322/postgres` | PostgreSQL database         |
| **Studio**   | `http://127.0.0.1:54323`                                  | Supabase Dashboard (Web UI) |
| **Inbucket** | `http://127.0.0.1:54324`                                  | Email testing interface     |

## 🔑 API Keys

```env
# Public anon key (safe for client-side use)
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6ImFub24iLCJleHAiOjE5ODM4MTI5OTZ9.CRXP1A7WOeoJeXxjNni43kdQwgnWNReilDMblYTn_I0

# Service role key (server-side only - keep secret!)
SUPABASE_SERVICE_ROLE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImV4cCI6MTk4MzgxMjk5Nn0.EGIM96RAZx35lJzdJsyH-qQwv8Hdp7fsn3W0YpN81IU

# JWT Secret
SUPABASE_JWT_SECRET=super-secret-jwt-token-with-at-least-32-characters-long
```

## 🔧 Laravel Integration

### 1. Add to your `.env` file:

```env
# Supabase Configuration
SUPABASE_URL=http://127.0.0.1:54321
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6ImFub24iLCJleHAiOjE5ODM4MTI5OTZ9.CRXP1A7WOeoJeXxjNni43kdQwgnWNReilDMblYTn_I0
SUPABASE_SERVICE_ROLE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImV4cCI6MTk4MzgxMjk5Nn0.EGIM96RAZx35lJzdJsyH-qQwv8Hdp7fsn3W0YpN81IU

# Database Configuration (if you want to use Supabase as your main DB)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=54322
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### 2. Install Supabase PHP Client (optional):

```bash
composer require supabase/supabase-php
```

## 🎯 Common Commands

```bash
# Start Supabase (run this from the project root)
supabase start

# Stop Supabase
supabase stop

# Reset database
supabase db reset

# View logs
supabase logs

# Check status
supabase status
```

## 📊 Database Management

1. **Access Supabase Studio**: Open `http://127.0.0.1:54323` in your browser
2. **Direct Database Access**: Use any PostgreSQL client with the connection details above
3. **Migrations**: Place SQL files in `supabase/migrations/` and run `supabase db reset`

## 📧 Email Testing

Visit `http://127.0.0.1:54324` to see all emails sent by your application during development.

## 🚦 Next Steps

1. **Explore Supabase Studio**: Visit the dashboard to create tables, set up auth, etc.
2. **Create your first table**: Use the SQL editor or table interface
3. **Set up Authentication**: Configure auth providers in the Auth section
4. **Upload files**: Test the Storage functionality
5. **Write SQL migrations**: Create `.sql` files in `supabase/migrations/`

## 🛠️ Troubleshooting

-   **Docker not running**: Make sure Docker Desktop is running
-   **Port conflicts**: Check if ports 54321-54324 are available
-   **Reset everything**: Run `supabase stop` then `supabase start`

## 📚 Useful Resources

-   [Supabase Documentation](https://supabase.com/docs)
-   [Supabase PHP Client](https://github.com/supabase-community/supabase-php)
-   [Laravel + Supabase Tutorial](https://supabase.com/docs/guides/getting-started/tutorials/with-laravel)
