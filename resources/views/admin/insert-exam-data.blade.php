<!-- resources/views/admin/insert-exam-data.blade.php -->

@extends('dashboard')

@section('content')
    <div class="container">
        <h2>Insert Exam Data</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('process_exam_data') }}">
            @csrf

            <!-- Add a textarea to paste the data -->
            <div class="mb-3">
                <label for="exam_data" class="form-label">Paste Exam Data:</label>
                <textarea name="exam_data" class="form-control" rows="10" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Insert Data</button>
        </form>
    </div>
@endsection
