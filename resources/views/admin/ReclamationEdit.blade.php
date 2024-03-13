<!-- resources/views/Professeur/index.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
  @media screen and (max-width: 768px) {

    table {
      font-size: .5em;
    }
    tr td,tr th ,.btn{
      font-size: 1em;
      max-width: 50px;


    }
    
    
  }
</style>

<div class="row g-2  m-2">
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
      <select name="Statu" id="StatuDropdown" class="form-control" required>
        <option value="%" selected>All</option>
        <option value="nv" >invisible</option>
        <!-- <option value="Trituration">Sous traitement </option> -->
        <!-- <option value="Encours">Encours </option> -->
        <option value="Valide">Valide </option>
      </select>
      <label for="floatingSelectGrid">Statu</label>
    </div>
  </div>



</div>
<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <table id="reclamation-table" class="table table-striped table-bordered text-center">
        <thead>
          <tr class="table-success">
            <!-- <th>Semester</th> -->
            <th>Professeur</th>
            <th> Étudiant</th>
            <th>C.Apogee</th>
            <th>Module</th>

            <th>Semester</th>
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

          <table id="reclamationTable" class="table table-striped table-bordered text-center">
            <tr>
              <th colspan='3' class="table-success" id="Date"></th>
            </tr>
            <tr class="table-success">
              <th colspan='2'>Étudiant</th>
              <th>Code apogee</th>
            </tr>
            <tr>
              <th colspan='2' id="name"></th>
              <th id="apogee"></th>
            </tr>
            <tr class="table-success">
              <th>N.Examen</th>
              <th>Lieu</th>
              <th>Groupe</th>
            </tr>
            <tr>
              <th id="Examen"></th>
              <th id="Lieu"></th>
              <th id="Groupe"></th>
            </tr>
            <tr class="table-success">
              <th colspan='3'>Sujet</th>
            </tr>
            <tr>
              <th colspan='3' id="Sujet"></th>
            </tr>
            <tr class="table-success">
              <th colspan='3'>Observations</th>
            </tr>
            <tr>
              <th colspan='3' id="Observations"></th>
            </tr>
            <tr class="table-success">
              <th colspan='3'>Réponse</th>
            </tr>
            <tr>
              <th colspan='3' id="message-text"></th>
            </tr>
          </table>
         
        
          <input type="hidden" id="reclamation-id">

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- confirmation donne -->
<div class="modal" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content " style="border: 3px solid red; margin-top: 40vh;">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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

<!-- FileSaver.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
          var buttonClass = reclamation.stratu == 'Valide' ? 'btn-danger' : 'btn-primary';
          var buttonLabel = reclamation.stratu == 'Valide' ? 'Encours' : 'Valid';
          var buttonHtml = '<button style="width:5vw;min-width:40px"  class="btn ' + buttonClass + ' response-btn  mx-1" data-toggle="modal" data-target="#exampleModal" data-reclamation-id="' + reclamation.id + '">' + buttonLabel + '</button>';
          var buttonAfficher = '<button style="width:5vw;min-width:40px"  class="btn btn-secondary response-btn  mx-1" data-toggle="modal" data-target="#exampleModal" data-reclamation-id="' + reclamation.id + '">Détail</button>';

          var rowData = [
            reclamation.pNom + ' ' + reclamation.pPrenom,
            reclamation.Nom + ' ' + reclamation.Prenom,
            reclamation.CodeApogee,
            reclamation.NomModule,

            reclamation.Semester,
            buttonAfficher+buttonHtml
          ];
          table.row.add(rowData).draw();
        });


      }
    });
  }


  $(document).ready(function() {
    
    
    $('#AnneeUniversitaire, #semesterDropdown, #StatuDropdown, #sessions').change(function() {
      // alert();
      change_reclamations();
    });
    // Function to populate the table with reclamation data
    function populateReclamationTable(reclamationData) {


      $('#reclamation-id').text(reclamationData.id);
      $('#name').text(reclamationData.Nom + ' ' + reclamationData.Prenom);
      $('#apogee').text(reclamationData.CodeApogee || "aucan");
      $('#Examen').text(reclamationData.NumeroExamen || "aucan");
      $('#Lieu').text(reclamationData.Lieu || "aucan");
      $('#Groupe').text(reclamationData.nomGroupe !== '0' ? reclamationData.nomGroupe : "aucan");
      $('#Sujet').text(reclamationData.Sujet || "aucan");
      $('#Observations').text(reclamationData.observations || "aucan");
      $('#message-text').text(reclamationData.Repense);
      $('#Date').text('Date de réclamation: ' + reclamationData.created_at);

    }


    // Add event listener for the response button
    $(document).on('click', '.response-btn', function() {
      var reclamationId = $(this).data('reclamation-id');
      
      $.ajax({
        url: '/detailsreqlamation/' + reclamationId, // Use reclamationId here
        method: 'GET',
        success: function(response) {
          var reclamationData = response.reclamationData;

          populateReclamationTable(reclamationData);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching reclamation details:', error);
          // Handle error if necessary
        }
      });

      $('#exampleModal').modal('show');
    });

    // Function to fetch reclamation details and populate the table



    // Function to handle saving response

    $('#saveResponseButton').click(function(event) {
      event.preventDefault(); // Prevent default form submission

      // Show the confirmation modal
      $('#confirmationModal').modal('show');

      // Event listener for confirm button in the confirmation modal
      $('#confirm-submit-btn').click(function() {
        $('#confirmationModal').modal('hide');

        var reponse = $('#message-text').val();
        var reclamationId = $('#reclamation-id').text();
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtain CSRF token value

        // Perform AJAX request to update tracking reclamation
        $.ajax({
          url: '/update-tracking-reclamations',
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
          },
          data: {
            reclamation_id: reclamationId,
            reponse: reponse
          },
          success: function(response) {
            // Update table row with response
            $('#exampleModal').modal('hide');
            // Assuming you have a function to update the table row with response
            updateTableRow(response);
            $('#message-text').val('');
          },
          error: function(xhr, status, error) {
            console.error('Error updating tracking reclamation:', error);
            // Handle error if necessary
          }
        });
      });
    });


    function updateTableRow(response) {
      change_reclamations();
    }

  });
</script>
@endsection('content')