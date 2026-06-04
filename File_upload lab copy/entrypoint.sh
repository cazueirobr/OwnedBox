#!/bin/sh
set -eu

FLAG_VALUE="${FLAG_VALUE:-ACT{file-upload-rce-lab}}"
UPLOAD_DIR="/var/www/html/uploads"

mkdir -p "$UPLOAD_DIR"
printf '%s\n' "$FLAG_VALUE" > "$UPLOAD_DIR/flag.txt"
chown -R www-data:www-data "$UPLOAD_DIR"
chmod -R 755 "$UPLOAD_DIR"

exec apache2-foreground
