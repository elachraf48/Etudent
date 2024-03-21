<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
    <div class="text-center p-3">
        <h2>Module</h2>

    </div>
    <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajoute Module</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="col-md ">
                            <div class="form-floating">
                                <select name="semester" id="semesterDropdown" class="form-control" required>
                                    <option value="" disabled selected>Choisissez Semester</option>
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
                        <div class="col-md my-2">
                            <div class="form-floating">
                                <select name="filiere" id="filiereDropdown" class="form-control" required>
                                    <option disabled selected>Choisissez d'abord semester</option>
                                </select>
                                <label for="floatingSelectGrid">Filiere</label>
                            </div>
                        </div>
                        <div class="col-md ">
                            <div class="form-floating">
                                <input type="text" name="codemodule" id="moduleDropdown" placeholder="code module" class="form-control" required>

                                <label for="floatingSelectGrid">Code Module</label>
                            </div>
                        </div>
                        <p class="text-secondary"> exemple Code Module : FDS1M1</p>
                        <div class="col-md my-2">
                            <div class="form-floating">
                                <input type="text" name="module" id="moduleDropdown" placeholder="name module" class="form-control " required>

                                <label for="floatingSelectGrid">Nom Module</label>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary w-100">Ajoute</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
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
    <hr>
    <div class="row g-2  mb-2">
        <div class="col-md">
            <div class="form-floating">
                <select name="semester" id="semesterDropdowntable" class="form-control" required>
                    <option value="%">All</option>
                    <option value="S1" selected>S1</option>
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
                <select name="filiere" id="filiereDropdowntable" class="form-control " required>
                    @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }} @if($filiere->Parcours != '') {{ $filiere->Parcours }} @endif</option>

                    @endforeach
                </select>
                <label for="floatingSelectGrid">Filiere</label>
            </div>
        </div>

    </div>
    <hr>
    <table id="reclamation-table" class="table table-striped table-bordered text-center">
        <thead>
            <tr class="table-success">
                <th>Semester</th>
                <th>Filier</th>
                <th>Parcours</th>
                <th>Module</th>
                <th>Action
                    <button class="btn btn-success  " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajoute <i class="fa-solid fa-plus"></i></button>

                </th>

            </tr>

        </thead>
        <tbody>
           
        </tbody>
    </table>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
        <div id="liveToast" class="toast bg-success " role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">

                <strong class="me-auto">mis à jour</strong>
                <small>il y a 1 minutes</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>



    <!-- Add a textarea for pasting data -->



    <!-- Add DataTables JS -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- FileSaver.js -->
    <script>
        $('#semesterDropdowntable').change(function() {
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
                    $('#filiereDropdowntable').html(optionsHtml);

                    var selectedSemestere = $('#semesterDropdowntable').val();
                    var selectedFiliere = $('#filiereDropdowntable').val();
                    change_module(selectedSemestere,selectedFiliere);
                    // Make an Ajax request to fetch modules based on the selected filiere
                }
            });
        });
        $('#filiereDropdown').change(function() {
                var selectedSemester = $('#semesterDropdowntable').val();
                var selectedFiliere = $('#filiereDropdowntable').val();
                change_module(selectedSemester,selectedFiliere);
                // Make an Ajax request to fetch modules based on the selected semester and filiere


            });
        function change_module(selectedSemester,selectedFiliere) {
            
            // Make an Ajax request to fetch modules based on the selected semester and filiere
            var cacheBuster = new Date().getTime(); // or any unique value
            var url = '/fetch-module-table/' + selectedSemester + '/' + selectedFiliere + '?_=' + cacheBuster;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // Clear existing table rows

                    var table = $('#reclamation-table').DataTable();
                    table.clear().draw();

                    // Assuming the data structure is { "reclamations": [...] }
                    var modules = data.modules;

                    // Populate table with reclamations data
                    $.each(modules, function(index, module) {
                        // Check if nomGroupe is equal to 0, if yes, replace it with "Aucun"
                        var Parcours = module.filiere.Parcours === '' ? "Aucun" : module.filiere.Parcours;
                        // var Repense = reclamation.Repense === '' ? "No Repense" : reclamation.Repense;
                        var moduler='<input class="form-control" type="text" id="Module" name="Module" value="'+module.NomModule+'" required>';
                        var button='<button class="btn btn-primary update-parameter-btn" data-id="'+ module.id +'">Mettre à jour</button>';
                        var rowData = [
                            module.Semester ,
                            module.filiere.NomFiliere,
                            Parcours,
                            moduler,
                            button

                        ];
                        table.row.add(rowData).draw();
                    });



                }
            });

        }
      

        change_module($('#semesterDropdowntable').val(),$('#filiereDropdowntable').val());
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
                    var optionsHtml;
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

                    // Make an Ajax request to fetch modules based on the selected filiere
                }
            });
        });

        $(document).on('click', '.update-parameter-btn', function() {

            // Retrieve data from the table row
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const date = row.querySelector('input[name="last_date"]').value;
            const statu = row.querySelector('select[name="status"]').value;
            $.ajax({
                url: "{{ route('parameter_edit') }}",
                type: 'POST',
                dataType: 'json', // Ensure the server returns valid JSON
                data: {
                    id: id,
                    date: date,
                    statu: statu,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response (e.g., display a success message)
                    // console.log('Parameter updated successfully');
                    var toastContainer = document.querySelector('.toast-container');
                    var liveToast = document.querySelector('#liveToast');
                    liveToast.querySelector('.toast-body').textContent = 'Paramètre mis à jour avec succès';
                    var bsToast = new bootstrap.Toast(liveToast);
                    bsToast.show();
                    var alertElement = $('<div class="alert alert-success  alert-dismissible fade show" role="alert" style="position: fixed;     top:20px;">' +
                        '<strong>succès !</strong> "Paramètre mis à jour avec succès !"<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');
                    $('body').append(alertElement);

                    // Automatically dismiss the alert after 5 seconds
                    setTimeout(function() {
                        alertElement.alert('close');
                    }, 5000);

                },
                error: function(xhr, status, error) {
                    // Provide a user-friendly error message
                    console.error(error); // Log the error for debugging
                    alert('An error occurred while updating the parameter. Please try again.');
                }
            });
        });
    </script>

    @endsection