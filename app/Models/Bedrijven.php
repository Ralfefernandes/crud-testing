<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contactpersonen;

class Bedrijven extends Model
{
    use HasFactory;

    protected $table = 'bedrijven'; // Add this line to specify the table name

    protected $fillable = [
        'bedrijfsnaam',
        'kvk',
        'btw',
        'land_van_vestiging',
    ];

    public function contactpersonen(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Contactpersonen::class, 'bedrijven_contactpersonen');
    }

    public function adressen(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Adressen::class, 'id', 'id');
    }
}

