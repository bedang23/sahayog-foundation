# Sahayog Foundation (Laravel + Blade)

NGO website with:
- Public pages (`/`, `/about`, `/programs`, `/donate`, `/contact`, `/gallery`)
- DB-driven content (`pages`, `media`)
- Admin CMS (`/admin`) with page-wise text/image/SEO editing
- Session auth (single seeded admin user, no registration)

## Quick Start (MySQL)

1. Set DB credentials in `.env` (defaults already set for local MySQL):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sahayog
DB_USERNAME=root
DB_PASSWORD=
```

2. Run:

```bash
composer install
./scripts/setup-local.sh
php artisan serve
```

Admin credentials:
- Email: `admin@sahayog.com`
- Password: `password123`

## What `setup-local.sh` does

- validates PHP and app key
- validates MySQL PDO extension
- auto-creates database from `.env` credentials
- runs `php artisan migrate --seed`
- runs `php artisan storage:link`
- optimizes Laravel caches

## Optional SQLite

If you want SQLite instead, set:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

and ensure PHP has `pdo_sqlite` + `sqlite3`.

## Main Routes

- Public: `/`, `/about`, `/programs`, `/donate`, `/contact`, `/gallery`
- Auth: `/login`, `POST /login`, `POST /logout`
- Admin: `/admin`, `/admin/pages/{slug}/edit`
