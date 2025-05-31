# 🏗️ Architekturübersicht – Wikonia Cockpit

Hier findest du einen Überblick über die grundlegende Struktur, Module und Logik dieses Projekts.

---

## 📦 Hauptkomponenten

| Modul            | Aufgabe                                       |
|------------------|-----------------------------------------------|
| `Customer`        | Verwaltung von Kundendaten, Adressen, USt-ID |
| `Wiki`            | Domain, Speicher, Provisionierung            |
| `LegalAgreement`  | AGB, Datenschutz, Zustimmung                 |
| `Invoices`        | Rechnungserstellung, PDF-Export, API         |
| `AdminPanel`      | UI mit Filament, Rechte, Logs                |

---

## 🧭 Datenflüsse

- **User** → über das Kundenportal → `Customer`-Modell
- **Wiki-Antrag** → erzeugt Wiki-Eintrag + Provisionierungsticket
- **Zustimmungen** → über `LegalAgreement`-Tabelle mit Versionierung
- **Rechnungen** → aus Bestellung → PDF → Speicherung bei Kunde

---

## 📊 Datenbankstruktur (Kurzfassung)

```
customers
├── wikis
├── legal_agreements
└── invoices
```

---

## 🛡️ Authentifizierung

- Aktuell Laravel `auth` mit klassischer `users`-Tabelle
- Zukünftig geplant: OAuth / Single Sign-On zu MediaWiki GlobalUsers
- Zentrale Verknüpfung via `user_links`-Tabelle

---

## 🔧 Provisionierungslogik (geplant)

```
1. Kunde bucht Paket
2. Admin prüft & gibt frei
3. Wiki wird eingerichtet (Datenbank, Domain, Rechte)
4. Kunde erhält Zugang + Bestätigung
```

---

## 🧩 Erweiterungen (Roadmap)

- Multi-Tenancy per Domain → vorbereitet
- API-Zugriffe & Webhooks
- Protokollierung via `spatie/laravel-activitylog`
- E-Mail-Monitoring und SMTP-Statusrückmeldung
