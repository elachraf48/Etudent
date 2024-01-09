@extends('layouts.apps')

@section('content')
    <div class="container">
        <h2>Bulk Insert Data</h2>

        <form method="POST" action="{{ route('bulk_insert_process') }}" enctype="multipart/form-data">
            @csrf

            <!-- Textarea for pasting data -->
            <div class="form-group">
                <label for="data">Paste data:</label>
                <textarea name="data" rows="5" cols="50"></textarea>
            </div>

            <!-- File input for CSV or TXT file -->
            <div class="form-group">
                <label for="file">Or upload CSV or TXT file:</label>
                <input type="file" name="file" accept=".csv, .txt">
            </div>

            <button type="submit">Insert Data</button>
        </form>
    </div>
@endsection
