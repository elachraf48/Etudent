<!-- resources/views/admin/Calendrier_modules.blade.php -->

@extends('dashboard')

@section('content')

<div class="container p-5">
    <h2>Insert Calendrier Modules Data</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('Calendrier_modules_form') }}">
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
                        <option value="" disabled selected>Select Session</option>
                        @foreach($sessions as $session)
                        <option value="{{ $session->id }}">Part Semester: {{ $session->part_semester }} - {{ $session->SESSION }} </option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">Session Universitaire</label>
                </div>
            </div>



        </div>
        <!-- Add a textarea to paste the data -->
        <div class="mb-3">
            <textarea name="cld_mod_data" class="form-control" rows="10" placeholder="Module , Jour , Horaire , group" required></textarea>
        </div>

        <button style="background: gray;" type="submit" class="btn btn-primary">Insert Data</button>
        <button type="button" style="color:green;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal()">
            Show model
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" style="color:red;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" style="color:green;" class="btn btn-primary" id="saveCsvButton">Save csv</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- ... Your existing HTML code ... -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
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

                        // Include Parcours in parentheses if it's not 'NULL'
                        if (filiere.Parcours !== 'NULL') {
                            optionsHtml += ' (' + filiere.Parcours + ')';
                        }

                        optionsHtml += '</option>';
                    });

                    // Set the updated options HTML to the dropdown
                    $('#filiereDropdown').html(optionsHtml);
                }
            });

        });


    });

    function openModal() {
        var selectedSemester = $('#semesterDropdown').val();
        var selectedFiliere = $('#filiereDropdown').val();
        var selectedFiliereName = $('#filiereDropdown :selected').text();
        // Make an Ajax request to fetch module data based on the selected semester and filiere
        $.ajax({
            url: '/fetch-modules/' + selectedFiliere,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var modules = data.modules;

                // Generate HTML for the table
                var tableHtml = '<table class="table">';
                tableHtml += '<thead><tr><th>Code Module</th><th>Module Name</th></tr></thead>';

                tableHtml += '<tbody>';

                // Loop through the modules and add rows to the table
                $.each(modules, function(index, module) {
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + module.CodeModule + '</td>';
                    tableHtml += '<td>' + module.NomModule + '</td>';
                    tableHtml += '</tr>';
                });

                tableHtml += '</tbody></table>';

                // Set the updated table HTML to the modal body
                $('.modal-body').html(tableHtml);
                $('#exampleModalLabel').text('Filiere :' + selectedFiliereName + ' | Semester :' + selectedSemester);

                // Show the modal
                $('#exampleModal').modal('show');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error fetching modules:', errorThrown);
            }
        });
    }

    function tableToCsv() {
        // Select the table
        var table = document.querySelector('.table');

        // Get the additional information
        var filiereInfo = 'Filiere :' + $('#filiereDropdown :selected').text();
        var semesterInfo = 'Semester :' + $('#semesterDropdown').val();

        // Initialize the CSV content with UTF-8 BOM
        var csvContent = ['\uFEFF'];

        // Add the additional information to specific cells
        csvContent.push('"' + filiereInfo + '","' + semesterInfo + '"');

        // Initialize the CSV content with UTF-8 BOM and additional information

        // Loop through rows and columns to populate the CSV array
        table.querySelectorAll('tr').forEach(function(row) {
            var rowData = [];
            row.querySelectorAll('td').forEach(function(cell) {
                rowData.push('"' + cell.innerText.replace(/"/g, '""') + '"');
            });
            csvContent.push(rowData.join(','));
        });

        // Combine rows into a CSV string
        var csvString = csvContent.join('\n');

        // Create a Blob containing the CSV data
        var blob = new Blob([csvString], {
            type: 'text/csv;charset=utf-8;'
        });

        // Create a download link and trigger a click to download the file
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'module_data.csv';
        link.click();
    }

    // Attach the tableToCsv function to the "Save csv" button click event
    document.getElementById('saveCsvButton').addEventListener('click', tableToCsv);
</script>


@endsection