# 📘 Coding & Projektkonventionen – Wikonia Cockpit

Diese Datei dokumentiert interne Regeln, Namenskonventionen und Projektstandards.

---

## 📁 Ordnerstruktur (App)

| Ordner             | Zweck                              |
|--------------------|-------------------------------------|
| `app/Models/`       | Datenmodelle mit Eloquent           |
| `app/Filament/`     | Admin UI via Filament Panels        |
| `app/Http/Controllers/` | REST-Controller, APIs           |
| `resources/views/`  | Blade-Templates (z. B. Mail, Sonderseiten) |

---

## 🧠 Namenskonventionen

- Klassen in `PascalCase`
- Variablen & Methoden in `camelCase`
- Enums & Statusfelder in `SCREAMING_SNAKE_CASE`
- Blade-Templates: `snake-case.blade.php`
- Komponenten/Livewire: `PascalCaseComponent`

---

## 🏷️ Label-/Tagging-Standards (in Code & Issues)

- Issue-Types: `type: bug`, `type: feature`, etc.
- Status: `status: todo`, `status: in progress`, etc.
- Keine Emojis im Label-Namen → Emojis im UI optional

---

## 🌐 Sprache

- Im Code & in Labels: **englisch**
- UI-Texte in Deutsch, später multilingual
- Kommentare bevorzugt englisch, wenn sinnvoll

---

## 🧪 Tests (zukünftig)

- `tests/Unit/` für Logik & Modelle
- `tests/Feature/` für API-/UI-Verhalten
- Namensschema: `KlasseTest.php` → z. B. `CustomerTest.php`

---

## 🔧 ToDos im Code

```php
// TODO: Benutzerrolle prüfen, sobald Auth final ist
// FIXME: Magic-String ersetzen (siehe Zeile 99)
