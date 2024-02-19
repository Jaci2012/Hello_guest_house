@extends('base')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Reservations /</span> Listes
    </h4>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('Reservations Add') }}" class="btn btn-primary">Ajout</a>
    <br><br>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
    
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    // Ici, vous pouvez inclure vos événements
                    @foreach($reservations as $reservation)
                        {
                            title: 'Reservée', // Titre de l'événement
                            start: '{{ $reservation->date_debut }}', // Date de début de l'événement
                            end: '{{ $reservation->date_fin }}', // Date de fin de l'événement
                            client: '{{ $reservation->client->nom }}',
                            chambre: '{{ $reservation->chambre->numero }}', // Date de fin de l'événement
                            color: getRandomColor(), // Couleur aléatoire
                            id: '{{ $reservation->id }}' // ID de la réservation
                            // Vous pouvez également inclure d'autres données d'événement ici
                        },
                    @endforeach
                ],
                eventContent: function(info) {
                    var event = info.event;
                    var deleteButton = '<button onclick="deleteReservation(' + event.id + ')" class="btn btn-danger btn-sm">Supprimer la réservation</button>';
                    return {
                        html: '<b>' + event.title + '</b><br>' +
                              'Client: ' + event.extendedProps.client + '<br>' +
                              'Chambre: ' + event.extendedProps.chambre + '<br>' +
                              deleteButton
                    };
                }
            });
    
            calendar.render();
    
            // Fonction pour générer une couleur aléatoire en format hexadecimal
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        });

        function deleteReservation(reservationId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')) {
        // Créer un formulaire de suppression
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/reservations/' + reservationId + '/delete';
        form.style.display = 'none'; // Ne pas afficher le formulaire

        // Ajouter un champ pour indiquer la méthode DELETE
        var methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'DELETE');
        form.appendChild(methodInput);

        // Ajouter le jeton CSRF
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.setAttribute('type', 'hidden');
        csrfTokenInput.setAttribute('name', '_token');
        csrfTokenInput.setAttribute('value', '{{ csrf_token() }}'); // Utilisez la syntaxe Blade pour obtenir le jeton CSRF
        form.appendChild(csrfTokenInput);

        // Ajouter le formulaire à la page
        document.body.appendChild(form);

        // Soumettre le formulaire
        form.submit();
    }
}


</script>
@endsection
