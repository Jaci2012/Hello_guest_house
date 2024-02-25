<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReservationTypes extends Model
{
    use HasFactory;
    protected $table = 'reservations'; 
    
    protected $fillable = ['chambre_id', 'client_id', 'date_debut', 'date_fin'];
    protected $dates = [
        'date_debut' => 'Y-m-d H:i:s', // Format de la date de début
        'date_fin' => 'Y-m-d H:i:s', // Format de la date de fin
    ];

    public function chambre()
    {
    return $this->belongsTo(HotelTypes::class, 'chambre_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientTypes::class);
    }
}
