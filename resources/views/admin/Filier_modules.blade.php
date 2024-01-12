@extends('dashboard')

@section('content')
    <div class="container">
        <h2 class="mt-5">Bulk Insert Data</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('Filier_modules_process') }}" enctype="multipart/form-data">
            @csrf

            <!-- Textarea for pasting data -->
            <div class="mb-3">
                <textarea    name="student_data" class="form-control" rows="10" required placeholder="Semester,Code Module,Nom Module,Nom Filiere,Parcours,Code FILIERE"></textarea>
            </div>

            <!-- File input for CSV or TXT file -->
            <div class="mb-3" style="display: none;">
                <label for="file" class="form-label">Or upload CSV or TXT file:</label>
                <input class="form-control" type="file" name="file" accept=".csv, .txt">
            </div>

            <button type="submit" class="btn btn-primary">Insert Data</button>
        </form>
    </div>
@endsection


