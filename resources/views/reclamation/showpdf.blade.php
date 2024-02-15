@extends('layouts.apps')

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Center the container vertically and horizontally, and apply cool background color -->
<style>
   
    .custom-table {
        width: 90%;
        border-collapse: collapse;
    }

    .custom-table td,
    .custom-table th {
        border: black 2px solid;
        padding: 10px;
        text-align: center;
        font-size: small;

    }

    /* Custom table header styles */
    .custom-table-header {
        background-color: #343a40;
        /* Adjust as needed */
        color: #fff;
        /* Adjust as needed */
    }

    /* Custom table column styles */
    

    /* Custom table body styles */
    .custom-table-body {
        background-color: #fff;
        /* Adjust as needed */
    }

    /* Float styles */
   
  
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        width: 100%;
        background-color: #dc3545;
        /* Allow items to wrap on smaller screens */
    }

    /* Styles for left and right text */
    .text {
        font-family: Arial, sans-serif;
        text-align: center;
        flex: 1;
        /* Take up equal space */
        margin: 10px;
        /* Adjust as needed */
        font-size: 18px;
        /* Default font size */
    }

    .text.arabic {
        direction: rtl;
    }

    .text-white {
        display: flex;
        align-items: center;
        color: #fff;
        /* Specify text color */
    }

    .text-white a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
        margin-right: 10px;
        /* Adjust as needed */
    }

  
</style>

<!-- CSRF token for Laravel security -->
<section>
    <div class="container-fluid  text-center">
        <header class="container-fluid">
            <div class="text">
                <!-- English text on the left -->
                Université Mohammed Premier<br>
                Faculté des Sciences Juridiques,<br>
                Economique et Sociales
            </div>
            <img src="/img/banner.png" alt="University Image" width="150" height="150">
            <div class="text arabic">
                <!-- Arabic text on the right -->
                جامعة محمد الأول بوجدة<br>
                كلية العلوم القانونية <br>والاقتصادية والاجتماعية
            </div>
        </header>
    </div>
    <center>


        <div class="continue">
            <!-- Centered Section with Logo for Mobile -->
            <h5 class="custom-link-success custom-p-2">تم تقديم شكوى بالنجاح</h5>
            <h5 class="custom-link-danger custom-p-2">Une plainte a été soumise avec succès.</h5>
            @if ($result->AnneeUniversitaire)
            <h5>Annee Universitaire: {{ $result->AnneeUniversitaire }}</h5>
            @endif
        </div>
        <table class="custom-table">
            <thead class="custom-table-header">
                <tr>
                    <th scope="col" class="custom-table-col">Nom</th>
                    <th colspan="2" class="custom-table-col">
                        {{ $result->Nom }} {{ $result->Prenom }}
                    </th>
                    <th scope="col" class="custom-table-col">اسم</th>
                </tr>
                <tr>
                    <th scope="row" class="custom-table-row">Numéro Apogée</th>
                    <th colspan="2" class="custom-table-row">
                        {{ $result->CodeApogee }}
                    </th>
                    <th class="custom-table-row">رقم أبوجي</th>
                </tr>
            </thead>
            <tbody class="custom-table-body">
                <tr>
                    <th scope="row"> <span class="float-start">Semestre </span></th>
                    <td colspan="2">{{ $result->Semester }}</td>
                    <th> <span class="float-end"> السداسي</span></th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Filiere </span></th>
                    <td colspan="2">{{ $result->NomFiliere }}</td>
                    <th scope="row"> <span class="float-end"> المسلك</span></th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Module </span></th>
                    <td colspan="2">{{ $result->NomModule }}</td>
                    <th scope="row"> <span class="float-end"> الوحدة</span></th>
                </tr>
                @if ($result->NumeroExamen)
                <tr>
                    <th scope="row"> <span class="float-start">N d'examen </span></th>
                    <td colspan="2">{{ $result->NumeroExamen }}</td>
                    <th scope="row"> <span class="float-end"> رقم الامتحان</span></th>
                </tr>
                @endif
                @if ($result->Lieu)
                <tr>
                    <th scope="row"> <span class="float-start">Salle ou Aphhi </span></th>
                    <td colspan="2">{{ $result->Lieu }}</td>
                    <th scope="row"> <span class="float-end"> مكان اجتياز الامتحان</span></th>
                </tr>
                @endif

                <tr>
                    @if ($result->nomGroupe)
                    <th scope="row"><span class="float-start">Group</span></th>
                    <td colspan="2">{{ $result->nomGroupe }}</td>
                    <th scope="row"><span class="float-end">مجموعة </span> </th>
                    @endif
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Professeur </span></th>
                    <td colspan="2">{{ $result->ProfNom }} {{ $result->ProfPrenom }}</td>
                    <th scope="row"> <span class="float-end"> مدرس</span></th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Sujet de la réclamation </span></th>
                    <td colspan="2">{{ $result->Sujet }}</td>
                    <th scope="row"> <span class="float-end"> موضوع الطلب</span></th>
                </tr>
                <tr>
                    <th scope="row"> <span class="float-start">Numéro de suivi de réclamation </span></th>
                    <td colspan="2">{{ $result->observations }}</td>
                    <th scope="row"> <span class="float-end"> رقم تتبع الشكوى</span></th>
                </tr>
            </tbody>
        </table>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endsection