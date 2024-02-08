<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<!-- Center the container vertically and horizontally, and apply cool background color -->
<style>
    /* Define custom CSS rules to replicate the styling provided by Bootstrap classes */

/* Center the container vertically and horizontally */
.text-center {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Adjust as needed */
}

/* Custom column width */
.custom-col-md-12 {
    width: 100%;
}

/* Custom image styles */
.custom-img {
    width: 50%; /* Adjust as needed */
}

/* Background color */
.custom-bg-light {
    background-color: #f8f9fa; /* Adjust as needed */
}

/* Custom link styles */
.custom-link-success, .custom-link-danger {
    padding: 0.5rem 1rem;
    font-size: 1.25rem; /* Adjust as needed */
    font-weight: bold;
}

.custom-link-success {
    color: #28a745; /* Adjust as needed */
}

.custom-link-danger {
    color: #dc3545; /* Adjust as needed */
}

/* Custom padding */
.custom-p-2 {
    padding: 0.5rem 1rem; /* Adjust as needed */
}

/* Custom table styles */
.custom-table {
    width: 100%;
    border-collapse: collapse;
}

/* Custom table header styles */
.custom-table-header {
    background-color: #343a40; /* Adjust as needed */
    color: #fff; /* Adjust as needed */
}

/* Custom table column styles */
.custom-table-col {
    border: 1px solid #dee2e6; /* Adjust as needed */
    padding: 0.75rem; /* Adjust as needed */
}

/* Custom table row styles */
.custom-table-row {
    border: 1px solid #dee2e6; /* Adjust as needed */
}

/* Custom table body styles */
.custom-table-body {
    background-color: #fff; /* Adjust as needed */
}

/* Float styles */
.float-start {
    float: left;
}

.float-end {
    float: right;
}

</style>
<!-- CSRF token for Laravel security -->
<section class="text-center">
    <center>
    <div class="custom-col-md-12  ">
        <img src="{{ asset('img/ministry-logo-ar.png') }}" class="custom-img" alt="Logo">
    </div>

    <div class="continue  custom-bg-light">
        <!-- Centered Section with Logo for Mobile -->
        <h5 class="custom-link-success custom-p-2">تم تقديم شكوى بالنجاح</h5>
        <h5 class="custom-link-danger custom-p-2">Une plainte a été soumise avec succès.</h5>
        @if ($AnneeUniversitaire)
        <h5>Annee Universitaire: {{ $AnneeUniversitaire }}</h5>
        @endif
        <!-- <h5><span class="title">شكوى</span>
        <h5><span class="title">Réclamation</span></h5> -->
    </div>
    </center>
    <table class="custom-table">
        <thead class="custom-table-header">
            <tr>
                <th scope="col" class="custom-table-col">Nom</th>
                <th colspan="2" class="custom-table-col">
                    @if ($Nom)
                    {{ $Nom }} {{ $Prenom }}
                    @endif
                </th>
                <th scope="col" class="custom-table-col">اسم</th>
            </tr>
            <tr>
                <th scope="row" class="custom-table-row">Numéro Apogée</th>
                <th colspan="2" class="custom-table-row">
                    @if ($codeApogee)
                    {{ $codeApogee }}
                    @endif
                </th>
                <th class="custom-table-row">رقم أبوجي</th>
            </tr>
        </thead>
        <tbody class="custom-table-body">
        <tr >
                    <th scope="row" > <span class="float-start">Semestre </span>
                    </th>
                    <td colspan="2">{{ $semester }}</td>
                    <th> <span class="float-end"> السداسي</span>
                    </th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Filiere </span>
                    </th>
                    <td colspan="2">{{ $filiere }}</td>
                    <th scope="row"> <span class="float-end"> المسلك</span>
                    </th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Module </span>
                    </th>
                    <td colspan="2">{{ $module }}</td>
                    <th scope="row"> <span class="float-end"> الوحدة</span>
                    </th>
                </tr>
                @if ($ndexamen!='')
                <tr>
                    <th scope="row"> <span class="float-start">N d'examen </span>
                    </th>
                    <td colspan="2">{{ $ndexamen }}</td>
                    <th scope="row"> <span class="float-end"> رقم الامتحان</span>
                    </th>
                </tr>
                @endif
                @if ($lieu!='')
                <tr>
                    <th scope="row"> <span class="float-start">Salle ou Aphhi </span>
                    </th>
                    <td colspan="2">{{ $lieu }}</td>
                    <th scope="row"> <span class="float-end"> مكان اجتياز الامتحان</span>
                    </th>
                </tr>
                @endif

                <tr>
                    @if ($Group !='')
                    <th scope="row"><span class="float-start">Group</span></th>
                    <td colspan="2">{{ $Group }}</td>
                    <th scope="row"><span class="float-end">مجموعة </span> </th>

                </tr>
                @endif
                <tr>
                    <th scope="row"> <span class="float-start">Professeur </span>
                    </th>
                    <td colspan="2">{{ $professeur }}</td>
                    <th scope="row"> <span class="float-end"> مدرس</span>
                    </th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Sujet de la réclamation </span>
                    </th>
                    <td colspan="2">{{ $reclamation }}</td>
                    <th scope="row"> <span class="float-end"> موضوع الطلب</span>
                    </th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Numéro de suivi de réclamation </span>
                    </th>
                    <td colspan="2">{{ $code_tracking }}</td>
                    <th scope="row"> <span class="float-end"> رقم تتبع  الشكوى</span>
                    </th>
                </tr>
            </tbody>
        </tbody>
    </table>
</section>
@endsection
