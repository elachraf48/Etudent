<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
    <div class="text-center p-3">
        <h2 >Parameter Page</h2>

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
    <table id="reclamation-table" class="table table-striped table-bordered text-center">
        <thead>
            <tr class="table-success">
                <th>Nom de la page</th>
                <th>Dernier délai</th>
                <th>Status</th>
                <th>dernière mise à jour</th>
                <th>name of user</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $parameter)
            <tr>
                <td> <input class="form-control" type="text" id="name_page" name="name_page" value="{{ $parameter->NamePage }}" required></td>
                <td> <input class="form-control" type="date" id="last_date" name="last_date" value="{{ $parameter->LastDate }}" required></td>
                <td>
                    <select class="form-control" id="status" name="status" required>
                        <option value="true" {{ $parameter->Statu == 'true' ? 'selected' : '' }}>active</option>
                        <option value="false" {{ $parameter->Statu == 'false' ? 'selected' : '' }}>désactivé</option>
                    </select>
                </td>
                <td>{{ $parameter->updated_at}}</td>
                <td data-id-user="{{ $parameter->user_id}}">{{ $parameter->user->name }}</td>

                <td>
                    <button class="btn btn-primary update-parameter-btn" data-id="{{ $parameter->id }}">Mettre à jour le paramètre</button>
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



    <!-- Add a textarea for pasting data -->



    <!-- Add DataTables JS -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- FileSaver.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure the script runs after the DOM is loaded
            document.querySelectorAll('.update-parameter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Retrieve data from the table row
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const name = row.querySelector('input[name="name_page"]').value;
                    const date = row.querySelector('input[name="last_date"]').value;
                    const statu = row.querySelector('select[name="status"]').value;
                    $.ajax({
                        url: "{{ route('parameter_edit') }}",
                        type: 'POST',
                        dataType: 'json', // Ensure the server returns valid JSON
                        data: {
                            id: id,
                            name: name,
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
            });
        });
    </script>

    @endsection