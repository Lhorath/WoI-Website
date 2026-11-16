# MVC Migration — Phases 1 and 2

## Deployment
The repository root is the web root and is intended to deploy directly to Hostinger public_html. The root .htaccess denies HTTP access to application internals and runtime data.

## Phase 1 — MVC foundation
- Native PHP front controller at root index.php.
- Dependency-free Environment, Router, Application, Controller, Model and View classes.
- Explicit route registration in routes/web.php.
- Legacy controller adapters for homepage, informational pages, account tools, status, voting, donations and GM tools.
- Original homepage source copied byte-for-byte to app/Legacy/Pages/home.php.
- Existing $config keys retained; deployment-specific DB, remote-admin and PayPal values now come from .env.
- Existing endpoints, assets, third-party applications and legacy page scripts remain in their original locations.

## Phase 2 — Shared presentation layer
- Extracted the shared document header, navigation, title bar, user-information panel and footer into real PHP view templates under app/Views/layouts.
- Retained the existing Structure class and its public method names as a compatibility facade. Existing legacy pages can keep calling Header(), Top_Menu(), Title_Bar(), UserInfo() and Footer() while the actual markup is rendered by MVC views.
- Added a layout smoke test that exercises the compatibility facade without connecting to MySQL or changing session/authentication behavior.
- Corrected the malformed Community Forums anchor while extracting the navigation template.

## Compatibility strategy
Legacy scripts are included from their original directories so relative include behavior is retained as far as possible. The router accepts all existing HTTP methods for legacy adapters and maps /online/{server} to the old online.php svr parameter.

Physical legacy PHP files continue to work directly. Clean URLs are aliases to those same scripts, not replacements for their business logic. The shared presentation markup is now served from MVC views through the compatibility facade.

## Deferred work
- Convert individual page bodies into dedicated MVC views, beginning with the homepage as a controlled pilot.
- Introduce concrete model/repository classes only after auditing the existing database access functions.
- Migrate authentication, account, donation, voting and GM workflows only with dedicated regression coverage.
- Forums, wowhead, tournament, php callbacks and gm/old remain untouched.
- Hostinger staging tests remain necessary for real database-backed behavior, sessions, payment callbacks and rewrite configuration.

## Hostinger setup
1. Copy .env.example to .env in the repository root.
2. Enter the actual MySQL hostname, username and password.
3. Configure remote-admin and PayPal values if used.
4. Confirm PHP version and rewrite support.
5. Test in staging before switching production traffic.

## Regression requirements
- No SQL query text or SQL parameters changed.
- No database schema, table or data changes.
- No changes to authentication, session behavior, payment processing, voting or GM authorization.
- Test old and clean URLs, GET/POST behavior, form actions, redirects, cookies, assets and error pages.
- Compare homepage output and test database-backed pages using staging credentials.

## Security
Credentials committed before this migration remain in Git history even after their values are removed from the current settings file. Rotate affected database, remote-administration and PayPal credentials before production deployment.
