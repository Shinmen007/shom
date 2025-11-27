#!/usr/bin/env bash

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"

HOST="${HOST:-127.0.0.1}"
PORT="${PORT:-8000}"

DB_FILE="${PROJECT_ROOT}/database/database.sqlite"
mkdir -p "$(dirname "${DB_FILE}")"
if [[ ! -f "${DB_FILE}" ]]; then
  touch "${DB_FILE}"
  echo "Created database file at ${DB_FILE}" >&2
fi

echo "Starting PHP development server on ${HOST}:${PORT}..."
exec php -S "${HOST}:${PORT}" -t "${PROJECT_ROOT}/public"
