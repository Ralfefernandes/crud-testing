<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactpersonen extends Model
{
    use HasFactory;

    protected $table = 'contactpersonen'; // Add this line to specify the table name

    protected $fillable = [
        'bedrijven_id',
        'geslacht',
        'voornaam',
        'achternaam',
        'email',
        'telefoonnummer_vast',
        'telefoonnummer_mobiel',
        'notities',
        'kvk',
    ];

    public function bedrijven(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bedrijven::class, 'kvk', 'kvk');
    }

}

