<!-- resources/views/Professeur/index.blade.php -->

@extends('dashboard')

@section('content')



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
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
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
            var module = 1;
            var semester = 's1';
            var filiere = 1;
            var professeur = 1;
            var sessions = 1;
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

</script>
@endsection('content')