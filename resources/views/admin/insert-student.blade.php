<!-- resources/views/admin/insert-student.blade.php -->

@extends('dashboard')

@section('content')
    <div class="container">
        <h2>Insert Student Data</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('process_student_data') }}" enctype="multipart/form-data">
            @csrf

            <!-- Add a switch button for choosing the method -->
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch" checked>
                <label class="form-check-label" for="methodSwitch">Use File (Unchecked: Use Textarea)</label>
            </div>

            <!-- Add a textarea for pasting data -->
            <div class="mb-3">
                <label for="student_data" class="form-label">Paste Student Data:</label>
                <textarea name="student_data" class="form-control" rows="10" required placeholder="Numéro d'examen,Code Apogee,Nom,Prénom,Date Naiss,LIEU,code FILIERE,Semester,GROUPE,AnneeUniversitaire"></textarea>
            </div>

            <!-- Add a file input for uploading a CSV or TXT file -->
            <div class="mb-3">
                <label for="file" class="form-label">Upload CSV or TXT File:</label>
                <input type="file" name="file" class="form-control" accept=".csv, .txt">
            </div>

            <button type="submit" class="btn btn-primary">Insert Data</button>
        </form>
    </div>
@endsection
