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
        <h1>achraf</h1>
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
    <table class="table table-bordered">
        <thead>
            <tr class="text-center table-info">
                <th>
                    <h4>Nom Filiere</h4>
                </th>
                <th>
                    <h4>Parcours</h4>
                </th>
                <th>
                    <h4>Semester</h4>
                </th>
                <th>
                    <h4>AnneeUniversitaire</h4>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($student as $students)
            <tr>
                <td>
                    <h5>{{ $students->NomFiliere }}</h5>
                </td>
                <td>{{ $students->Parcours }}</td>
                <td>{{ $students->ExamenSemester }}</td>
                <td>{{ $students->ExamenAnneeUniversitaire }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
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