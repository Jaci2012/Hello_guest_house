<?php

namespace App\Http\Controllers;
use App\Models\ClientTypes;
use App\Models\HotelTypes;
use App\Models\ReservationTypes;
use App\Models\ReservationHistory;
use Illuminate\Http\Request;

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
        $reservations = ReservationTypes::all();
        return view('dash.reserve', compact('reservations'));
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
    
        $reservation = ReservationTypes::create([
            'chambre_id' => $request->chambre_id,
            'client_id' => $request->client_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);
    
    
        // Mettre à jour le statut de la chambre correspondante
        $chambre = HotelTypes::findOrFail($request->chambre_id);
        $chambre->statut = 'réservée';
        $chambre->save();
    
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
    // Récupérer toutes les entrées de l'historique des réservations
    $reservationHistory = ReservationHistory::all();
    
    // Passer les données à la vue
    return view('dash.historiques', compact('reservationHistory'));
    }
}
