@extends('layouts.apps')

@section('content')

<div class="container">

    @if ($student)
        <div class="student-info">
        <div class="student-info">
            <p>Apogee: {{ $student->CodeApogee }}</p>
            <p>Nom: {{ $student->Nom }}</p>
            <p>Prenom: {{ $student->Prenom }}</p>
            <p>Annee Universitaire: {{ $student->ExamenAnneeUniversitaire }}</p>
            <p>Filière: {{ $student->NomFiliere }}</p>
            @if ($student->Parcours != "")
                <p>Parcours: {{ $student->Parcours }}</p>
            @endif
        </div>

        </div>
        @endif

        @if ($student && count($semesters) > 0)
    @foreach ($semesters as $semester)
        <h5 class="mb-3 text-success">
            Licence d'études fondamentales Session de Printemps Semestre {{ $semester->ExamenSemester }}
        </h5>

        <div class="exam-details">
            <p>
                Filière: {{ $semester->NomFiliere }} | Semester: {{ $semester->ExamenSemester }}
                | Numero Examen: {{ $semester->NumeroExamen }}
                @if ($semester->NomGroupe && $semester->NomGroupe !== "0")
                    | Groupe: {{ $semester->NomGroupe }}
                @endif
            </p>
        </div>

        <table class="table table-bordered">
            <thead>
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
                @foreach ($semester->modules as $module)
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

@endsection
