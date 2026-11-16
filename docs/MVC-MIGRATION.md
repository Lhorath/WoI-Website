# MVC Migration — Phase 1

## Deployment
The repository root is the web root and is intended to deploy directly to Hostinger public_html. The root .htaccess denies HTTP access to application internals and runtime data.

## Implemented foundation
- Native PHP front controller at root index.php.
- Dependency-free Environment, Router, Application, Controller, Model and View classes.
- Explicit route registration in routes/web.php.
- Legacy controller adapters for homepage, informational pages, account tools, status, voting, donations and GM tools.
- Original homepage source copied byte-for-byte to app/Legacy/Pages/home.php.
- Existing $config keys retained; deployment-specific DB, remote-admin and PayPal values now come from .env.
- Existing endpoints, assets, third-party applications and legacy page scripts remain in their original locations.

## Compatibility strategy
Legacy scripts are included from their original directories so relative include behavior is retained as far as possible. The router accepts all existing HTTP methods for legacy adapters and maps /online/{server} to the old online.php svr parameter.

Physical legacy PHP files continue to work directly. Clean URLs are aliases to those same scripts, not replacements for their business logic.

## Deferred work
Forums, wowhead, tournament, php callbacks and gm/old remain untouched. Shared header/navbar/footer extraction and movement of legacy function libraries are deferred until include dependencies and output are audited.

## Hostinger setup
1. Copy .env.example to .env in the repository root.
2. Enter the actual MySQL hostname, username and password.
3. Configure remote-admin and PayPal values if used.
4. Confirm PHP version and rewrite support.
5. Test in staging before switching production traffic.

## Regression requirements
- No SQL query text or SQL parameters changed.
- No legacy function body, name, signature or return contract changed.
- No database schema, table or data changes.
- No changes to authentication, session behavior, payment processing, voting or GM authorization.
- Test old and clean URLs, GET/POST behavior, form actions, redirects, cookies, assets and error pages.
- Compare homepage output and test database-backed pages using staging credentials.

## Security
Credentials committed before this migration remain in Git history even after their values are removed from the current settings file. Rotate affected database, remote-administration and PayPal credentials before production deployment.
