<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adressen extends Model
{
    use HasFactory;

    protected $table = 'adressen'; // Add this line to specify the table name
    protected $fillable = [
        'beschrijving',
        'straatnaam',
        'huisnummer',
        'postcode',
        'plaatsnaam',
        'land',
        'kvk',
    ];



    public function bedrijf(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bedrijven::class, 'kvk', 'kvk');
    }
}
