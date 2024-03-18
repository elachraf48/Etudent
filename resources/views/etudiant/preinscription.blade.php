@include('include.header')
@extends('layouts.apps')
@section('content')

<link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">


<div class="container home ">
    @if (session('error'))
    <div class="alert alert-danger">
        <p>{!! session('error') !!}</p>
    </div>
    @endif

    @if ($student && count($student) > 0)
    @foreach ($student as $key => $students)
    @if ($key === count($student) - 1)
    <div class="container-fleux p-0">

        <div class="py-5  bg-light">
            <h6 class="text-center ">Bienvenue <span class="text-danger">{{ $studentunique->Nom }} {{ $studentunique->Prenom }}</span> pour vous pré-inscrire à l'examen, réserver votre place</h6>
            <h6 class="text-center ">في التسجيل المسبق للامتحان احجز مقعدك <span class="text-danger">{{ $studentunique->Nom }} {{ $studentunique->Prenom }}</span> مرحبا بك</h6>

        </div>
        <div class="alert alert-danger my-3" role="alert" id="lastdate">
            <p class="text-center ">اخر اجل لحجز مقعدك في الامتحان <span class="text-danger"><br>{{$lastdate->LastDate}}</span><br>Date limite pour réserver votre place à l'examen</p>

        </div>
        <div class="alert alert-success d-none my-5" id="suecces" role="alert">
            <p class="text-center ">تهانينا  قمت بحجز مقعدك بنجاح بتاريخ
                <br><span class="text-danger" id="creationDate"></span>
                <br>Félicitations, vous avez réservé avec succès votre place à une date
            </p>
        </div>

      


    </div>
    @endif
    @endforeach
    @endif
    
    @if ($student && count($groupedModules) > 0)
    <table class="table table-striped table-bordered text-center">
        <tbody class="text-center">
            @foreach ($student as $key => $students)
            @if ($key === count($student) - 1)

            <tr class="table-success">
                <th colspan="2">Annee Universitaire : {{ $students->ExamenAnneeUniversitaire }} || <span class="text-center ">Code Apogee: <span name="CodeApogee" class="text-danger" id="CodeApogee">{{ $studentunique->CodeApogee }}</span></span>
                </th>

            </tr>
            <tr class="table-success">
                <th for="filiere" class="clearfix px-5">
                    <span class="float-start">Filière </span>
                    <span class="float-end"> المسلك</span>
                </th>
            </tr>
            <tr>
                <td>{{ $students->NomFiliere }}</td>
            </tr>
            @if ($students->Parcours != "")

            <tr class="table-success">
                <th>Parcours</th>
            </tr>
            <tr>
                <td>{{ $students->Parcours }}</td>
            </tr>
            @endif

            @endif
            @endforeach
            <tr class="table-success">
                <th for="filiere" class="clearfix px-5">
                    <span class="float-start">Semestre </span>
                    <span class="float-end"> السداسي</span>
                </th>
            </tr>

            @foreach ($student as $students)

            <tr>
                <td>{{ $students->ExamenSemester }}</td>
            </tr>

            @endforeach


        </tbody>

    </table>
    <form id="reclamation-form" action="{{ route('create.preinscription') }}" method="post">
        @csrf

        <input type="hidden" name="id" value="{{ $studentunique->id }}">
        <div id="btnadd" class="d-grid gap-2 col-6 mx-auto text-center ">
            <button class="btn btn-primary  pre-inscription-btn w-100" type="submit">
                pré-inscription<br> التسجيل
            </button>
        </div>
       

    </form>
    @else
    <p>No student found with the provided Code Apogee or no semesters found.</p>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function checkdate() {
        var studentId = "{{ $studentunique->id }}"; // Assuming $studentunique is available
        $.ajax({

            url: "/getCreationDate/" + studentId,
            method: 'GET',
            success: function(response) {
                // Update HTML content with creationDate
                if (response) {

                    $('#creationDate').text(response.creationDate);
                    $('#btnadd').addClass('d-none');
                    $('#lastdate').addClass('d-none');
                    $('#suecces').removeClass('d-none');




                } else {
                    $('#creationDate').text('N/A');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    // Call the function initially to update the count
    checkdate();
    // Optionally, you can set up a timer to periodically update the count
    setInterval(checkdate, 6000);
    
</script>


@endsection