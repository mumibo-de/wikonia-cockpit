<?php

namespace App\Enums;

/**
 * Class CountryEnum
 *
 * Enthält eine Liste aller EU-Mitgliedsstaaten als ISO-Code => Klarname.
 * Diese Konstante kann z. B. für Dropdown-Auswahlfelder in Formularen genutzt werden.
 *
 * @example CountryEnum::EU_COUNTRIES['DE'] // gibt "Deutschland" zurück
 * @usage In Filament Select::make('country')->options(CountryEnum::EU_COUNTRIES)
 *
 * Hinweise:
 * - Die Liste enthält bewusst **nur EU-Länder** für steuerrechtlich relevante Zwecke.
 * - Länder wie Schweiz, Norwegen oder UK sind NICHT enthalten.
 * - Erweiterbar durch eigene Konstanten oder Methoden.
 *
 * @author ChatGPT & Kevin
 * @date 2025-05-30
 */
class CountryEnum
{
    public const EU_COUNTRIES = [
        'AT' => 'Österreich',
        'BE' => 'Belgien',
        'BG' => 'Bulgarien',
        'HR' => 'Kroatien',
        'CY' => 'Zypern',
        'CZ' => 'Tschechien',
        'DK' => 'Dänemark',
        'EE' => 'Estland',
        'FI' => 'Finnland',
        'FR' => 'Frankreich',
        'DE' => 'Deutschland',
        'GR' => 'Griechenland',
        'HU' => 'Ungarn',
        'IE' => 'Irland',
        'IT' => 'Italien',
        'LV' => 'Lettland',
        'LT' => 'Litauen',
        'LU' => 'Luxemburg',
        'MT' => 'Malta',
        'NL' => 'Niederlande',
        'PL' => 'Polen',
        'PT' => 'Portugal',
        'RO' => 'Rumänien',
        'SK' => 'Slowakei',
        'SI' => 'Slowenien',
        'ES' => 'Spanien',
        'SE' => 'Schweden',
    ];
}
