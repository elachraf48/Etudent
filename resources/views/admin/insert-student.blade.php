<!-- resources/views/admin/insert-student.blade.php -->

@extends('dashboard')

@section('content')
<div class="container p-3">
    <h2>Insert Student Data</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('process_student_data') }}" enctype="multipart/form-data">
        @csrf

        
        <div class="row g-2 mt-1 p-1">

            <div class="col-md">
                <div class="form-floating">
                    <select name="semester" id="semesterDropdown" class="form-control" required>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="S4">S4</option>
                        <option value="S5">S5</option>
                        <option value="S6">S6</option>
                    </select>
                    <label for="floatingSelectGrid">Semester</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="filiere" id="filiereDropdown" class="form-control" required>
                        @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }}
                            @if($filiere->Parcours!=NULL)
                            {({{ $filiere->Parcours }})}
                            @endif
                        </option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">Filiere</label>
                </div>
            </div>
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
                        <!-- <option value="" disabled selected>Select Session</option> -->
                        @foreach($sessions as $session)
                        <option value="{{ $session->id }}">Session: {{ $session->part_semester }} -
                            @if($session->SESSION == 'ORD')
                            Ordinaire
                            @else
                            Rattrapage
                            @endif
                        </option>
                        @endforeach

                    </select>
                    <label for="floatingSelectGrid">Session Universitaire</label>
                </div>
            </div>

        </div>
        <div class="col-md mb-2">
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" role="switch" id="groupe" name="groupe">
                    <label class="form-check-label" for="groupe">Aucun groupe</label>
                </div>
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" role="switch" id="nbexamen" name="nbexamen">
                    <label class="form-check-label" for="nbexamen">auto generet Numéro d'examen</label>
                </div> 
                <div id="num"  class="inline" style="display: none;">
                <span class="">strat from</span>
                <input name="num" type="number" class="" value="1">
                </div>
                
        </div>
        <div class="mb-3">
            <textarea name="student_data" class="form-control" rows="10" required placeholder="Code Apogee,Nom,Prénom,Date Naiss,LIEU,Numéro d'examen,GROUPE"></textarea>
        </div>
<!-- Add a switch button for choosing the method -->
<div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch">
            <label class="form-check-label" for="methodSwitch">Upload CSV or TXT File</label>
        </div>
        <!-- Add a file input for uploading a CSV or TXT file -->
<div class="input-group mb-3">
  <input type="file" class="form-control" name="file" id="inputGroupFile02" accept=".csv, .txt">
  <label class="input-group-text" for="inputGroupFile02">Upload</label>
</div>
      
        <button style="background: gray;" type="submit" class="btn btn-primary">Insert Data</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                $('textarea[name="student_data"]').prop('disabled', isChecked);
                $('input[name="file"]').prop('disabled', !isChecked);
            }

            // Event listener for changes in the semester dropdown
            $('#semesterDropdown').change(function() {
                var selectedSemester = $(this).val();

                // Make an Ajax request to fetch filieres based on the selected semester
                $.ajax({
                    url: '/fetch-filieres/' + selectedSemester,
                    type: 'GET',
                    success: function(data) {
                        // Assuming the data structure is { "filieres": [...] }
                        var filieres = data.filieres;

                        // Update the dropdown options
                        var optionsHtml = '';
                        $.each(filieres, function(index, filiere) {
                            optionsHtml += '<option value="' + filiere.id + '">' + filiere.NomFiliere;

                            // Include Parcours in parentheses if it's not NULL
                            if (filiere.Parcours !=='') {
                                optionsHtml += ' (' + filiere.Parcours + ')';
                            }

                            optionsHtml += '</option>';
                        });

                        // Set the updated options HTML to the dropdown
                        $('#filiereDropdown').html(optionsHtml);
                    }
                });

            });
            $('#groupe, #nbexamen').change(function() {
                var groupeChecked = $('#groupe').prop('checked');
                var nbexamenChecked = $('#nbexamen').prop('checked');

                if (groupeChecked && nbexamenChecked) {
                    $('textarea[name="student_data"]').attr('placeholder', "Code Apogee,Nom,Prénom,Date Naiss,LIEU");
                    $("#num").css("display", "block");
                } else if (groupeChecked) {
                    $('textarea[name="student_data"]').attr('placeholder', "Code Apogee,Nom,Prénom,Date Naiss,LIEU,Numéro d'examen");
                    $("#num").css("display", "none");

                } else if (nbexamenChecked) {
                    $('textarea[name="student_data"]').attr('placeholder', "Code Apogee,Nom,Prénom,Date Naiss,LIEU,GROUPE");
                    $("#num").css("display", "block");

                } else {
                    $('textarea[name="student_data"]').attr('placeholder', "Code Apogee,Nom,Prénom,Date Naiss,LIEU,Numéro d'examen,GROUPE");
                    $("#num").css("display", "none");

                }
            });
        });
    </script>
</div>
@endsection