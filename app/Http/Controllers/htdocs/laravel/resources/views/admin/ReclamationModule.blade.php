<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
    <div class="text-center p-3">
        <h2>Parameter Reclamation Module</h2>

    </div>

    <hr>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <div class="row g-2  mb-2">


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
                <select name="stratu" id="stratu" class="form-control" required>
                    <option value="%">All</option>
                    <option value="Y">active </option>
                    <option value="N">désactivé </option>
                </select>
                <label for="floatingSelectGrid">Statu</label>
            </div>
        </div>

    </div>

    <hr>


    <table id="module-table" class="table table-striped table-bordered text-center ">
        <thead>
            <tr class="table-success">
                <th>Nom de Filiere</th>
                <th>Nom de module</th>
                <th>Semester</th>
                <!-- <th>Status</th> -->
                <th>dernière mise à jour</th>
                <th>Actions</th>
            </tr>
            <tr>
                <th colspan="5" id="spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-border text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </th>
            </tr>

        </thead>

</div>
<tbody class="d-none" id="module-body">
    @foreach($parameters as $parameter)
    <tr>
        <td>{{ $parameter->filiere->NomFiliere }}
            @if($parameter->filiere->Parcours!='')
            ({{ $parameter->filiere->Parcours }})
            @endif
        </td>
        <td>{{ $parameter->NomModule }}</td>
        <td> {{ $parameter->Semester }}</td>
        <!-- <td>
                    <select class="form-control" id="status" name="status" required>
                        <option value="true" {{ $parameter->statu == 'Y' ? 'selected' : '' }}>active</option>
                        <option value="false" {{ $parameter->statu == 'N' ? 'selected' : '' }}>désactivé</option>
                    </select>
                </td> -->
        <td>{{ $parameter->updated_at}}</td>


        <td>
            <button class="btn btn-primary update-parameter-btn w-75" data-id="{{ $parameter->id }}">
                {{ $parameter->statu == 'Y' ? 'désactivé' : 'active' }}
            </button>
        </td>
    </tr>
    @endforeach
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

<div class="modal modale" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-3" style="border: 3px solid red; margin-top: 30vh;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-bodyy">
                <p>Etes-vous sûr ? La dernière mise à jour a eu lieu y'a moins de trois jours. </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
                <button type="button" class="btn btn-success" id="confirm-submit-btn">Valider</button>
            </div>
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
    $(document).ready(function() {

        change_module();
        $(' #semesterDropdown, #filiereDropdown,#stratu').change(function() {
            var body = $('#module-body');
            var spinner = $('#spinner');

            body.addClass('d-none');
            spinner.removeClass('d-none');
            change_module();
        });
        $('#module-table').DataTable({
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
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

                    // Make an Ajax request to fetch modules based on the selected filiere
                }
            });
        });

    });
    $(document).on('click', '.update-parameter-btn', function() {
        const row = this.closest('tr');
        var date = row.querySelectorAll('td')[3].textContent;
        var targetDate = new Date(date.replace(/-/g, '/'));
        var differenceInDays = Math.floor((new Date() - targetDate) / (1000 * 60 * 60 * 24));
        var id = this.getAttribute('data-id');
        if (differenceInDays <= 3 && this.textContent == "désactivé") {

            $('.modale').modal('show');
            $('#confirm-submit-btn').click(function() {

                $.ajax({
                    url: '/admin/Reclamation/module/', // Use reclamationId here
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        change_module()
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching reclamation details:', error);
                        // Handle error if necessary
                    }

                });
                $('.modale').modal('hide');
            });

        } else {
            $.ajax({
                url: '/admin/Reclamation/module/', // Use reclamationId here
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    change_module()
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reclamation details:', error);
                    // Handle error if necessary
                }
            });
        }
    });


    //
    function change_module() {
        var semester = $('#semesterDropdown').val();
        var filiere = $('#filiereDropdown').val();
        var stratu = $("#stratu").val();
        // Add cache buster parameter
        var cacheBuster = new Date().getTime(); // or any unique value
        var url = '/fetch-reclamations-modules/' + semester + '/' + filiere + '/' + stratu + '?_=' + cacheBuster;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                // Clear existing table rows
                var body = $('#module-body');
                var spinner = $('#spinner');
                var table = $('#module-table').DataTable();
                table.clear().draw();

                // Assuming the data structure is { "reclamations": [...] }
                var modules = data.modules;

                // Populate table with reclamations data
                $.each(modules, function(index, module) {
                    // Check if nomGroupe is equal to 0, if yes, replace it with "Aucun"
                    var buttonLabel = module.statu == 'Y' ? 'désactivé' : 'active';
                    var buttonClass = module.statu == 'Y' ? 'btn-danger' : 'btn-primary';
                    const formattedDate = new Date(module.updated_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false // Use 24-hour format
                    });
                    var buttonHtml = '<button style="width:5vw;min-width:40px" class="btn ' + buttonClass + ' update-parameter-btn w-75"  data-id="' + module.id + '">' + buttonLabel + '</button>';
                    var Parcours = module.filiere.Parcours == '' ? '' : ' (' + module.filiere.Parcours + ')';
                    var rowData = [
                        module.filiere.NomFiliere + '' + Parcours,
                        module.NomModule,
                        module.Semester,

                        formattedDate,
                        buttonHtml

                    ];
                    table.row.add(rowData).draw();
                });
                spinner.addClass('d-none');
                body.removeClass('d-none');



            }

        });
    }
</script>

@endsection