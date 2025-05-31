# 🏗️ Architekturübersicht – Wikonia Cockpit

Hier findest du einen Überblick über die grundlegende Struktur, Module und Logik dieses Projekts.

---

## 📦 Hauptkomponenten

| Modul               | Aufgabe                                       |
|---------------------|-----------------------------------------------|
| `Customer`           | Verwaltung von Kundendaten, Adressen, USt-ID |
| `Wiki`               | Domain, Speicher, Provisionierung            |
| `LegalAgreement`     | AGB, Datenschutz, Zustimmung                 |
| `Invoices`           | Rechnungserstellung, PDF-Export, API         |
| `AdminPanel`         | UI mit Filament, Rechte, Logs                |

---

## 🧭 Datenflüsse

- **User** → über das Kundenportal → `Customer`-Modell
- **Wiki-Antrag** → erzeugt Wiki-Eintrag + Provisionierungsticket
- **Zustimmungen** → über `LegalAgreement`-Tabelle mit Versionierung
- **Rechnungen** → aus Bestellung → PDF → Speicherung bei Kunde

---

## 📊 Datenbankstruktur (Kurzfassung)

```plaintext
customers → (1:n) → wikis
          → (1:n) → legal_agreements
          → (1:n) → invoices
