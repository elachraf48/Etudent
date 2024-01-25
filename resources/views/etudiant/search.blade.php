@extends('layouts.apps')

@section('content')

<div class="container">

    @if ($student)
    @foreach($student as $students)
    <div class="container">
        <!-- Left Top Section -->
        <header class="row">
            @if (Agent::isDesktop())
            <div class="col-md-9 bg-light text">
                <!-- Left Section with Logo -->
                <div class="mx-auto">
                    <img src="{{ asset('img/banner.png') }}" class="img-fluid w-25" alt="Logo">
                </div>
            </div>
            @else
            <div class="col-md-9 bg-light text-center">
                <!-- Centered Section with Logo for Mobile -->
                <div class="mx-auto">
                    <img src="{{ asset('img/banner.png') }}" class="img-fluid w-50" alt="Logo">
                </div>
            </div>
            @endif


            <!-- Right Top Section -->
            <div class="col-md-3 position-relative bg-light">

                <div class="mt-5">
                    <h5>Année universitaire: <span class="text-primary">{{ $students->ExamenAnneeUniversitaire }}</span></h5>
                    <h5>Filière: <span class="text-primary">{{ $students->NomFiliere }}</span></h5>

                    @if ($students->Parcours != "")
                    <h5>Parcours: <span class="text-primary">{{ $students->Parcours }}</span></h5>
                    @endif
                </div>
            </div>


            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container">
                    <a class="nav-link active text-white" aria-current="page" href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                        </svg>Accueil
                    </a>
                    <a class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                        </svg>Espace étudiant
                    </a>
                    <div class="d-flex ms-auto">
                        <button class="btn btn-success" onclick="submitReclamation()">
                            Reclamation
                        </button>
                        <button class="btn btn-danger" onclick='window.location.href = "{{ url("/") }}"'>
                            Déconnexion
                        </button>

                    </div>

                </div>
            </nav>
        </header>


        <h2 class="text-center m-5">Bonjour <span class="text-danger">{{ $students->Nom }} {{ $students->Prenom }}</span></h2>
        <div class="printbt">
            <div class="row">
                <h5 class="col-md-6">Code Apogee: {{ $students->CodeApogee }}</h5>
            </div>
        </div>


    </div>
    @break
    @endforeach
    @endif

    @if ($student && count($groupedModules) > 0)
    @foreach ($groupedModules as $semesterKey => $modules)
    <h5 class="mb-3 text-success">
        Licence d'études fondamentales Session de Printemps Semestre {{ $semesterKey }}
    </h5>
    <div class="exam-details">



    </div>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center table-secondary">
                <th colspan="4">
                    @foreach ($modules as $module)
                    <div class="exam-details">
                        <p>
                            Filière: {{ $module->NomFiliere }} | Semester: {{ $module->ExamenSemester }}
                            | Numero Examen: {{ $module->NumeroExamen }}
                            @if ($module->NomGroupe && $module->NomGroupe !== "0")
                            | Groupe: {{ $module->NomGroupe }}
                            @endif
                        </p>
                    </div>
                    <!-- Break after the first iteration -->
                    @break
                    @endforeach
                </th>
            </tr>
            <tr class="text-center table-info">
                <th>
                    <h4>Modules</h4>
                </th>
                <th>
                    <h4>Lieu</h4>
                </th>
                <th>
                    <h4>Date</h4>
                </th>
                <th>
                    <h4>Horaire</h4>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
            <tr>
                <td>
                    <h5>{{ $module->NomModule }}</h5>
                </td>
                <td>{{ $module->Lieu }}</td>
                <td>{{ $module->DateExamen }}</td>
                <td>{{ $module->Houre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    @else
    <p>No student found with the provided Code Apogee or no semesters found.</p>
    @endif
    <script>
        function submitReclamation() {
            // Implement your reclamation submission logic here, for example, redirect to the reclamation page
            window.location.href = "{{ route('reclamation') }}";
        }
    </script>


    @endsection