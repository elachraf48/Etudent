@include('include.header')
@extends('layouts.apps')
@section('content')
<style>
    /* body {
  width: 100%;
  height: 100%;
  /* Add your background pattern here 
  background-color: white;
  background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
  background-size: 30px 30px;
  background-position: -5px -5px;

} */
.home{
   min-height: 100vh;
}
</style>

<input type="hidden" value="{{$CodeApogee}}" name="CodeApogee" id="CodeApogee">
@if ($student )
<div class="container p-2 home bg-light">
<div class="row p-2">

<h2 class="text-center my-5">Bonjour <span class="text-danger">{{ $student->Nom }} {{ $student->Prenom }}</span> </h2>
    @if (count($results) > 0)
    <div class="container pb-5">   
        @foreach ($results as $result )
        <h5>Année universitaire: <span class="text-primary">{{ $result->AnneeUniversitaire }}</span></h5>
        <h5>Filière: <span class="text-primary">{{ $result->NomFiliere }}</span></h5>
        @if ($result->Parcours != "")
        <h5>Parcours: <span class="text-primary">{{ $result->Parcours }}</span></h5>
        @endif
        @break
        @endforeach
    </div> 
    @foreach ($results as $result )
    <table class="table text-center table-striped table-bordered ">
        <tr class="table table-success table-striped-columns">
        <th scope="col" colspan='3'>Semestre  : {{$result->Semester}} : السداسي 
            @if($result->nomGroupe!='0')| Group  : {{$result->nomGroupe}} : مجموعة @endif
            @if($result->Lieu!='')| Salle  : {{$result->Lieu}} :  مكان اجتياز @endif
        </th>
       
        </tr>

        <tr>
        <th scope="col">Module</th>
        <th scope="col">{{$result->NomModule}}</th>
        <th scope="col">الوحدة</th>
        </tr>

        <tr>
        <th scope="col">Professeur</th>
        <th scope="col">{{$result->Nomp}} {{ $result->Prenomp}}</th>
        <th scope="col">الاستاذ</th>
        </tr>
        <tr>
        <th scope="col">Répondre</th>
        <th scope="col">{{$result->Repense}}</th>
        <th scope="col">الرد</th>
        </tr>
        <tr>
       
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