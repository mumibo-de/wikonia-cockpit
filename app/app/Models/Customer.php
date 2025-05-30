<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Felder dürfen befüllt werden aus dem Admin-Panel
    protected $fillable = [
    'name',
    'slug',
    'email',
    'status',
    'ext_id',
    'monkeyoffice_id',
    'newsletter_opt_in',
    'agb_version',
    'agb_text',
    'agb_accepted_at',
    'privacy_version',
    'privacy_text',
    'privacy_accepted_at',
    'settings',
    'deletion_state',
    'deletion_date',
];

public function address()
{
    return $this->hasOne(CustomerAddress::class);
}
protected $casts = [
    'payment_data' => 'array',
];

}
