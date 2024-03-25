<!-- resources/views/admin/Reclamation.blade.php -->

@extends('dashboard')

@section('content')
<!-- Add DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid p-3">
    <div class="text-center p-3">
        <h2>Activation</h2>

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

    <style>
        @media screen and (max-width: 768px) {

            table {
                font-size: .7em;
            }


        }
    </style>



    <div class="table-responsive">

        <table id="module-table" class="table table-striped table-bordered text-center ">
            <thead>
                <tr class="table-success">
                    <th>Nom de Filiere</th>
                    <th>Nom de module</th>
                    <th>Semester</th>
                    <th>dernière mise à jour</th>
                    <th>Statut</th>
                </tr>
            </thead>

    </div>
    <tbody id="module-body">
        @foreach($parameters as $parameter)
        <tr>
            <td>{{ $parameter->filiere->NomFiliere }}
                @if($parameter->filiere->Parcours!='')
                ({{ $parameter->filiere->Parcours }})
                @endif
            </td>
            <td>{{ $parameter->NomModule }}</td>
            <td> {{ $parameter->Semester }}</td>
            <td>{{ $parameter->updated_at}}</td>
            <td>
                <button disabled class="btn update-parameter-btn   {{ $parameter->statu == 'Y' ? 'btn-primary':'btn-danger'  }} w-100" data-id="{{ $parameter->id }}" value="{{ $parameter->statu }}">
                    {{ $parameter->statu == 'Y' ? 'active':'désactivé'  }}
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
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
                <p>Etes-vous sûr ? La dernière mise à jour a lieu à moins de 3 jours d'intervalle.</p>

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
<!-- FileSaver.js -->
<script>
    $(document).on('click', '.update-parameter-btn', function() {
        const row = this.closest('tr');
        var date = row.querySelectorAll('td')[3].textContent;
        var targetDate = new Date(date.replace(/-/g, '/'));
        var differenceInDays = Math.floor((new Date() - targetDate) / (1000 * 60 * 60 * 24));
        var id = this.getAttribute('data-id');
        if (differenceInDays <= 3 && this.value == "Y") {

            $('.modale').modal('show');
            $('#confirm-submit-btn').click(function() {

                $.ajax({
                    url: '/Professeur/activation', // Use reclamationId here
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.reload();

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
                url: '/Professeur/activation', // Use reclamationId here
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reclamation details:', error);
                    // Handle error if necessary
                }
            });
        }
    });
</script>

@endsection