<!-- resources/views/admin/insert-student.blade.php -->

@extends('dashboard')

@section('content')
<div class="container p-3">
    <h2>Insert Professeurs Data</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form id="form" method="POST" action="{{ route('bulk_professeurs_process') }}" enctype="multipart/form-data">
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
                        $currentYear = date('Y');
                        for ($i = 1; $i < 4; $i++) {
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
            <div class="form-check form-switch form-check-inline">
                <input class="form-check-input" type="checkbox" role="switch" id="groupe" name="groupe">
                <label class="form-check-label" for="groupe">Aucun groupe</label>
            </div>


        </div>
        <!-- Add a textarea for pasting data -->

        <div class="mb-3">

            <textarea name="bulk_professeurs_data" class="form-control" rows="10" required placeholder="Code Module ,Nom ,Prénom ,GROUPE "></textarea>
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch">
            <label class="form-check-label" for="methodSwitch">Pour Utiliser le fichier coché</label>
        </div>
        <!-- Add a file input for uploading a CSV or TXT file -->
        <div class="mb-3">
            <label for="file" class="form-label">Téléchargez un fichier CSV ou TXT :</label>
            <input disabled type="file" name="file" class="form-control" accept=".csv, .txt">
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="delele_old" name="delele_old" checked>
            <label class="form-check-label" for="delele_old">Souhaitez-vous supprimer des informations avant d'entrer ?</label>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Module</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" style="color:red;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveCsvButton">Save csv</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- confirmation delete old data -->
        <div class="modal" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content " style="border: 3px solid red; margin-top: 40vh;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-bodyy">
                        <label class="form-check-label clearfix" for="flexSwitchCheckDefault">
                            <span class="float-start">Toutes les informations sont-elles correctes ? </span><br>
                            <span class="float-end"> هل جميع المعلومات صحيحة ؟</span>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler <br>الغاء</button>
                        <button type="button" class="btn btn-success" id="confirm-submit-btn">Valider<br> تأكيد</button>
                    </div>
                </div>
            </div>
        </div>
        <button id="insertDataButton" type="submit" class="btn btn-primary">Insérer des données</button>
        <button type="button" class="btn btn-success" onclick="saveAsCSV()">exemple CSV</button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal()">Afficher le modèle</button>

    </form>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $('#insertDataButton').click(function(event) {
            event.preventDefault(); // Prevent default form submission
            var isValide = $('#delele_old').prop('checked');
            var textareaValue = $('textarea[name="bulk_professeurs_data"]').val();
            var file = $('input[name="file"]').val();

            if (file != '' || textareaValue != '') {
                if (isValide) {


                    // Show the confirmation modal
                    $('#confirmationModal').modal('show');

                    // Event listener for confirm button in the confirmation modal
                    $('#confirm-submit-btn').click(function() {
                        $('#confirmationModal').modal('hide');
                        $('#form').submit();
                    });

                }else{
                    $('#form').submit();
                }
            } else {
                var alertElement = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed;     top:20px;">' +
                    '<strong>Error!</strong> "Please insert data!"<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
                $('body').append(alertElement);

                // Automatically dismiss the alert after 5 seconds
                setTimeout(function() {
                    alertElement.alert('close');
                }, 5000);

            }
        });
        $(document).ready(function() {
            $('#groupe').change(function() {
                var groupeChecked = $('#groupe').prop('checked');

                if (groupeChecked) {
                    $('textarea[name="bulk_professeurs_data"]').attr('placeholder', "Code Module ,Nom ,Prénom ");

                } else {
                    $('textarea[name="bulk_professeurs_data"]').attr('placeholder', "Code Module ,Nom ,Prénom ,GROUPE ");

                }
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
                $('textarea[name="bulk_professeurs_data"]').prop('disabled', isChecked).val('');
$('input[name="file"]').prop('disabled', !isChecked).val('');
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

                            // Include Parcours in parentheses if it's not NULL
                            if (filiere.Parcours !== '') {
                                optionsHtml += ' (' + filiere.Parcours + ')';
                            }

                            optionsHtml += '</option>';
                        });

                        // Set the updated options HTML to the dropdown
                        $('#filiereDropdown').html(optionsHtml);
                        var selectedFiliere = $('#filiereDropdown').val();

                        // Make an Ajax request to fetch modules based on the selected filiere
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
</div>
@endsection