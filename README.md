# World of Immortality Website

Incremental migration to a native-PHP MVC architecture for deployment at the website root on Hostinger shared hosting.

## Requirements
- PHP 7.4+ for the MVC foundation; test legacy code against the selected Hostinger PHP version.
- Existing MySQL/MariaDB databases.
- Apache-compatible rewrite support.
- No Node.js or mandatory Composer dependency.

## Configuration
1. Copy .env.example to .env.
2. Set the Hostinger MySQL host, database username and password.
3. Confirm database names and remote administration settings.
4. Configure PayPal settings if donations are enabled.
5. Never commit .env.

The legacy settings file reads deployment secrets from the environment while preserving the existing global $config keys.

## Deployment
The repository root is the web root (normally public_html). The root .htaccess denies direct HTTP access to app, config, routes, storage, utility cache/log directories and include-only utility PHP files.

Existing public PHP endpoints and static assets remain at their original paths. Clean routes are adapters to the same legacy scripts during Phase 1.

See docs/MVC-MIGRATION.md and docs/LEGACY-FILE-MAP.md.

## Security
Credentials committed before this migration remain in Git history. Rotate database, remote administration and PayPal credentials before production deployment.
