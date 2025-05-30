# Wikonia Dev Umgebung

## Quickstart

1. Öffne ein Terminal im Projektordner:
    ```bash
    cd wikonia-dev
    ```

2. Starte alle Dienste:
    ```bash
    docker-compose up -d
    ```

3. Öffne im Browser:
    - Laravel App: [http://localhost:8081](http://localhost:8081)
    - phpMyAdmin: [http://localhost:8082](http://localhost:8082)

4. Die Dateien befinden sich in `./app` – öffne diesen Ordner in VS Code.

5. Adminbereich (Filament) kannst du später per Composer hinzufügen:
    ```bash
    composer require filament/filament
    ```

## Hinweise

- Die Datenbank läuft auf `localhost:3307`, DB: `wikonia`, User: `root`, PW: `root`
- Alle Daten werden lokal gespeichert (Volume: `db_data`)

---

Viel Erfolg – du rockst das 🚀