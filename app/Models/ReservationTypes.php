<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTypes extends Model
{
    use HasFactory;
    protected $table = 'reservations'; 
    
    protected $fillable = ['chambre_id', 'client_id', 'date_debut', 'date_fin'];

    public function chambre()
    {
        return $this->belongsTo(HotelTypes::class);
    }
    public function client()
    {
        return $this->belongsTo(ClientTypes::class);
    }
}
