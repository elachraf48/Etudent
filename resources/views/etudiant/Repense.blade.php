@include('include.header')
@extends('layouts.apps')
@section('content')


<input type="hidden" value="{{$CodeApogee}}" name="CodeApogee" id="CodeApogee">
@if ($student )
<div class="container p-0">
<div class="row">

<h2 class="text-center mt-5">Bonjour <span class="text-danger">{{ $student->Nom }} {{ $student->Prenom }}</span> </h2>
    @if (count($results) > 0)
    @foreach ($results as $result )
    <h5>Année universitaire: <span class="text-primary">{{ $result->AnneeUniversitaire }}</span></h5>
    @break
    @endforeach
    @foreach ($results as $result )
    <h5></h5>
    <table class="table p-2">
    <thead>
        <tr>
        <th scope="col">Module</th>
        <th scope="row">{{$result->NomModule}}</th>

        <th scope="col">الوحدة</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
    @endforeach
    @else
    <div class="alert alert-info text-center" role="alert">
    عذرًا، لا يوجد حاليًا أي ردود على شكاواك<br><hr>
    Désolé, il n'y a pas de réponse à vos plaintes actuellement
</div>
    @endif

@else
    <p>No student found with the provided Code Apogee or no semesters found.</p>
    @endif
    </div>    
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   
    function updateReclamationsCount() {
        var CodeApogee = $('#CodeApogee').val();
        $('.btn-primary').attr('data-apogee', CodeApogee);

        $.ajax({
            url: "/reclamations/etudiant/" + CodeApogee,
            method: 'GET',
            success: function(response) {
                // Update the count in the navigation menu
                $('#reclamationsCount').text(response.count > 0 ? response.count : '0');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the function initially to update the count
    updateReclamationsCount();

    // Optionally, you can set up a timer to periodically update the count
    setInterval(updateReclamationsCount, 6000);
</script>


@endsection