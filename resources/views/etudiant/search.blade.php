@extends('layouts.apps')

@section('content')

<div class="container" >
    @if (session('error'))
    <div class="alert alert-danger">
        <p>{!! session('error') !!}</p>
    </div>
    @endif

    @if ($student && count($student) > 0)
    @foreach ($student as $key => $students)
    @if ($key === count($student) - 1)
    <div class="container">

        <!-- Left Top Section -->
        <header class="row">
            <div class="text-center">
                <!-- Left Section with Logo -->
                    <img src="{{ asset('img/ministry-logo-ar.png') }}" class="img-fluid" alt="Logo">
            </div>
           


            <!-- Right Top Section -->



            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container">
                    <a class="nav-link active text-white" aria-current="page" href="/">
                        <i class="fa-solid fa-house"></i> Accueil
                    </a>
                    <a class="nav-link text-white m-1">
                        <i class="fa-solid fa-arrow-right-long"></i> Espace étudiant
                    </a>
                    <div class="d-flex ms-auto ">
                        <button class="btn btn-info m-1" onclick="printPage()">
                            <i class="fa-solid fa-print"></i>
                        </button>
                        <button class="btn btn-success m-1" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                            Reclamation
                        </button>
                        <button class="btn btn-danger m-1" onclick='window.location.href = "{{ url("/") }}"'>
                            Déconnexion
                        </button>

                    </div>


            </nav>
        </header>


        <h2 class="text-center mt-5">Bonjour <span class="text-danger">{{ $students->Nom }} {{ $students->Prenom }}</span></h2>
        <div class="printbt mt-3">
            <div class="row">
                <h5>Année universitaire: <span class="text-primary">{{ $students->ExamenAnneeUniversitaire }}</span></h5>
                <h5>Filière: <span class="text-primary">{{ $students->NomFiliere }}</span></h5>
                @if ($students->Parcours != "")
                <h5>Parcours: <span class="text-primary">{{ $students->Parcours }}</span></h5>
                @endif
                <h5 class="col-md-6">Code Apogee: <span class="text-primary">{{ $students->CodeApogee }}</span></h5>

            </div>
        </div>


    </div>
    @endif
    @endforeach
    @endif

    @if ($student && count($groupedModules) > 0)
    @foreach ($groupedModules as $semesterKey => $modules)
    <h5 class="mb-3 text-success mt-5">
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
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   
    function printPage() {
        window.print();
    }
   
</script>


@endsection