<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<h1>Search Student Details</h1>

    <form action="{{ route('index') }}" method="GET">
        @csrf
        <label for="CodeApogee">Enter Code Apogee:</label>
        <input type="text" name="CodeApogee" required>
        <button type="submit">Search</button>
    </form>

    @if(isset($student))
        <h2>Student Details:</h2>
        <p><strong>Name:</strong> {{ $student->Nom }} {{ $student->Prenom }}</p>
        <p><strong>Date of Birth:</strong> {{ $student->DateNaiss }}</p>

        <h3>Filières:</h3>
        <ul>
            @foreach($student->filieres as $filiere)
                <li>{{ $filiere->NomFiliere }} - {{ $filiere->Parcours }}</li>
            @endforeach
        </ul>

        <h3>Modules:</h3>
        <ul>
            @foreach($student->detailModules as $detailModule)
                <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }}</li>
            @endforeach
        </ul>

        <h3>Groupes:</h3>
        <ul>
            @foreach($student->groupeEtudiants as $groupeEtudiant)
                <li>{{ $groupeEtudiant->groupe->nomGroupe }} - {{ $groupeEtudiant->groupe->AnneeUniversitaire }}</li>
            @endforeach
        </ul>

        <h3>Exams:</h3>
        <ul>
            @foreach($student->infoExames as $infoExame)
                <li>{{ $infoExame->NumeroExamen }} - {{ $infoExame->Semester }} - {{ $infoExame->Lieu }}</li>
            @endforeach
        </ul>
    @endif

@endsection
