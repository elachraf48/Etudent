@extends('dashboard')

@section('content')
    <div class="container">
        <h2 class="mt-5">Bulk Insert Data</h2>

        <form method="POST" action="{{ route('bulk_insert_process') }}" enctype="multipart/form-data">
            @csrf

            <!-- Textarea for pasting data -->
            <div class="mb-3">
                <label for="data" class="form-label">Paste data:</label>
                <textarea class="form-control" name="data" rows="5" cols="50"></textarea>
            </div>

            <!-- File input for CSV or TXT file -->
            <div class="mb-3">
                <label for="file" class="form-label">Or upload CSV or TXT file:</label>
                <input class="form-control" type="file" name="file" accept=".csv, .txt">
            </div>

            <button type="submit" class="btn btn-primary">Insert Data</button>
        </form>
    </div>
@endsection


