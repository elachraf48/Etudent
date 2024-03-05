@include('include.header')
@extends('layouts.apps')
@section('content')

<link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">


<div class="container home ">
    @if (session('error'))
    <div class="alert alert-danger">
        <p>{!! session('error') !!}</p>
    </div>
    @endif

    @if ($student && count($student) > 0)
    @foreach ($student as $key => $students)
    @if ($key === count($student) - 1)
    <div class="container-fleux p-0">

        <h2 class="text-center mt-5">Bonjour <span class="text-danger">{{ $students->Nom }} {{ $students->Prenom }}</span></h2>
        <div class="printbt mt-3">
                <div class="row">
                <h5>Année universitaire: <span class="text-primary">{{ $students->ExamenAnneeUniversitaire }}</span></h5>
                <h5>Filière: <span class="text-primary">{{ $students->NomFiliere }}</span></h5>
                @if ($students->Parcours != "")
                <h5>Parcours: <span class="text-primary">{{ $students->Parcours }}</span></h5>
                @endif
                <h5 class="col-md-6">Code Apogee: <span class="text-primary" id="CodeApogee">{{ $students->CodeApogee }}</span></h5>

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
                            @if($module->NumeroExamen!='')
                            | Numero Examen: {{ $module->NumeroExamen }}
                            @endif
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

    function updateReclamationsCount() {
        var CodeApogee = $('#CodeApogee').text();
        $('.btn-primary').attr('data-apogee', CodeApogee);

        $.ajax({
            url: "/reclamations/etudiant/" + CodeApogee,
            method: 'GET',
            success: function(response) {
                // Update the count in the navigation menu
                $('#reclamationsCount').text(response.count > 0 ? response.count : '0');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the function initially to update the count
    updateReclamationsCount();

    // Optionally, you can set up a timer to periodically update the count
    setInterval(updateReclamationsCount, 6000);
</script>


@endsection