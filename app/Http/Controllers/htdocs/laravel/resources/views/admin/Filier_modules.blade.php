@extends('dashboard')

@section('content')
<div class="container p-3">
    <h2 class="mt-5">Bulk Insert Data</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('Filier_modules_process') }}" enctype="multipart/form-data">
        @csrf

        <!-- Textarea for pasting data -->
        <div class="mb-3">
            <textarea name="data" class="form-control" rows="10" required placeholder="Semester,Code Module,Nom Module,Nom Filiere,Parcours,Code FILIERE"></textarea>
        </div>

        <!-- File input for CSV or TXT file -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="methodSwitch" name="method_switch">
            <label class="form-check-label" for="methodSwitch">Upload CSV or TXT File</label>
        </div>
        <!-- Add a file input for uploading a CSV or TXT file -->
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="file" id="inputGroupFile02" accept=".csv, .txt">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="delele_old" name="delele_old" >
            <label class="form-check-label" for="delele_old">Souhaitez-vous supprimer des informations avant d'entrer ?</label>
        </div>
        <button id="insertDataButton" type="submit" class="btn btn-primary">Insérer des données</button>
        <button type="button" class="btn btn-success" onclick="saveAsCSV()">exemple CSV</button>

    </form>
</div>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
     $('#insertDataButton').click(function(event) {
            event.preventDefault(); // Prevent default form submission
            var isValide = $('#delele_old').prop('checked');
            var textareaValue = $('textarea[name="data"]').val();
            var file = $('input[name="file"]').val();

            if (file != '' || textareaValue != '') {
                if (isValide) {


                    // Show the confirmation modal
                    $('#confirmationModal').modal('show');

                    // Event listener for confirm button in the confirmation modal
                    $('#confirm-submit-btn').click(function() {
                        $('#confirmationModal').modal('hide');
                        $('form').submit();
                    });

                }else{
                    $('form').submit();
                }
            } else {
                var alertElement = $('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed;     top:20px;">' +
                    '<strong>Error!</strong> "Veuillez insérer des données !"<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');
                $('body').append(alertElement);

                // Automatically dismiss the alert after 5 seconds
                setTimeout(function() {
                    alertElement.alert('close');
                }, 5000);

            }
        });

    toggleInputs();

    // Toggle inputs when the checkbox state changes
    $('#methodSwitch').change(function() {
        toggleInputs();
    });

    function toggleInputs() {
        // Get the state of the checkbox
        var isChecked = $('#methodSwitch').prop('checked');

        // Enable or disable the textarea and file input based on the checkbox state
        $('textarea[name="data"]').prop('disabled', isChecked);
        $('input[name="file"]').prop('disabled', !isChecked);
    }

    
</script>
@endsection