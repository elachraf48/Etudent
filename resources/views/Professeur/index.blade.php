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
      font-size: .7em;
    }

    #reclamation-table tbody tr :nth-child(4) {
      display: none;
    }

    #reclamation-table thead :nth-child(4) {
      display: none;
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
        <option value="%">All</option>
        <option value="nv" selected>invisible</option>
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
      <table id="reclamation-table" class="table text-center table-striped table-bordered">
        <thead>
          <tr class="table-primary">
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

          <table id="reclamationTable" class="table table-bordered border-primary text-center">
            <tr>
              <th colspan='3' class="table-primary" id="Date"></th>
            </tr>
            <tr class="table-primary">
              <th colspan='2'>Étudiant</th>
              <th>Code apogee</th>
            </tr>
            <tr>
              <th colspan='2' id="name"></th>
              <th id="apogee"></th>
            </tr>
            <tr class="table-primary">
              <th>N.Examen</th>
              <th>Lieu</th>
              <th>Groupe</th>
            </tr>
            <tr>
              <th id="Examen"></th>
              <th id="Lieu"></th>
              <th id="Groupe"></th>
            </tr>
            <tr class="table-primary">
              <th colspan='3'>Sujet</th>
            </tr>
            <tr>
              <th colspan='3' id="Sujet"></th>
            </tr>
            <tr class="table-primary">
              <th colspan='3'>Observations</th>
            </tr>
            <tr>
              <th colspan='3' id="Observations"></th>
            </tr>
          </table>
          <div class="mb-3">
            <select id="response-select" class="form-control">
              <option value="Maintenir la note">Maintenir la note</option>
              <option value="autre" selected>autre</option>
            </select>

            <label for="message-text" class="col-form-label">Réponse:</label>
            <textarea class="form-control mb-2" id="message-text" required></textarea>

            <div class="mb-3" id="image-uploadss">
              <label for="image-upload" class="form-label">Uploader un fichier:</label>
              <input type="file" class="form-control" id="image-upload" name="image" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
            </div>
            <div class="mb-3 text-center d-none "  id="btn-uploadss">

              <h5>détails du fichier</h5>
                <embed class="immg d-none"  />
                <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#exampleModalessss">
                <i class="fa-solid fa-eye"></i> montrer
                </button>

            </div>

          </div>
          
         

          <div class="alert alert-primary text-center d-none" role="alert" id="info">
            Si vous souhaitez modifier, veuillez envoyer les informations à l'administration
          </div>
          <input type="hidden" id="reclamation-id">

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" id="saveResponseButton" class="btn btn-primary">Enregistrer la réponse</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



 <!-- embed -->
 <div class="modal fade" id="exampleModalessss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="width: 100%; height: 100%;">
              <div class="modal-content" style="width: 100%; height: 100%;">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">détails du fichier</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body " >
                <embed class="immg" style="width: 100%; height: 100%;"/>
                </div>
                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
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
          var buttonClass = reclamation.stratu == 'Valide' ? 'btn-secondary' : 'btn-primary';
          var buttonLabel = reclamation.stratu == 'Valide' ? 'Afficher' : 'Réponse';
          var buttonHtml = '<button  class="btn  ' + buttonClass + ' response-btn w-100" data-toggle="modal" data-target="#exampleModal" data-reclamation-id="' + reclamation.id + '" >' + buttonLabel + '</button>';

          var rowData = [
            reclamation.NomModule,
            reclamation.CodeApogee,
            reclamation.Nom + ' ' + reclamation.Prenom,
            reclamation.created_at,
            buttonHtml
          ];
          table.row.add(rowData).draw();
        });


      }
    });
  }


  $(document).ready(function() {
   
    document.getElementById("response-select").addEventListener("change", function() {
      var selectValue = this.value;
      var messageTextArea = document.getElementById("message-text");
      // If the selected value is "Maintenir la note"
      if (selectValue === "Maintenir la note") {
        messageTextArea.value = selectValue;
        messageTextArea = true; // Set textarea to readonly

      } else {
        messageTextArea.value = ""; // Clear textarea
        messageTextArea.readOnly = false; // Allow read and write

      }
    });
    $('#AnneeUniversitaire, #semesterDropdown, #StatuDropdown, #sessions').change(function() {
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
      $('#image-upload').val(reclamationData.file); // Set the value of the file input
      $('.immg').attr('src', '/storage/uploads/' + reclamationData.file_path);
      $('.immg').attr('type', reclamationData.file_type);

      // Create a download button
      
      var downloadButton = $('<a>', {
        href: '/storage/uploads/' + reclamationData.file_path,
        download: '',
        text: '',
        class: 'downloadButton btn btn-primary w-100 my-2',
        role:"button",
        html: '<i class="fa-solid fa-download"></i> Télécharger'

      });
      if ($('.downloadButton').length !== 0) {
        // If not, create a new download button
        $('.downloadButton').remove();

      }
      // Add the download button after the #immg element
      $('.immg').after(downloadButton);

      // alert(reclamationData.Repense+'  '+reclamationData.file_path+'  '+reclamationData.file_type);
      $('#Date').text('Date de réclamation: ' + reclamationData.created_at);
    }



    // Add event listener for the response button
    $(document).on('click', '.response-btn', function() {
      var reclamationId = $(this).data('reclamation-id');
      var isValide = $('button[data-reclamation-id=' + reclamationId + ']').text() === 'Afficher';
      $('#saveResponseButton').toggle(!isValide);
      $('#image-uploadss').toggle(!isValide);
      $('#btn-uploadss').toggleClass('d-none', !isValide);
      // Make the textarea readonly if the status is "Valide"
      $('#message-text').prop('readonly', isValide);
      // Hide the drop-down list if the status is "Valide"
      $('#response-select').toggle(!isValide);
      $('#info').toggleClass('d-none', !isValide);
      // Use the reclamation-id as idreq in the AJAX call
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

      // Check if the form is valid
      if ($('#response-form')[0].checkValidity()) {
        // Show the confirmation modal
        $('#confirmationModal').modal('show');

        // Event listener for confirm button in the confirmation modal
        $('#confirm-submit-btn').click(function() {
          $('#confirmationModal').modal('hide');

          var reponse = $('#message-text').val();
          var reclamationId = $('#reclamation-id').text();
          var formData = new FormData(); // Create a new FormData object

          // Append the file data to the FormData object
          formData.append('reponse', reponse);
          formData.append('reclamation_id', reclamationId);
          formData.append('file', $('#image-upload')[0].files[0]); // Get the selected file

          var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtain CSRF token value

          // Perform AJAX request to update tracking reclamation
          $.ajax({
            url: '/update-tracking-reclamations',
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
            },
            data: formData, // Use FormData object instead of plain object
            processData: false, // Prevent jQuery from processing the FormData object
            contentType: false, // Prevent jQuery from setting contentType
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
      } else {
        // If the form is invalid, trigger HTML5 form validation
        $('#response-form')[0].reportValidity();
      }
    });


    function updateTableRow(response) {
      
      change_reclamations();
    }

  });
</script>
@endsection('content')