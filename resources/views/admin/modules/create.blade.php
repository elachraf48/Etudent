<!-- resources/views/admin/modules.blade.php -->

@extends('layouts.apps')

@section('content')
    <div class="container">
        <h2>Create Modules</h2>

        <form method="post" action="{{ route('admin.modules.store') }}">
    @csrf
            <div class="form-group">
                <label for="moduleDetails">Module Details (one per line):</label>
                <textarea class="form-control" id="moduleDetails" name="moduleDetails" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Modules</button>
</form>
    </div>
@endsection
