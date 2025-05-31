# 🚀 Onboarding für Entwickler:innen – Wikonia Cockpit

Willkommen im Wikonia Cockpit-Projekt!  
Diese Anleitung hilft dir beim Einstieg – von „ich hab das Repo geklont“ bis zum ersten Commit.

---

## 🧰 Voraussetzungen

- **PHP 8.4+** (im Docker-Setup bereits enthalten)
- **Docker + Docker Compose** (lokal installiert)
- **Node.js + npm** (nur bei lokalem Frontend-Setup nötig)
- **Zugang zu GitHub** mit Schreibrecht für dieses Repository

---

## 🧪 Projekt starten (DEV-Umgebung)

1. **Klonen**
   ```bash
   git clone https://github.com/mumibo-de/wikonia-cockpit.git
   cd wikonia-cockpit
   ```

2. **Starten**
   ```bash
   ./start.sh
   ```

3. **Zugriff**
   - App: http://localhost:8081
   - Adminpanel: http://localhost:8081/admin
   - phpMyAdmin: http://localhost:8082

4. **Login**
   - E-Mail: `admin@example.com`
   - Passwort: `geheim` (nach Setup setzen)

---

## 🧼 Arbeitsweise

- Feature-/Bugfix-Branches verwenden
- PRs mit sinnvoller Beschreibung erstellen
- Labels wie `type:` und `prio:` setzen
- Strukturierte Commits (`feat:`, `fix:`, `refactor:` etc.)

---

## 🧠 Nützliche Einstiegspunkte

| Bereich              | Datei / Pfad                    |
|----------------------|----------------------------------|
| Architekturüberblick | `docs/architecture.md`           |
| Konventionen         | `docs/conventions.md`            |
| Docker Setup         | `docs/README.dev.md`             |
| Labelübersicht       | `.github/LABELS.md`              |
| PR-Vorgaben          | `.github/PULL_REQUEST_TEMPLATE.md` |

---

## 🆘 Hilfe & Kontakt

Fragen, Probleme oder Feedback?

- Interne Rückfragen: Direkt im PR oder per Kommentar im passenden Issue
- Allgemeine Themen: [support.wikonia.net](https://support.wikonia.net)

---

_Mit Klarheit ins Projekt, mit Struktur zum Code_
