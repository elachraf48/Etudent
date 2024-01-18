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

        <div class="row g-2 mt-1 mb-2">

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
                            @if($filiere->Parcours!='NULL')
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
                        <option value="{{ $session->id }}">Semester: {{ $session->part_semester }} - Session
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
        <!-- Add a textarea for pasting data -->
        <div name="tab" class="modal-body table-responsive" style="font-size: 80%;"></div>
        <div class="mb-3">

            <input type="hidden" name="id_module">
            <textarea name="detail_modules_data" class="form-control" rows="10" required placeholder="Numéro d'examen,Code Apogee,Nom,Prénom,Date Naiss,LIEU,code FILIERE,Semester,GROUPE"></textarea>
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch">
            <label class="form-check-label" for="methodSwitch">Use File checked</label>
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
            function change_module(selectedSemester, selectedFiliere) {
                $.ajax({
                    url: '/fetch-modules/' + selectedFiliere,
                    type: 'GET',
                    success: function(data) {
                        // Assuming the data structure is { "modules": [...] }
                        var modules = data.modules;

                        // Generate HTML for the table

                        var tableHtml = '<table class="table table-bordered table-dark">';
                        tableHtml += '<tbody>';
                        tableHtml += '<tr>';
                        tableHtml += '<td>code apogee</td>';

                        // Loop through the modules and add rows to the table
                        $.each(modules, function(index, module) {
                            tableHtml += '<td value=' + module.id + '>' + module.NomModule + '</td>';
                        });

                        tableHtml += '</tr>';
                        tableHtml += '</tbody></table>';

                        // Set the updated table HTML to the modal body
                        $('.modal-body').html(tableHtml);

                        var codeApogee = "code apogee "; // Replace with the actual code apogee value
                        var moduleIds = modules.map(function(module) {
                            return module.id;
                        });

                        // Set the placeholder of the textarea
                        $('textarea[name="detail_modules_data"]').attr('placeholder', codeApogee + ',module ' + moduleIds.join(',module '));
                        $('input[name="id_module"]').val(moduleIds.join(','));


                    }
                });
            }


            change_module($('#semesterDropdown').val(), $('#filiereDropdown').val());

            $('#filiereDropdown').change(function() {
                change_module($('#semesterDropdown').val(), $('#filiereDropdown').val());
            });
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
            //filier show after change semester
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

                            // Include Parcours in parentheses if it's not 'NULL'
                            if (filiere.Parcours !== 'NULL') {
                                optionsHtml += ' (' + filiere.Parcours + ')';
                            }

                            optionsHtml += '</option>';
                        });

                        // Set the updated options HTML to the dropdown
                        $('#filiereDropdown').html(optionsHtml);
                        var selectedFiliere = $('#filiereDropdown').val();

                        // Make an Ajax request to fetch modules based on the selected filiere
                        change_module(selectedSemester, selectedFiliere);
                    }
                });
            });

        });
    </script>
</div>
@endsection