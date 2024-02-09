<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container p-3">
    <div class="text-center">
        <h2 text-center>Les Réclamations</h2>

    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <div class="row g-2 mt-1 mb-2">
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
        <div class="col-md">
            <div class="form-floating">
                <select name="semester" id="semesterDropdown" class="form-control" required>
                    <option value="%">All</option>
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
                    <option value="%" selected>All</option>
                </select>
                <label for="floatingSelectGrid">Filiere</label>
            </div>
        </div>


        <div class="col-md">
            <div class="form-floating">
                <select name="module" id="moduleDropdown" class="form-control" required>
                    <option value="%">All</option>

                </select>
                <label for="floatingSelectGrid">Module</label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating">
                <select name="professeur" id="professeurDropdown" class="form-control" required>
                    <option value="%">All</option>
                </select>
                <label for="floatingSelectGrid">Professeur</label>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button id="downloadAll" class="btn btn-primary mb-3 float-start">Tout télécharger</button>
                <button id="downloadByProfesseur" class="btn btn-primary mb-3 float-end">Télécharger par Professeur</button>

            </div>
            <div class="col-md-12">
                <table id="reclamation-table" class="table ">
                    <thead>
                        <tr>
                            <th> Professeur</th>
                            <th>Module</th>
                            <th>Code Apogee</th>
                            <th> Étudiant</th>
                            <th>Numéro Examen</th>
                            <th>Lieu</th>
                            <th> Groupe</th>
                            <th>Sujet</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr style="max-height: 100px;overflow: hidden;
    transition: max-height 0.3s ease;">
                            <td>{{ $item->prof_nom }} {{ $item->prof_prenom }}</td>
                            <td>{{ $item->NomModule }}</td>
                            <td>{{ $item->CodeApogee }}</td>
                            <td>{{ $item->etudiant_nom }} {{ $item->etudiant_prenom }}</td>
                            <td>{{ $item->NumeroExamen }}</td>
                            <td>{{ $item->Lieu }}</td>
                            <td>{{ $item->nomGroupe }}</td>
                            <td>{{ $item->Sujet }}</td>
                            <td>{{ $item->observations }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Add a textarea for pasting data -->



    <!-- Add DataTables JS -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <!-- FileSaver.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reclamation-table').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                // Other DataTables options...
            });

            $('#downloadAll').click(function() {
                downloadCSV('all');
            });

            $('#downloadByProfesseur').click(function() {
                downloadCSV('professeur');
            });

            function downloadCSV(type) {
                var zip = new JSZip();

                // Construct CSV data based on type
                if (type === 'all') {
                    var csvContent = '';
                    csvContent += '\uFEFFProfesseur,Module,Code Apogee, Étudiant,Numéro Examen,Lieu, Groupe,Sujet,Observations\n';
                    $('#reclamation-table tbody tr').each(function() {

                        $(this).find('td').each(function() {
                            csvContent += $(this).text() + ',';
                        });
                        csvContent += '\n';
                    });
                    var blob = new Blob([csvContent], {
                        type: 'text/csv;charset=utf-8;'
                    });
                    var link = document.createElement('a');
                    if (link.download !== undefined) { // feature detection
                        var url = URL.createObjectURL(blob);
                        link.setAttribute('href', url);
                        link.setAttribute('download', 'all-reclamations.csv');
                        link.style.visibility = 'hidden';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                } else if (type === 'professeur') {

                    var headerRow = "\uFEFFModule,Code Apogee, Étudiant,Numéro Examen,Lieu, Groupe,Sujet,Observations\n";
                    var columnIndex = [];
                    $('#reclamation-table thead tr th').each(function(index) {
                        var columnName = $(this).text();
                        if (columnName !== 'Professeur') {
                            columnIndex.push(index);
                        }
                    });

                    var professeurs = {};
                    $('#reclamation-table tbody tr').each(function() {
                        var professeur = $(this).find('td:eq(0)').text();
                        if (!professeurs[professeur]) {
                            professeurs[professeur] = [];
                        }
                        var rowData = [];
                        $(this).find('td').slice(1).each(function(index) {
                            if (columnIndex.includes(index)) {
                                rowData.push($(this).text());
                            }
                        });
                        professeurs[professeur].push(rowData.join(','));
                    });

                    for (var prof in professeurs) {
                        zip.file(prof.replace(/\s+/g, '-') + '.csv', headerRow + professeurs[prof].join('\n'));
                    }
                    zip.generateAsync({
                        type: 'blob'
                    }).then(function(content) {
                        saveAs(content, 'reclamations.zip');
                    });
                }


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
                        var optionsHtml = '<option value="%">All</option>';

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
            $('#filiereDropdown').change(function() {
            var selectedSemester = $('#semesterDropdown').val();
            var selectedFiliere = $('#filiereDropdown').val();
            change_module(selectedSemester, selectedFiliere);
            // Make an Ajax request to fetch modules based on the selected semester and filiere


        });
        $('#moduleDropdown').change(function() {
            var selectedmodule = $('#moduleDropdown').val();
            change_professeurs(selectedmodule);
            // Make an Ajax request to fetch modules based on the selected semester and filiere


        });

        });
        function change_module(selectedSemester, selectedFiliere) {
        $.ajax({
            url: '/fetch-modules/' + selectedFiliere,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var modules = data.modules;

                // Update the dropdown options
                var optionsHtml = '<option value="%">All</option>';
                $.each(modules, function(index, module) {
                    optionsHtml += '<option value="' + module.id + '">' + module.NomModule + '</option>';
                });

                // Set the updated options HTML to the dropdown
                $('#moduleDropdown').html(optionsHtml);
            }
        });
    }
    function change_professeurs(selectedmodule) {

        $.ajax({
            url: '/fetch-professeur/' + selectedmodule,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var professeurs = data.professeurs;
                var optionsHtml = '';

                // Update the dropdown options
                $.each(professeurs, function(index, professeur) {
                    optionsHtml += '<option value="' + professeur.id + '">' + professeur.Nom + ' ' + professeur.Prenom + '</option>';
                });
                optionsHtml = '<option value="%">All</option>' + optionsHtml;

                // Set the updated options HTML to the dropdown
                $('#professeurDropdown').html(optionsHtml);
            }
        });
    }


        


        // Attach the tableToCsv function to the "Save csv" button click event
        // document.getElementById('saveCsvButton').addEventListener('click', tableToCsv);
    </script>
    @endsection