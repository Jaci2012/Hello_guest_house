<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HotelTypes extends Model
{
    use HasFactory;
    
    protected $table = 'chambres'; 
    
    protected $fillable = ['numero', 'statut'];

    public function reservations()
    {
        return $this->hasMany(ReservationTypes::class, 'chambre_id');
    }

    public function estDisponible()
    {
        // Récupérer la date actuelle
        $dateActuelle = Carbon::now();
        
        // Vérifier si une réservation existe pour cette chambre pendant la période actuelle
        $reservationExiste = ReservationTypes::where('chambre_id', $this->id)
            ->where('date_debut', '<=', $dateActuelle)
            ->where('date_fin', '>=', $dateActuelle)
            ->exists();
        
        // Si aucune réservation n'existe, la chambre est disponible
        return !$reservationExiste;
    }
}
