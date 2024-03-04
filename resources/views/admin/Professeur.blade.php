<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
    <div class="text-center">
        <h2 text-center>Les Professeur</h2>

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
        <div class="col-md">
            <div class="form-floating">
                <select name="stratu" id="stratu" class="form-control" required>
                    <option value="%">All</option>
                    <option value="valid">Complet </option>
                    <option value="not_Valide">Incomplet </option>
                </select>
                <label for="floatingSelectGrid">Statu</label>
            </div>
        </div>
    </div>

    <hr>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-12">
                <button id="downloadAll" class="btn btn-primary mb-3 float-start">Tout télécharger</button>
                <button id="downloadByProfesseur" class="btn btn-primary mb-3 float-end">Télécharger par Professeur</button>

            </div> -->

            <div class="col-md-12">
                <div class="col-auto">
                    <button id="save-pdf-button" class="btn btn-success mb-3">Enregistrer au format PDF</button>
                    <input type="checkbox" class="btn-check mb-3" id="btncheck1" autocomplete="off">
                    <label class="btn btn-outline-primary mb-3" for="btncheck1">utiliser les couleur</label>
                </div>
                <form class="row g-3 d-none">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input type="text" class="form-control" id="staticEmail2" placeholder="email@example.com">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Password</label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary mb-3">vérifier la connexion</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">envoyer pour chaque</button>
                    </div>

                </form>
                <table id="reclamation-table" class="table  text-center table-striped table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th><input type="checkbox" id="toggleAll"></th>
                            <th>Professeur</th>
                            <th>Réclamation est en cours</th>
                            <th>Réclamation valide</th>
                            <th>Réclamation totale</th>

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
            max-width: 200px;
            /* Set your desired max-width */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;

        }

        tr td:nth-child(2),

        tbody tr td:hover {
            white-space: normal;
            overflow: visible;

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
    <script src="/js/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script>
        window.jsPDF = window.jspdf.jsPDF;
        document.getElementById('save-pdf-button').addEventListener('click', function() {
            // Get the table element
            var table = document.getElementById('reclamation-table');

            // Initialize the PDF document
            var doc = new jsPDF("p", "mm", "a4");

            // Add the header and get its height
            var headerHeight = addHeader(doc);

            // Add margin top for the table
            var marginTop = headerHeight;
            var options = {
                startY: marginTop
            };

            // Add the HTML content of the table to the PDF
            doc.autoTable({
                html: table,
                ...options
            });

            // Save the PDF file
            doc.save('reclamation_table.pdf');
        });

        function addHeader(doc) {
            // Add Ministry logo
            var imgData = '/img/ministry-logo-ar.png';
            doc.addImage(imgData, 'PNG', 0, 10, 210, 0); // Adjust coordinates and dimensions as neededv
            var h2 = 'Tableau analytique relatif aux données des professeurs et à leurs réclamations';
            var currentDate = new Date().toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            var headerText = 'Date de génération du PDF: ' + currentDate;

            doc.setFontSize(14);
            doc.text(h2, 15, 55);
            doc.text(headerText, 50, 65);
            // Return the height of the added image
            return 80;
        }
        /////////////////////////////////////
        $(document).ready(function() {
            $('#professeurDropdown').change(function() {
                if ($(this).val() === '%') {
                    $('#downloadByProfesseur').show();
                } else {
                    $('#downloadByProfesseur').hide();
                }
            });
            change_reclamations();
            $('#AnneeUniversitaire,#btncheck1, #semesterDropdown, #filiereDropdown, #moduleDropdown, #professeurDropdown,#sessions,#stratu').change(function() {
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
                var currentDate = new Date().toISOString().slice(0, 10); // Get current date in YYYY-MM-DD format

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
                        link.setAttribute('download', 'all-reclamations-' + currentDate + '.csv');
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
                        saveAs(content, 'reclamations' + currentDate + '.zip');
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
                        if (selectedSemester != '%') {
                            $.each(filieres, function(index, filiere) {
                                optionsHtml += '<option value="' + filiere.id + '">' + filiere.NomFiliere;

                                // Include Parcours in parentheses if it's not NULL
                                if (filiere.Parcours !== '') {
                                    optionsHtml += ' (' + filiere.Parcours + ')';
                                }

                                optionsHtml += '</option>';
                            });
                        }
                        // Set the updated options HTML to the dropdown
                        $('#filiereDropdown').html(optionsHtml);
                        var selectedFiliere = $('#filiereDropdown').val();
                        change_module(selectedSemester, selectedFiliere);
                        var selectedmodule = $('#moduleDropdown').val();

                        change_professeurs(selectedmodule);

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
            var optionsHtml = '<option value="%">All</option>';
            if (selectedFiliere == '%') {
                $('#moduleDropdown').html(optionsHtml);

            } else {


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
        }

        function change_reclamations() {
            var AnneeUniversitaire = $('#AnneeUniversitaire').val();
            var module = $('#moduleDropdown').val();
            var semester = $('#semesterDropdown').val();
            var filiere = $('#filiereDropdown').val();
            var professeur = $('#professeurDropdown').val();
            var sessions = $('#sessions').val();
            var stratu = $("#stratu").val();

            // Add cache buster parameter
            var cacheBuster = new Date().getTime(); // or any unique value
            var url = '/fetch-professeur-reclamations/' + AnneeUniversitaire + '/' + module + '/' + semester + '/' + filiere + '/' + professeur + '/' + sessions + '/' + stratu + '?_=' + cacheBuster;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // Clear existing table rows
                    var table = $('#reclamation-table').DataTable();
                    table.clear().draw();

                    // Assuming the data structure is { "professors": [...] }
                    var professors = data.professors;

                    // Populate table with reclamations data
                    $.each(professors, function(index, professor) {
                        // Check if nomGroupe is equal to 0, if yes, replace it with "Aucun"
                        var rowData = [
                            '<input type="checkbox" name="" id="" class="toggleCheckbox">',
                            professor.Nom + ' ' + professor.Prenom,
                            professor.count_not_valid,
                            professor.count_valid,
                            professor.total
                        ];
                        // Add row to the table
                        var row = table.row.add(rowData).draw().node();
                        if ($('#btncheck1').prop('checked')) {
                        // Set row background color based on professor's statistics
                        if (professor.count_valid == professor.total) {
                            $(row).addClass('bg-success'); // Green background
                        } else if (professor.count_valid == 0) {
                            $(row).addClass('bg-danger'); // Red background
                        } else {
                            $(row).addClass('bg-warning'); // Orange background
                        }
                        }
                    });
                }
            });
        }




        function change_professeurs(selectedmodule) {
            if (selectedmodule == '%') {
                $('#professeurDropdown').html('<option value="%">All</option>');

            } else {
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
        }


        //checked all checkbox
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#reclamation-table').DataTable();

            // Event listener for the "Toggle All" checkbox
            $('#toggleAll').on('change', function() {
                // Get the state of the "Toggle All" checkbox
                var isChecked = $(this).prop('checked');

                // Check/uncheck all checkboxes in the DataTable based on the state of the "Toggle All" checkbox
                table.rows().every(function() {
                    $(this.node()).find('.toggleCheckbox').prop('checked', isChecked);
                });
            });
        });


        // Attach the tableToCsv function to the "Save csv" button click event
        // document.getElementById('saveCsvButton').addEventListener('click', tableToCsv);
    </script>
    @endsection