<?php

namespace App\Enums;

enum WikiStatus: string
{
    case Provisioning = 'provisioning';
    case Active       = 'active';
    case Paused       = 'paused';
    case Archived     = 'archived';
    case Deleted      = 'deleted';

    public function label(): string
    {
        return match($this) {
            self::Provisioning => 'Wird erstellt',
            self::Active       => 'Aktiv',
            self::Paused       => 'Pausiert',
            self::Archived     => 'Archiviert',
            self::Deleted      => 'Gelöscht',
        };
    }
}
