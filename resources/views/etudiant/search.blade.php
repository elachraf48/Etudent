@extends('layouts.apps')

@section('content')
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


        @foreach ($etudiant->filieres as $filiere)
        <div class="col-md-3 position-relative bg-light">
            <!-- Right Top Section -->
            <div class="mt-5">
                <h5>Année universitaire: <span class="text-primary">{{ $etudiant->examens->max('AnneeUniversitaire') }}</span></h5>
                <h5>Filière: <span class="text-primary">{{ $filiere->NomFiliere }}</span></h5>
                @if($filiere->Parcours != "")
                <h5>Parcours: <span class="text-primary">{{ $filiere->Parcours }}</span></h5>
                @endif
            </div>
        </div>
        @endforeach
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


    <h2 class="text-center m-5">Bonjour <span class="text-danger">{{ $etudiant->Nom }} {{ $etudiant->Prenom }}</span></h2>
    <div class="printbt">
        <div class="row">
            <h5 class="col-md-6">Code Apogee: {{ $etudiant->CodeApogee }}</h5>
        </div>
    </div>

    @foreach ($etudiant->filieres as $filiere)
    @foreach ($etudiant->examens as $examen)
    <h5 class="mb-3 text-success">
        Licence d'études fondamentales Session de Printemps Semestre {{ $examen->Semester }}
    </h5>
    <!-- <p>Lieu: {{ $examen->Lieu }} | Annee Universitaire: {{ $examen->AnneeUniversitaire }} </p> -->
    @endforeach


    @php
    $groupe = $etudiant->groupes->where('Semester', $examen->Semester)->first();
    @endphp
    <h6 class="mb-3 text-info">

    </h6>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center table-secondary">
                <th colspan="4">
                    Filière: {{ $filiere->NomFiliere }} | Semester: {{ $examen->Semester }}
                    @if ($groupe && $groupe->nomGroupe !== "0")
                    | Groupe: {{ $groupe->nomGroupe }}

                    @endif
                    | Numero Examen: {{ $examen->NumeroExamen }}
                </th>
            </tr>
        </thead>
        <tbody>
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
            @foreach ($filiere->modules as $module)
            @foreach ($module->calendrierModules as $calendrierModule)







            <tr>
                <td>
                    <h5>
                        {{ $module->NomModule }}
                    </h5>
                </td>
                <td>{{ $examen->Lieu }}</td>
                <td>{{ $calendrierModule->DateExamen }}</td>
                <td>{{ $calendrierModule->Houre }}</td>
            </tr>

            @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endforeach


<script>
   

    function submitReclamation() {
        // Implement your reclamation submission logic here, for example, redirect to the reclamation page
        window.location.href = "{{ route('reclamation') }}";
    }
</script>

@endsection