#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

env_get() {
  local key="$1"
  local default_value="${2:-}"
  local raw
  raw="$(grep -E "^${key}=" .env | tail -n 1 | cut -d '=' -f2- || true)"
  if [[ -z "$raw" ]]; then
    echo "$default_value"
    return
  fi
  raw="${raw%\"}"
  raw="${raw#\"}"
  raw="${raw%\'}"
  raw="${raw#\'}"
  echo "$raw"
}

echo "[1/8] Checking PHP..."
php -v >/dev/null

if [[ ! -f .env ]]; then
  echo "[2/8] Creating .env from .env.example"
  cp .env.example .env
else
  echo "[2/8] .env already exists (keeping current values)"
fi

if ! grep -q '^APP_KEY=base64:' .env; then
  echo "[3/8] Generating APP_KEY"
  php artisan key:generate --ansi
else
  echo "[3/8] APP_KEY already present"
fi

if ! grep -q '^DB_CONNECTION=' .env; then
  echo "DB_CONNECTION=mysql" >> .env
fi

DB_CONNECTION="$(env_get DB_CONNECTION mysql)"

if [[ "$DB_CONNECTION" == "mysql" ]]; then
  echo "[4/8] Preparing MySQL connection"

  if ! php -m | grep -qi '^pdo_mysql$'; then
    echo ""
    echo "ERROR: DB_CONNECTION=mysql but pdo_mysql extension is not enabled."
    exit 1
  fi

  DB_HOST="$(env_get DB_HOST localhost)"
  DB_PORT="$(env_get DB_PORT 3306)"
  DB_DATABASE="$(env_get DB_DATABASE sahayog)"
  DB_USERNAME="$(env_get DB_USERNAME root)"
  DB_PASSWORD="$(env_get DB_PASSWORD '')"

  if ! command -v mysql >/dev/null 2>&1; then
    echo ""
    echo "ERROR: mysql client not found. Install MySQL client tools and retry."
    exit 1
  fi

  MYSQL_PASSWORD_ARGS=()
  if [[ -n "$DB_PASSWORD" ]]; then
    MYSQL_PASSWORD_ARGS+=("-p${DB_PASSWORD}")
  fi

  if ! mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" "${MYSQL_PASSWORD_ARGS[@]}" -e "SELECT 1;" >/dev/null 2>&1; then
    echo ""
    echo "ERROR: Could not connect to MySQL server with current .env credentials."
    echo "Check DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env"
    exit 1
  fi

  if ! mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" "${MYSQL_PASSWORD_ARGS[@]}" -e "CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >/dev/null 2>&1; then
    echo "WARN: Could not create database '${DB_DATABASE}' (permission denied or restricted)."
    echo "      Continuing and checking if the database already exists and is accessible."
  fi

  if ! mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" "${MYSQL_PASSWORD_ARGS[@]}" "$DB_DATABASE" -e "SELECT 1;" >/dev/null 2>&1; then
    echo ""
    echo "ERROR: Database '${DB_DATABASE}' is not accessible by user '${DB_USERNAME}'."
    echo "Ensure the database exists and the user has privileges on it."
    exit 1
  fi

elif [[ "$DB_CONNECTION" == "sqlite" ]]; then
  echo "[4/8] Preparing SQLite connection"

  if ! php -m | grep -qi '^pdo_sqlite$'; then
    echo ""
    echo "ERROR: DB_CONNECTION=sqlite but pdo_sqlite extension is not enabled."
    echo "Enable sqlite driver OR switch .env to MySQL."
    exit 1
  fi

  mkdir -p database
  SQLITE_DB_PATH="$(env_get DB_DATABASE database/database.sqlite)"
  if [[ ! -f "$SQLITE_DB_PATH" ]]; then
    touch "$SQLITE_DB_PATH"
  fi
else
  echo ""
  echo "ERROR: Unsupported DB_CONNECTION=${DB_CONNECTION}. Use mysql or sqlite."
  exit 1
fi

echo "[5/8] Clearing config cache"
php artisan optimize:clear --ansi

echo "[6/8] Running migrations + seeders"
php artisan migrate --seed --ansi

echo "[7/8] Linking storage"
php artisan storage:link --ansi || true

echo "[8/8] Optimizing app"
php artisan optimize --ansi

echo ""
echo "Setup complete."
echo "Admin login: admin@sahayog.com / password123"
echo "Run: php artisan serve"
