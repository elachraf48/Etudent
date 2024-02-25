<!-- resources/views/Professeur/index.blade.php -->

@extends('dashboard')

@section('content')


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
        @foreach($semester as $semesters)
        <option value="{{ $semesters }}">{{ $semesters }}</option>
        @endforeach
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
      <select name="Statu" id="StatuDropdown" class="form-control" required>
        <option value="nv" selected>invisible</option>
        <option value="Trituration">Sous traitement </option>
        <option value="Encours">Encours </option>
        <option value="Valide">Valide </option>
      </select>
      <label for="floatingSelectGrid">Statu</label>
    </div>
  </div>



</div>
<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <table id="reclamation-table" class="table ">
        <thead>
          <tr>
            <!-- <th>Semester</th> -->
            <th>Module</th>
            <th>C.Apogee</th>
            <th> Étudiant</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reclamation Response</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="response-form">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Étudiant:</label>
                        <input type="text" class="form-control" id="recipient-name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Réponse:</label>
                        <textarea class="form-control" id="message-text" required></textarea>
                    </div>
                    <input type="hidden" id="reclamation-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Save Response</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
  change_reclamations();

  function change_reclamations() {
    var AnneeUniversitaire = $('#AnneeUniversitaire').val();
    var semester = $('#semesterDropdown').val();
    var Statu = $('#StatuDropdown').val();
    var sessions = $('#sessions').val();

    // Add cache buster parameter
    var cacheBuster = new Date().getTime(); // or any unique value
    var url = '/fetch-reclamations/' + AnneeUniversitaire + '/' + Statu + '/' + semester + '/' + sessions + '?_=' + cacheBuster;

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
                var rowData = [
                    reclamation.NomModule,
                    reclamation.CodeApogee,
                    reclamation.Nom + ' ' + reclamation.Prenom,
                    reclamation.created_at,
                    '<button class="btn btn-primary response-btn" data-toggle="modal" data-target="#exampleModal" data-reclamation-id="' + reclamation.id + '">Réponse</button>'
                ];
                table.row.add(rowData).draw();
            });

            // Add event listener for the response button
            $('.response-btn').click(function() {
                var reclamationId = $(this).data('reclamation-id');
                $('#reclamation-id-input').val(reclamationId);
                $('#exampleModal').modal('show');
            });
        }
    });
}


  $(document).ready(function() {
    $('#reclamation-table').on('click', '.response-btn', function() {
        var reclamationId = $(this).data('reclamation-id');
        // Here, you can make an AJAX request to fetch additional data for the reclamation if needed

        // For now, let's assume you already have the necessary data available in the page
        var etudiant = 'John Doe'; // Replace with actual data

        // Populate the modal form with the retrieved data
        $('#recipient-name').val(etudiant);
        $('#message-text').val(''); // Clear any previous input
        $('#reclamation-id').val(reclamationId); // Store reclamation ID in a hidden field for form submission
    });

    $('#response-form').on('submit', function(e) {
        e.preventDefault();
        
        var reclamationId = $('#reclamation-id').val();
        var responseText = $('#message-text').val();

        // Here, you can make an AJAX request to save the response
        // Example AJAX request (replace with your actual implementation)
        $.ajax({
            url: '/save-response',
            type: 'POST',
            data: {
                reclamation_id: reclamationId,
                response_text: responseText
            },
            success: function(response) {
                // Handle success response
                console.log('Response saved successfully:', response);
                // Close the modal
                $('#exampleModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error saving response:', error);
                // Optionally display an error message to the user
            }
        });
    });
});
</script>
@endsection('content')