# Wikonia-Cockpit DEV Setup

Dies ist das lokale Entwicklungssetup für Wikonia, basierend auf Laravel, Filament und Docker.

## 📦 Systemvoraussetzungen

- Docker & Docker Compose
- Keine weiteren lokalen Installationen nötig

## 🚀 Starten (empfohlen)

```bash
./start.sh
```

→ Baut Container, führt Migrations + Seeds aus, startet App.

## 🌐 Zugriff

| Dienst         | URL                   |
|----------------|------------------------|
| Laravel App    | http://localhost:8081  |
| Adminpanel     | http://localhost:8081/admin |
| phpMyAdmin     | http://localhost:8082  |

## 🔐 Login

- **E-Mail:** admin@example.com
- **Passwort:** geheim (manuell gesetzt nach Setup)

## 🗃️ Datenbank

> Achtung die hier eingetragenen Datenbankdaten gelten ausschließlich für die Dev-Umgenung im Docker-Container
> Für eine Produktivnutzung **unbedingt** das Passowrt anpassen!

- Container: `wikonia-db` (MariaDB 10.5)
- User: `root`, Passwort: `root`
- Daten persistent via Volume `dbdata`

## 🧼 Reset (optional)

```bash
docker compose down -v
```

Löscht alle Daten – nicht einfach so benutzen!

---

_Made by ChatGPT für Notfälle und Nervenzusammenbrüche™_
