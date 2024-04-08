<?php

namespace App\Http\Controllers;
use App\Models\ClientTypes;
use App\Models\HotelTypes;
use App\Models\ReservationTypes;
use App\Models\ReservationHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HotelController extends Controller
{
    //CLIENTS DEV
    public function clients()
    {
        $clients = ClientTypes::all();
        return view('dash.client', compact('clients'));
    }
    public function clientsAdd()
    {
        return view('dash.clients.add');
    }

    public function clientsStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'identifiant' => 'required|string|max:255',
        ]);

        ClientTypes::create($request->all());

        return redirect()->route('Clients List')->with('success', 'Client ajouté avec succès.');
    }
    public function clientsEdit($id)
    {
        $client = ClientTypes::findOrFail($id);
        return view('dash.clients.edit', compact('client'));
    }

    public function clientsUpdate(Request $request, $id)
    {
        $client = ClientTypes::findOrFail($id);
        $client->update($request->all());
        return redirect()->route('Clients List')->with('Clients', 'Clients mis à jour avec succès.');
    }

    public function clientsDestroy($id)
    {
        $client = ClientTypes::findOrFail($id);
        $client->delete();
        return redirect()->route('Clients List')->with('success', 'Clients supprimé avec succès.');
    }

    //CHAMBRES DEV
    public function chambres()
    {
        $chambres = HotelTypes::all();
        return view('dash.hotel', compact('chambres'));
    }
    public function chambresAdd()
    {
        return view('dash.chambres.add');
    }

    public function chambresStore(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:255',
        ]);

        HotelTypes::create($request->all());

        return redirect()->route('Chambres List')->with('success', 'Chambres ajouté avec succès.');
    }
    public function chambresEdit($id)
    {
        $chambre = HotelTypes::findOrFail($id);
        return view('dash.chambres.edit', compact('chambre'));
    }

    public function chambresUpdate(Request $request, $id)
    {
        $chambre = HotelTypes::findOrFail($id);
        $chambre->update($request->all());
        return redirect()->route('Chambres List')->with('chambres', 'Chambres mis à jour avec succès.');
    }

    public function chambresDestroy($id)
    {
        $chambre = HotelTypes::findOrFail($id);
        $chambre->delete();
        return redirect()->route('Chambres List')->with('success', 'Chambres supprimé avec succès.');
    }
    //RESERVATIONS DEV
    public function reservations()
    {
        $chambres = HotelTypes::all(); // Récupérez toutes les chambres
        $reservations = ReservationTypes::all();
    
        // Initialisation d'un tableau pour marquer les dates réservées
        $datesReserveesParChambre = [];
    
        foreach ($chambres as $chambre) {
            foreach ($reservations as $reservation) {
                if ($reservation->chambre_id == $chambre->id) {
                    $debut = Carbon::parse($reservation->date_debut);
                    $fin = Carbon::parse($reservation->date_fin);

                    
                    while ($debut->lte($fin)) {
                        $datesReserveesParChambre[$chambre->id][$debut->format('Y-m-d')] = true;
                        $debut->addDay();
                    }
                }
            }
        }
    
        $dates = collect(); // Utilisez une collection pour stocker les dates
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            // Format : "Lundi 5 Mars"
            $formattedDate = ucfirst($date->locale('fr')->isoFormat('dddd D MMMM')); // Utilisez 'isoFormat' pour un formatage personnalisé
            $dates->push(['date' => $date->format('Y-m-d'), 'formatted' => $formattedDate]);
        }
    
        return view('dash.reserve', compact('chambres', 'dates', 'datesReserveesParChambre'));
    }

    public function reservationsTables()
    {
        $reservations = ReservationTypes::all();
    
        return view('dash.reserveTables', compact('reservations'));
    }
        
    
    public function reservationsAdd()
    {
        $chambres = HotelTypes::where('statut', 'non réservée')->get();
        $clients = ClientTypes::all();
    
        return view('dash.reservations.add', compact('chambres', 'clients'));
    }

    public function reservationsStore(Request $request)
    {
    $request->validate([
        'chambre_id' => 'required|exists:chambres,id',
        'client_id' => 'required|exists:clients,id',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Vérifier la disponibilité de la chambre pour les dates spécifiées
    $chambreId = $request->chambre_id;
    $dateDebut = $request->date_debut;
    $dateFin = $request->date_fin;

    $existingReservation = ReservationTypes::where('chambre_id', $chambreId)
        ->where(function ($query) use ($dateDebut, $dateFin) {
            $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                ->orWhereBetween('date_fin', [$dateDebut, $dateFin]);
        })
        ->exists();

    if ($existingReservation) {
        return redirect()->back()->with('error', 'La chambre n\'est pas disponible pour les dates spécifiées.');
    }

    // Créer la réservation
    $reservation = ReservationTypes::create([
        'chambre_id' => $request->chambre_id,
        'client_id' => $request->client_id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);

    return redirect()->route('Reservations List')->with('success', 'La réservation a été créée avec succès.');
    }

    public function reservationsDestroy($id)
    {
    // Trouver la réservation à supprimer
    $reservation = ReservationTypes::findOrFail($id);
    
    // Créer un enregistrement dans la table d'historique
    ReservationHistory::create([
        'reservation_id' => $reservation->id,
        'client_id' => $reservation->client_id,
        'chambre_id' => $reservation->chambre_id,
        'date_debut' => $reservation->date_debut,
        'date_fin' => $reservation->date_fin,
        // Ajoutez d'autres champs historiques si nécessaire
    ]);
    
    // Récupérer la chambre associée à cette réservation
    $chambre = HotelTypes::findOrFail($reservation->chambre_id);
    
    // Mettre à jour le statut de la chambre en "non réservée"
    $chambre->statut = 'non réservée';
    $chambre->save();
    
    // Supprimer la réservation
    $reservation->delete();
    
    // Rediriger avec un message de succès
    return redirect()->route('Reservations List')->with('success', 'La réservation a été supprimée avec succès et les données ont été ajoutées à l\'historique.');
    }

    public function showReservationHistory()
{
    $reservationHistory = ReservationHistory::with(['chambre', 'client'])->get();

    // Convertir l'historique des réservations pour FullCalendar
    $events = $reservationHistory->map(function ($reservation) {
        return [
            'title' => $reservation->client->nom . " - Chambre " . $reservation->chambre->numero,
            'start' => $reservation->date_debut,
            'end' => $reservation->date_fin,
            // Vous pouvez ajouter d'autres propriétés ici selon les besoins
        ];
    });

    // Passer les données à la vue, en les convertissant en JSON
    return view('dash.historiques', ['reservationHistoryJson' => $events->toJson()]);
}
    // Dans votre controller, ajustez la méthode getWeekDates pour inclure les réservations
    public function getWeekDates(Request $request)
{
    $weekOffset = $request->query('weekOffset', 0);
    $startOfWeek = Carbon::now()->addWeeks($weekOffset)->startOfWeek();

    $dates = collect();
    for ($i = 0; $i < 7; $i++) {
        $date = $startOfWeek->copy()->addDays($i);
        $dates->push([
            'date' => $date->format('Y-m-d'),
            'formatted' => $date->locale('fr')->isoFormat('dddd D MMMM'),
        ]);
    }
    $chambres = HotelTypes::all();

    $reservations = ReservationTypes::whereBetween('date_debut', [$startOfWeek, $startOfWeek->copy()->endOfWeek()])
                                     ->orWhereBetween('date_fin', [$startOfWeek, $startOfWeek->copy()->endOfWeek()])
                                     ->get();

    $reservationsByDate = [];
    foreach ($reservations as $reservation) {
        $start = Carbon::parse($reservation->date_debut)->startOfDay();
        $end = Carbon::parse($reservation->date_fin)->endOfDay();
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $reservationsByDate[$date->format('Y-m-d')][$reservation->chambre_id] = [
                'isReserved' => true,
                'clientId' => $reservation->client_id, // Utilisez client_id comme indicateur distinctif
            ];
        }
    }

    return response()->json([
        'dates' => $dates,
        'reservationsByDate' => $reservationsByDate,
        'chambres' => $chambres,
    ]);
}

// public function getMonthDates(Request $request)
// {
//     $monthOffset = $request->query('monthOffset', 0);
//     $startOfMonth = Carbon::now()->addMonths($monthOffset)->startOfMonth();
//     $endOfMonth = $startOfMonth->copy()->endOfMonth();

//     $dates = collect();
//     for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
//         $dates->push([
//             'date' => $date->format('Y-m-d'),
//             'formatted' => $date->locale('fr')->isoFormat('D MMMM'),
//         ]);
//     }

//     // Récupération des réservations pour le mois
//     $reservations = ReservationTypes::whereBetween('date_debut', [$startOfMonth, $endOfMonth])
//                                      ->orWhere(function($query) use ($startOfMonth, $endOfMonth) {
//                                          $query->whereBetween('date_fin', [$startOfMonth, $endOfMonth]);
//                                      })
//                                      ->get();

//     $reservationsByDate = [];
//     foreach ($reservations as $reservation) {
//         $start = Carbon::parse($reservation->date_debut)->startOfDay();
//         $end = Carbon::parse($reservation->date_fin)->endOfDay();
//         for ($date = $start; $date->lte($end); $date->addDay()) {
//             $reservationsByDate[$date->format('Y-m-d')][$reservation->chambre_id] = true;
//         }
//     }

//     return response()->json([
//         'dates' => $dates,
//         'reservationsByDate' => $reservationsByDate,
//     ]);
// }
}
