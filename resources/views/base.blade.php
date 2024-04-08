<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    {{-- <link rel="manifest" href="/site.webmanifest"> --}}

    <title>Hello Guest House</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Custom styles for language flags -->
    <style>
        .lang-flag {
            width: 30px;
            height: 20px;
            margin-right: 5px;
            cursor: pointer;
        }
        .container {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Ombre subtile */
    border-radius: 8px; /* Bordures arrondies */
    overflow: hidden; /* Assure que tout à l'intérieur respecte les bordures arrondies */
}

#rooms-list {
    flex: 1;
    background-color: #fff;
    overflow-y: auto; /* Permettre le défilement */
    border-right: 1px solid #eee;
}

#rooms-list h3 {
    margin: 10px;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

#rooms-list p {
    height: 50px; /* Exemple de hauteur; ajustez selon le besoin */
    display: flex;
    align-items: center; /* Centre le texte verticalement */
    margin: 0; /* Enlève les marges par défaut */
    padding: 5px 10px; /* Ajustez le padding selon le besoin */
    border-bottom: 1px solid #f0f0f0; /* Ajoute une séparation visuelle */
}


#rooms-list p:hover {
    background-color: #f9f9f9; /* Interaction au survol */
}

#reservations-calendar {
    flex: 3;
    padding: 20px;
}

.date, .room {
    text-align: center;
    padding: 10px 0;
}

.calendar-navigation {
    display: flex;
    align-items: center;
}

.calendar-navigation button {
    border: none;
    background-color: transparent;
    cursor: pointer;
    font-size: 24px;
    padding: 0 10px;
}

.dates-header {
    display: flex;
    overflow-x: auto;
    flex-grow: 1;
}

.dates-header span {
    flex: 1;
    min-width: 100px; /* Assure une largeur minimale pour chaque date */
    margin: 10px 5px;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Ombre subtile pour les dates */
    cursor: pointer; /* Indique que l'élément est cliquable */
    transition: transform 0.2s; /* Animation */
}

.dates-header span:hover {
    transform: translateY(-2px); /* Effet au survol */
}

.room-availability {
    height: 50px; /* Doit correspondre à la hauteur de #rooms-list p */
    align-items: center; /* Pour aligner verticalement les cases à cocher */
}


.room-availability {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee; /* Séparer visuellement les lignes */
}

.room-name {
    width: 20%; /* Assurez-vous que cela correspond à la largeur de #rooms-list */
    text-align: center;
    padding: 10px;
    background-color: #f9f9f9; /* Un léger arrière-plan pour distinguer la colonne */
}

.date-availability {
    flex-grow: 1;
    text-align: center;
    padding: 5px;
}

input[type="checkbox"] + label {
    cursor: pointer;
    height: 20px;
    width: 20px;
    display: inline-block;
    background-color: #f0f0f0;
}

input[type="checkbox"]:checked + label {
    background-color: #4CAF50; /* Vert pour les cases cochées */
}
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                {{-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> --}}
                <div class="sidebar-brand-text mx-3">Hello Guest House</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('Clients List') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Client</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Chambres List') }}">
                    <i class="fas fa-fw fa-map"></i>
                    <span>Chambres</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Reservations ListTables') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Reservé/Tables</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Reservations List') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Reservé/Checkbox</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Historiques List') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Historiques/FullCalendar</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                </nav>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Hello Guest House 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}
    <script src="{{ asset('fullcalendar/dist/index.global.min.js') }}"></script>
        
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    let weekOffset = 0;
    
    const prevWeekBtn = document.getElementById('prev-week');
    const nextWeekBtn = document.getElementById('next-week');
    
    prevWeekBtn.addEventListener('click', () => changeWeek(-1));
    nextWeekBtn.addEventListener('click', () => changeWeek(1));
    
    function changeWeek(direction) {
        weekOffset += direction;
        fetch(`/get-week-dates?weekOffset=${weekOffset}`)
            .then(response => response.json())
            .then(data => {
                updateCalendarUI(data.dates, data.reservationsByDate, data.chambres);
            });
    }
    
    function updateCalendarUI(dates, reservationsByDate, chambres) {
    const datesHeader = document.querySelector('.dates-header');
    datesHeader.innerHTML = '';
    dates.forEach(date => {
        const dateSpan = document.createElement('span');
        dateSpan.className = 'date';
        dateSpan.textContent = date.formatted;
        datesHeader.appendChild(dateSpan);
    });

    const roomsSection = document.querySelector('.rooms-availability');
    roomsSection.innerHTML = '';

    chambres.forEach(chambre => {
        const roomDiv = document.createElement('div');
        roomDiv.className = 'room-availability';
        roomDiv.dataset.roomId = chambre.id;

        const roomHeader = document.createElement('h6');
        roomHeader.textContent = `Chambre ${chambre.numero}`;
        roomDiv.appendChild(roomHeader);

        dates.forEach(date => {
            const dateAvailabilityDiv = document.createElement('div');
            dateAvailabilityDiv.className = 'date-availability';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.dataset.date = date.date;
            checkbox.dataset.roomId = chambre.id;
            checkbox.id = `checkbox-${chambre.id}-${date.date}`;

            const label = document.createElement('label');
            label.htmlFor = checkbox.id;
            
            const isReserved = reservationsByDate[date.date] && reservationsByDate[date.date][chambre.id];
            checkbox.checked = !!isReserved;
            checkbox.disabled = !!isReserved;
            // Appliquer le style selon si la chambre est réservée
            dateAvailabilityDiv.style.backgroundColor = isReserved ? '#ffcccc' : 'transparent'; // Rouge si réservé, transparent sinon

            dateAvailabilityDiv.appendChild(checkbox);
            dateAvailabilityDiv.appendChild(label); // Assurez-vous d'ajouter le label si vous utilisez
            roomDiv.appendChild(dateAvailabilityDiv);
        });

        roomsSection.appendChild(roomDiv);
    });
}





    // Initialement charger les données pour la semaine actuelle
    changeWeek(0);
});


    </script>
        

</body>

</html>
