#!/bin/bash

echo "📦 Starte Wikonia DEV Umgebung..."

# Sauber beenden (ohne Volume-Löschung!)
docker compose down

# Container bauen (Dockerfile muss vorhanden sein)
docker compose build

# Container starten
docker compose up -d

# Warten, bis DB verfügbar ist
echo "⏳ Warte auf MariaDB..."
sleep 10

# Migrations + Seeder
echo "🧱 Führe Datenbank-Migration durch..."
docker exec wikonia-app php artisan migrate:fresh --seed

# Admin-User erstellen
echo "👤 Erstelle Filament-Admin-Benutzer..."
docker exec -it wikonia-app php artisan make:filament-user

echo "✅ Setup abgeschlossen! Öffne http://localhost:8081/admin"