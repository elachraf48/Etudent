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
                <div class="col-12 d-flex justify-content-center">
                    <button id="save-pdf-button" class="btn btn-primary mb-3 me-2">Enregistrer PDF</button>
                    <input type="checkbox" class="btn-check mb-3 me-2" id="btncheck1" autocomplete="off">
                    <label class="btn btn-outline-primary mb-3 me-2" for="btncheck1">utiliser les couleur</label>
                    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Envoyer Email</button>
                </div>



                <table id="reclamation-table" class="table  text-center table-striped table-bordered table-responsive-xxl ">
                    <thead>
                        <tr class="table-success">
                            <th><input type="checkbox" id="toggleAll"></th>
                            <th>Professeur</th>
                            <th>Réclamation est en cours</th>
                            <th>Réclamation valide</th>
                            <th>Réclamation totale</th>
                            <th>Email</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- send email -->



    <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Email</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <div class="alert alert-info" id="nembersent" role="alert">coche Le professeur veut lui envoyer un e-mail</div>
            <form class="row g-3" id="connectionForm">
                <!-- <div class="col-auto">
                    <label for="staticEmail2" class="visually-hidden">Email</label>
                    <input type="text" name="Email" class="form-control" id="staticEmail2" placeholder="email@example.com">
                </div>
                <div class="col-12">
                    <label for="inputPassword2" class="visually-hidden">Password</label>
                    <input type="password" name="Password" class="form-control" id="inputPassword2" placeholder="Password">
                </div> -->
                <!--  -->
                
                <div class="row g-2 mt-1  pt-2">
                    <label for="Name" class="clearfix">
                        <span class="float-start">Name </span>
                    </label>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" id="Name" name="Name" class="form-control" require>
                            <label for="floatingSelectGrid">Name</label>

                        </div>
                    </div>
                </div>
                <div class="row g-2 mt-1  pt-2">
                    <label for="Email" class="clearfix">
                        <span class="float-start">Email </span>
                    </label>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" id="Email" name="Email" class="form-control" require>
                            <label for="floatingSelectGrid">Email</label>

                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row g-2 mt-1  pt-2">
                    <label for="Password" class="clearfix">
                        <span class="float-start">Password </span>
                    </label>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" id="Password" name="Password" class="form-control" require>
                            <label for="floatingSelectGrid">Password</label>

                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row g-2 mt-1  pt-2">
                    <label for="subject" class="clearfix">
                        <span class="float-start">subject </span>
                    </label>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" id="subject" name="subject" value="{nbnotvalid} nouvelles réclamation" class="form-control" require>
                            <label for="floatingSelectGrid">subject</label>

                        </div>
                    </div>
                </div>
                <div class="row g-2 mt-1  pt-2">
                    <label for="message" class="clearfix">
                        message
                    </label>
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea require type="text" id="message" rows="10" name="message" class="form-control" style="height: 134px;">Bonjour Professeur {fullname},
vous avez de {nbnotvalid} nouvelles reclamation, veuillez y répondre</textarea>
                            <label for="floatingSelectGrid">message</label>

                        </div>
                    </div>
                </div>
                <!--  -->

                <button type="submit" id="checkConnectionBtn" class="btn btn-primary " disabled>envoyer</button>

            </form>
            <div class="alert alert-success mt-2" role="alert">
                <div class="text-center text-danger fw-bold">Note</div>
                <ul>
                    <ol><span class="text-danger">{fullname}</span> : nom et prenom </ol>
                    <ol><span class="text-danger">{nbnotvalid}</span> : Réclamation est en cours</ol>
                    <ol><span class="text-danger">{nbvalid}</span> : Réclamation valide</ol>
                    <ol><span class="text-danger">{nbtotal}</span> : Réclamation totale</ol>
                </ul>
            </div>
        </div>

    </div>
    <style>
        tr td:nth-child(6),
        tr th:nth-child(6) {
            display: none;

        }

        #offcanvasExample {
            min-width: 50vw;
        }
    </style>


    <!-- Add a textarea for pasting data -->



    <!-- Add DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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
            $(document).ready(function() {
                // Add event listener to the document for changes in checkboxes within the table body
                $(document).on('change', '#reclamation-table  input[type="checkbox"]', function() {
                    // Get the number of checked checkboxes within the table body
                    var numChecked = $('#reclamation-table tbody input[type="checkbox"]:checked').length;
                    var btn = $('#checkConnectionBtn');
                    // Update the content of the #nembersent div with the count
                    $('#nembersent').text('Des messages seront envoyés aux ' + numChecked + ' professeurs');
                    if (numChecked === 0) {
                        btn.prop('disabled', true); // Disable the button
                    } else {
                        btn.prop('disabled', false); // Enable the button
                    }
                });
            });

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
                            professor.total,
                            professor.Email

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

        $(document).ready(function() {
            $('#checkConnectionBtn').on('click', function(event) {
                event.preventDefault(); // Prevent form submission

                // Iterate through each checked checkbox within the table body
                $('#reclamation-table tbody input[type="checkbox"]:checked').each(function() {
                    // Find the corresponding row data
                    var rowData = [];
                    $(this).closest('tr').find('td').not(':first-child').each(function() {
                        rowData.push($(this).text().trim());
                    });
                    sendRowData(rowData);
                    // $('#nembersent').text('messages  envoyés au professeurs ' + rowData[0] + ' ');


                    // Send an AJAX request for each row's data
                    //  sendRowData(rowData);
                });
            });
            // Add event listener to the "vérifier la connexion" button
            function sendRowData(rowData) {
                var formData = {
                    Email: $('#Email').val(),
                    Password: $('#Password').val(),
                    Message: $('#message').val(),
                    Subject: $('#subject').val(),
                    Name: $('#Name').val(),
                    RowData: rowData

                };
                $.ajax({
                    url: '/check-connection', // Replace with your endpoint for connection check
                    method: 'GET',
                    data: formData, // Pass form data to the server

                    success: function(response) {
                        // Handle success response
                        $('#nembersent').text('messages  envoyés au professeurs ' + rowData[0] + ' ');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        $('#nembersent').text('Connection failed! Error ' + error);
                    }
                });
            };
        });
    </script>
    @endsection