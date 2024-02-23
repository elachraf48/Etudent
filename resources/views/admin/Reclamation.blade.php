<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
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
                    @foreach($AnneeUniversitaire as $AnneeUniversitaires)
                    <option value="{{ $AnneeUniversitaires }}">{{ $AnneeUniversitaires }}</option>
                    @endforeach

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
                <select name="sessions" id="sessions" class="form-control" required>
                    <option value="%" selected>All</option>
                    @foreach($sessions as $session)
                    <option value="{{ $session->id }}">Part Semester: {{ $session->part_semester }} - {{ $session->SESSION }} </option>
                    @endforeach
                </select>
                <label for="floatingSelectGrid">Session Universitaire</label>
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
    <div class="container-fluid">
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
                            <th>Semester</th>
                            <th>Module</th>
                            <th>C.Apogee</th>
                            <th> Étudiant</th>
                            <th>N.Examen</th>
                            <th>Lieu</th>
                            <th> Groupe</th>
                            <th>Sujet</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<style>
tr td:nth-child(10) {
    max-width: 200px; /* Set your desired max-width */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;

}
tr td:nth-child(2) ,tr th:nth-child(2){
    display: none;
}
tbody tr td:hover{
    white-space: normal;
    overflow: visible;

}


</style>


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
            $('#professeurDropdown').change(function() {
                if ($(this).val() === '%') {
                    $('#downloadByProfesseur').show();
                } else {
                    $('#downloadByProfesseur').hide();
                }
            });
            change_reclamations();
            $('#AnneeUniversitaire, #semesterDropdown, #filiereDropdown, #moduleDropdown, #professeurDropdown,#sessions').change(function() {
                change_reclamations();
            });
            $('#reclamation-table').DataTable({
                lengthMenu: [
                    [-1, 10, 25, 50, 100],
                    ["All", 10, 25, 50, 100]
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
                var currentDate = new Date().toISOString().slice(0,10); // Get current date in YYYY-MM-DD format

    var zip = new JSZip();

    // Construct CSV data based on type
    if (type === 'all') {
        var csvContent = '';
        csvContent += '\uFEFF"Professeur","Semester","Module","Code Apogee","Étudiant","Numéro Examen","Lieu","Groupe","Sujet","Observations","Reponse"\n';

        $('#reclamation-table tbody tr').each(function() {
            $(this).find('td').each(function() {
                csvContent += '"' + $(this).text().replace(/"/g, '""') + '",'; // Wrap data in quotes to handle special characters and escape quotes
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
            link.setAttribute('download', 'all-reclamations-'+currentDate+'.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    } else if (type === 'professeur') {
        var headerRow = '\uFEFF"Professeur","Semester","Module","Code Apogee","Étudiant","Numéro Examen","Lieu","Groupe","Sujet","Observations","Reponse"\n';

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
            $(this).find('td').slice(0).each(function(index) {
                if (columnIndex.includes(index)) {
                    rowData.push('"' + $(this).text().replace(/"/g, '""') + '"'); // Wrap data in quotes to handle special characters and escape quotes
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
            saveAs(content, 'reclamations'+currentDate+'.zip');
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

        function change_reclamations() {
            var AnneeUniversitaire = $('#AnneeUniversitaire').val();
            var module = $('#moduleDropdown').val();
            var semester = $('#semesterDropdown').val();
            var filiere = $('#filiereDropdown').val();
            var professeur = $('#professeurDropdown').val();
            var sessions = $('#sessions').val();
            // Add cache buster parameter
            var cacheBuster = new Date().getTime(); // or any unique value
            var url = '/fetch-reclamations/' + AnneeUniversitaire + '/' + module + '/' + semester + '/' + filiere + '/' + professeur + '/' + sessions + '?_=' + cacheBuster;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // Clear existing table rows

                    var table = $('#reclamation-table').DataTable();
                    table.clear().draw();

                    // Assuming the data structure is { "reclamations": [...] }
                    var reclamations = data.reclamations;

                    // Populate table with reclamations data
                    $.each(reclamations, function(index, reclamation) {
                        // Check if nomGroupe is equal to 0, if yes, replace it with "Aucun"
                        var groupe = reclamation.nomGroupe === '0' ? "Aucun" : reclamation.nomGroupe;

                        var rowData = [
                            reclamation.prof_nom + ' ' + reclamation.prof_prenom,
                            reclamation.Semester,
                            reclamation.NomModule,
                            reclamation.CodeApogee,
                            reclamation.Nom + ' ' + reclamation.Prenom,
                            reclamation.NumeroExamen,
                            reclamation.Lieu,
                            groupe, // Use the updated value of groupe
                            reclamation.Sujet,
                            reclamation.observations
                        ];
                        table.row.add(rowData).draw();
                    });



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