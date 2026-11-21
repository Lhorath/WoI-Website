# TrinityCore sample website

The homepage is a small MVC-style PHP scaffold with a sample realm landing page.
The existing registration form is available at `/register.php`.

## Website structure

- `index.php` - homepage entry point
- `app/controllers/` - request handling
- `app/models/` - sample homepage content
- `app/config/` - environment loading and database connections
- `app/views/` - page template and partials (`header`, `body`, `main`, `aside`, and `footer`)
- `assets/css/` - site styles
- `assets/js/` - homepage image slider controls
- `assets/images/` - place images here
- `assets/icons/` - news post icons
- `register.php` - TrinityCore account registration
- `news.php` - news listing and individual article pages

## Setup

1. Edit `.env` and set the host, port, database name, user, and password for
   each database. The news pages use `WEB_DB_*` for `news_posts` and `AUTH_DB_*`
   to look up account usernames. Registration also uses the auth database.
2. Grant the web database user `SELECT` permission on `news_posts`. Grant the
   auth database user `SELECT` permission on `account`, plus `INSERT` and
   `SELECT` for registration.
3. Use PHP 8 or later with the `GMP`, `PDO MySQL`, `DOM`, and `SOAP` extensions enabled.
4. Ensure Apache allows `.htaccess` rules in this directory. The provided
   rule denies direct HTTP access to `.env`.
5. Serve the page over HTTPS for production use.

The news listing is available at `/news.php`; open an article at
`/news.php?id=<post-id>`. Article titles come from the `title` column. Store
icon filenames without their extension in `news_posts.icon`; icons are checked
in `assets/icons/` and `assets/images/icons/`. Supported image extensions are
listed in `assets/icons/README.txt`. Article HTML is sanitized to allow common formatting
tags and safe links before it is displayed.

The account table must be the one created by your TrinityCore auth database
migrations, with `username`, `salt`, and `verifier` columns. The SRP6 values
are written as 32-byte binary values. Usernames are uppercased before storage,
as expected by TrinityCore.

The homepage realm-status panel uses `REALM_1_IP` and `REALM_1_SOAP_*` to run
the `server info` command; the SOAP account must have administrator-level
command permissions.
XP and drop multipliers are read from the corresponding `RATE_1_XP_*` and
`RATE_1_DROP_*` environment variables. If the SOAP check fails, the panel
reports the realm as offline and marks the player count unavailable.
