<!-- resources/views/admin/insert-student.blade.php -->

@extends('dashboard')

@section('content')
<div class="container p-3">
    <h2>Insert detail modules Data</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <form method="POST" action="{{ route('process_detail_modules_data') }}" enctype="multipart/form-data">
        @csrf

        <!-- Add a switch button for choosing the method -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch">
            <label class="form-check-label" for="methodSwitch">Use File checked</label>
        </div>
        <div class="row g-2 mt-1 p-1">
            <div class="col-md">
                <div class="form-floating">
                    <select name="AnneeUniversitaire" id="AnneeUniversitaire" class="form-control" required>
                        <?php
                        $currentYear = date('Y') - 1;
                        for ($i = 0; $i < 3; $i++) {
                            $startYear = $currentYear - $i;
                            $endYear = $startYear + 1;
                            $academicYear = $startYear . '-' . $endYear;
                        ?>
                            <option value="<?= $academicYear ?>"><?= $academicYear ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelectGrid">Annee Universitaire</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="sessions" id="sessionDropdown" class="form-control" required>
                        <option value="" disabled selected>Select Session</option>
                        @foreach($sessions as $session)
                        <option value="{{ $session->id }}">Part Semester: {{ $session->part_semester }} - {{ $session->SESSION }} </option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">Session Universitaire</label>
                </div>
            </div>
        </div>
        <!-- Add a textarea for pasting data -->
        <div class="mb-3">
            <textarea name="detail_modules_data" class="form-control" rows="10" required placeholder="Numéro d'examen,Code Apogee,Nom,Prénom,Date Naiss,LIEU,code FILIERE,Semester,GROUPE"></textarea>
        </div>

        <!-- Add a file input for uploading a CSV or TXT file -->
        <div class="mb-3">
            <label for="file" class="form-label">Upload CSV or TXT File:</label>
            <input disabled type="file" name="file" class="form-control" accept=".csv, .txt">
        </div>

        <button style="background: gray;" type="submit" class="btn btn-primary">Insert Data</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check the initial state of the checkbox
            toggleInputs();

            // Toggle inputs when the checkbox state changes
            $('#methodSwitch').change(function() {
                toggleInputs();
            });

            function toggleInputs() {
                // Get the state of the checkbox
                var isChecked = $('#methodSwitch').prop('checked');

                // Enable or disable the textarea and file input based on the checkbox state
                $('textarea[name="detail_modules_data"]').prop('disabled', isChecked);
                $('input[name="file"]').prop('disabled', !isChecked);
            }
        });
    </script>
</div>
@endsection