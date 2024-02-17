<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'client_id',
        'chambre_id',
        'date_debut',
        'date_fin',
    ];

    // Définir les relations avec d'autres modèles si nécessaire
    public function reservation()
    {
        return $this->belongsTo(ReservationTypes::class, 'reservation_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientTypes::class, 'client_id');
    }

    public function chambre()
    {
        return $this->belongsTo(HotelTypes::class, 'chambre_id');
    }
}
