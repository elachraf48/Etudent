<!-- resources/views/students/index.blade.php -->
@include('include.header')

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->

<head>
    <!-- Include your other <head> elements here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">

</head>


<!-- CSRF token for Laravel security -->
<section class="text-center pt-0  bg-light">
<div class="container-fluid pt-0 text-center">
            
            <div class="continue bg-gray pt-0" >

                <h5 class="link-danger pt-3">Demande de correction de faute matérielle concernant les résultats des examens.</h5>
                <h5 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h5>
            </div>

        </div>
    <div class="container-fluid d-flex align-items-center justify-content-center    p-3">

    <form id="reclamation-form" action="{{ route('reclamationpost') }}" method="post">
            @csrf

            <div id="liveAlertPlaceholder"></div>

            <!-- Display the current date -->


            @if ($studentuniue && count($studentuniue) > 0)
            @php
            $Nom = $studentuniue[0]->Nom;
            $Prenom = $studentuniue[0]->Prenom;
            @endphp
            @else
            @php
            $Nom = '';
            $Prenom = '';
            @endphp
            @endif

            @if ($student && count($student) > 0)
            @foreach ($student as $key => $students)
            @if ($key === count($student) - 1)
            @php

            $NomGroupe=$students->NomGroupe;
            $Lieu=$students->Lieu;
            $NumeroExamen=$students->NumeroExamen;
            $idexam=$students->idexam;
            @endphp
            @endif
            @endforeach
            @else
            @php
            $NomGroupe = '';
            $Lieu='';
            $NumeroExamen='';
            $idexam='';
            @endphp
            @endif
            <input type="hidden" name="idexam" value="<?= $idexam ?>" />
            @if (!$student || count($student) === 0)
            <div class="alert alert-danger" role="alert">

                <h5 class="contactserv">Veuillez contacter le service des affaires étudiantes pour résoudre votre situation.</h5>
                <h5 class="contactserv">المرجو التوجه لمصلحة شؤون الطلبة لتسوية وضعكم</h5>
                <hr>

                .اسمك غير مدرج في قائمة الامتحانات المرجو ملئ الاستمارة كاملة
                <br>
                Votre nom ne figure pas sur la liste d'examen, veuillez remplir complètement le formulaire.
            </div>
            @endif
            <!-- Input fields for nom and prenom -->
            <div class="row g-2 mt-1  pt-2">
                <label for="nom" class="clearfix">
                    <span class="float-start">Nom de famille <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> اسم العائلي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="nom" @if($Nom !='' ) value="{{ $Nom }}" readonly @endif placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">Nom de famille</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="prenom" class="clearfix">
                    <span class="float-start">prénom <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> الاسم الشخصي </span>
                </label>
                <div class="col-md">

                    <div class="form-floating">
                        <input type="text" name="prenom" @if($Prenom!='' ) value="{{ $Prenom }}" readonly @endif placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">prénom</label>
                    </div>
                </div>
            </div>


            <div class="row g-2 mt-1  pt-2">
                <label for="number" class="clearfix">
                    <span class="float-start">Numéro d'inscription Apogée <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> رقم التسجيل أبوجي</span>
                </label>
                <div class="col-md" alt="madirch 0">
                    <div class="form-floating">
                        <input type="number" value="{{ $codeApogee }}" id="CodeApogee" readonly placeholder="" name="napogee"  class="form-control" required>
                        <label for="floatingSelectGrid">Code Apogée</label>

                    </div>
                </div>

            </div>
            @if (!$studentuniue || count($studentuniue) === 0)
            <div class="row g-2 mt-1  pt-2">
                <label for="number" class="clearfix">
                    <span class="float-start">Date de naissance <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> تاريخ الازدياد</span>
                </label>
                <div class="col-md" alt="madirch 0">
                    <div class="form-floating">
                        <input type="date" value="" placeholder="" name="datenes" class="form-control" required>
                        <label for="floatingSelectGrid">Date de naissance</label>

                    </div>
                </div>

            </div>
            @endif
            <div class="row g-2 mt-1">
                <label for="semester" class="clearfix">
                    <span class="float-start">Semestre <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> السداسي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">

                        <input type="text" value="{{$semester}}" readonly placeholder="" name="semester" id="semester" class="form-control" required>
                        <label for="floatingSelectGrid">Semester</label>
                    </div>
                </div>
            </div>

            <!-- Dropdown list for semester, filiere, option -->
            <!-- Input fields for N apogee and N d'examen -->
            <div class="row g-2 mt-1">
                <label for="filiere" class="clearfix">
                    <span class="float-start">Filiere <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> المسلك</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="filiere" id="filiereDropdown" class="form-control" readonly required>
                            @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }}
                                @if($filiere->Parcours!='')
                                {({{ $filiere->Parcours }})}
                                @endif
                            </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectGrid">Filiere</label>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-1  pt-2">
                <label for="module" class="clearfix">
                    <span class="float-start">Module <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> الوحدة</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="module" id="moduleDropdown" class="form-control required" required>
                            <option value="" readonly selected>Select Module</option>
                            @if ($student && count($student) > 0)

                            @foreach ($student as $Module )
                            <option value="{{$Module->idModule}}">{{ $Module->NomModule }}</option>
                            @endforeach
                            @else
                            @foreach($Modules as $Module)
                            <option value="{{ $Module->id }}">{{ $Module->NomModule }}</option>
                            @endforeach
                            @endif
                        </select>
                        <label for="floatingSelectGrid">Module</label>
                    </div>
                </div>
            </div>



            <div class="row g-2 mt-1  pt-2">
                <label for="ndexamen" class="clearfix">
                    <span class="float-start">N d'examen </span>
                    <span class="float-end"> رقم الامتحان</span>

                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" @if($NumeroExamen!='' ) value="{{ $NumeroExamen }}" readonly @endif name="ndexamen" oninput="removeLeadingZeros(this)" class="form-control">
                        <label for="floatingSelectGrid">N d'examen</label>

                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="filiere" class="clearfix">
                    <span class="float-start">Salle ou Aphhi <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> مكان اجتياز الامتحان</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="lieu" @if($Lieu!='' ) value="{{ $Lieu }}" readonly @endif placeholder="" class="form-control required" required>
                        <label for="floatingSelectGrid">Salle ou Aphhi</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="option" class="clearfix">
                    <span class="float-start">Group</span>
                    <span class="float-end">مجموعة </span>
                </label>
                <div class="col-md">
                    <div class="form-floating">

                        <select name="Group" id="GroupDropdown" class="form-control required" required>
                            @foreach($Groups as $Group)
                            @php
                            $Groupe = ($Group->nomGroupe === "0") ? 'Aucun' : $Group->nomGroupe;
                            @endphp
                            <option value="{{ $Group->id }}">{{ $Groupe }}</option>
                            @endforeach

                        </select>
                        <label for="floatingSelectGrid">Group</label>
                    </div>
                </div>
            </div>
            <!-- Input field for professeur -->
            <div class="row g-2 mt-1">
                <label for="professeurv" class="clearfix">
                    <span class="float-start">Professeur <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> استاذ</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="professeur" id="professeurDropdown" class="form-control required" required>
                            <option value="">
                                <label class="clearfix">
                                    <span class="float-start">Choisissez d'abord module </span>
                                    <span class="float-end">اختر الوحدة اولا </span>
                                </label>
                            </option>
                        </select>
                        <label for="floatingSelectGrid">Professeur</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1">
                <label for="reclamation" class="clearfix">
                    <span class="float-start">Sujet de la réclamation <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> موضوع الطلب</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="reclamation" id="idreclamation" class="form-control required" required>
                            <option disabled value="" selected>
                                <label class="clearfix">
                                    <span class="float-start">Sujet de la réclamation</span>
                                    <span class="float-end"> موضوع الطلب</span>
                                </label>
                            </option>
                            <option value="غير مسجل في الوحدة"><label class="clearfix">
                                    <span class="float-start">Non inscrit au module</span>
                                    <span class="float-end"> غير مسجل في الوحدة</span>
                                </label>
                            </option>
                            <option value="عدم ادراج النقطة"><label class="clearfix">
                                    <span class="float-start">Omission d'attribution de la note</span>
                                    <span class="float-end"> عدم ادراج النقطة</span>
                                </label>
                            </option>
                            <option value="خطأ في رقم الامتحان أو رقم أبوجي"><label class="clearfix">
                                    <span class="float-start">erreur numéro examen ou numéro apogée</span>
                                    <span class="float-end"> خطأ في رقم الامتحان أو رقم أبوجي</span>
                                </label>
                            </option>
                            <option value="طلب إعادة التصحيح"><label class="clearfix">
                                    <span class="float-start">Demande de re-correction</span>
                                    <span class="float-end"> طلب إعادة التصحيح</span>
                                </label>
                            </option>
                        </select>
                        <label for="floatingSelectGrid">Sujet de la réclamation</label>
                    </div>
                </div>
            </div>

            <!-- Input field for Comments -->
            <div class="row g-2 mt-1  pt-2">
                <label for="couse" class="clearfix">
                    <span class="float-start">observations <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> ملاحظات </span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <textarea required class="form-control required" placeholder="Leave a comment here" name="couse" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">observations</label>
                    </div>
                </div>
            </div>

          
            <!-- Submit button -->
            <button onclick='window.location.href = "{{ url("/reclamation/")}}"' class="btn btn-secondary  mt-1  float-start   w-25">Back <br>رجوع</button>
            <button type="submit" class="btn btn-success mt-1 w-25 float-end" id="submit-btn">Valider<br> تأكيد</button>

        </form>
        <!-- <button onclick="generatePDF()">Generate PDF</button> -->


    </div>
   
    <div class="modal" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
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
    <!-- <button onclick="generatePDF()">Generate PDF</button> -->

</section>
<div class="row text-center p-3" style="background: #8B4513; color:antiquewhite" >
        <p class="page-footer-text">Faculté des sciences juridiques économiques et sociales Université Mohammed Premier, BV Mohammed VI B.P. 724 Oujda 60000 Maroc.</p>
        <p class="page-footer-text">كلية العلوم القانونية والاقتصادية والاجتماعية جامعة محمد الأول، شارع محمد الخامس، ص.ب, 724 وجدة 60000 المغرب</p>
        <p class="page-footer-text">00212536500597</p>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var submitButton = document.getElementById('submit-btn');
    var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    var confirmSubmitBtn = document.getElementById('confirm-submit-btn');
    var cancelSubmitBtn = document.getElementById('cancel-submit-btn');
    var reclamationForm = document.getElementById('reclamation-form');

    // Event listener for submit button click
    submitButton.addEventListener('click', function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        // Check if the form is complete
        if (isFormComplete()) {
            // Show the confirmation modal
            confirmationModal.show();
        } else {
            // Form is incomplete, do not show the modal
            // You can provide feedback to the user that the form is incomplete
            var errorMessage = document.createElement('div');
            errorMessage.classList.add('alert', 'alert-danger');
            errorMessage.textContent = `Veuillez remplir tous les champs requis.
             يرجى ملء جميع الحقول المطلوبة.`;
            liveAlertPlaceholder.innerHTML = ''; // Clear previous messages
            liveAlertPlaceholder.appendChild(errorMessage);
            var inputFields = document.querySelectorAll('.required');
            inputFields.forEach(function (input) {
                if (input.value.trim() === '') {
                    input.classList.add('border-danger');
                } else {
                    input.classList.remove('border-danger');
                }
            });
        }
    });

    // Event listener for confirm submit button click
    confirmSubmitBtn.addEventListener('click', function () {
        // Hide the confirmation modal
        confirmationModal.hide();
        // Submit the form
        reclamationForm.submit();
    });

    // Event listener for cancel submit button click
    cancelSubmitBtn.addEventListener('click', function () {
        // Hide the confirmation modal
        confirmationModal.hide();
        // You may provide feedback to the user that the action was canceled
        console.log("Form submission canceled.");
    });

    // Function to check if the form is complete
    function isFormComplete() {
        // You can customize this function based on your form fields
        // For example, check if all required fields have values
        // Here, we assume all inputs with class 'required' are required fields
        var requiredFields = document.querySelectorAll('.required');
        for (var i = 0; i < requiredFields.length; i++) {
            if (requiredFields[i].value.trim() === '') {
                return false; // Return false if any required field is empty
            }
        }
        return true; // Return true if all required fields are filled
    }
});




   

    function change_module(selectedSemester, selectedFiliere) {
        $.ajax({
            url: '/fetch-modules/' + selectedFiliere,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var modules = data.modules;

                // Update the dropdown options
                var optionsHtml = '';
                $.each(modules, function(index, module) {
                    optionsHtml += '<option value="' + module.id + '">' + module.NomModule + '</option>';
                });

                // Set the updated options HTML to the dropdown
                $('#moduleDropdown').html(optionsHtml);
            }
        });
    }

    function change_professeurs(selectedmodule) {
        $.ajax({
            url: '/fetch-professeur/' + selectedmodule,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var professeurs = data.professeurs;

                // Update the dropdown options
                var optionsHtml = '';
                $.each(professeurs, function(index, professeur) {
                    optionsHtml += '<option value="' + professeur.id + '">' + professeur.Nom + ' ' + professeur.Prenom + '</option>';
                });

                // Set the updated options HTML to the dropdown
                $('#professeurDropdown').html(optionsHtml);
            }
        });
    }
    $(document).ready(function() {
        // Event listener for changes in the semester dropdown
        $('#filiereDropdown').change(function() {
            var selectedSemester = $('#semesterDropdown').val();
            var selectedFiliere = $('#filiereDropdown').val();
            change_module(selectedSemester, selectedFiliere);
            // Make an Ajax request to fetch modules based on the selected semester and filiere


        });
        $('#moduleDropdown').change(function() {
            var selectedmodule = $('#moduleDropdown').val();
            change_professeurs(selectedmodule);
            // Make an Ajax request to fetch modules based on the selected semester and filiere


        });

        $('#semesterDropdown').change(function() {
            var selectedSemester = $(this).val();

            // Make an Ajax request to fetch filieres based on the selected semester
            $.ajax({
                url: '/fetch-filieres/' + selectedSemester,
                type: 'GET',
                success: function(data) {
                    // Assuming the data structure is { "filieres": [...] }
                    var filieres = data.filieres;

                    // Update the dropdown options
                    var optionsHtml = '';
                    $.each(filieres, function(index, filiere) {
                        optionsHtml += '<option value="' + filiere.id + '">' + filiere.NomFiliere;

                        // Include Parcours in parentheses if it's not 'NULL'
                        if (filiere.Parcours !== '') {
                            optionsHtml += ' (' + filiere.Parcours + ')';
                        }

                        optionsHtml += '</option>';
                    });

                    // Set the updated options HTML to the dropdown
                    $('#filiereDropdown').html(optionsHtml);

                    // Fetch the selected filiere after updating the filiere dropdown
                    var selectedFiliere = $('#filiereDropdown').val();

                    // Make an Ajax request to fetch modules based on the selected filiere
                    change_module(selectedSemester, selectedFiliere);
                }
            });
        });
    });



    function removeLeadingZeros(input) {
        // Remove leading zeros using a regular expression
        input.value = input.value.replace(/^0+/, '');

        // Trim the value to the specified maxlength
        if (input.value.length > input.maxLength) {
            input.value = input.value.slice(0, input.maxLength);
        }
    }

  

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