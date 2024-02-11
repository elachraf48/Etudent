<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->

<head>
    <!-- Include your other <head> elements here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<style>
    body {
        width: 100vw;
    }

    /* Styles for the container */
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Styles for left and right text */
    .text {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    /* Styles for Arabic text */
    .text.arabic {
        direction: rtl;
    }

    .text-white {
        display: flex;
        align-items: center;
    }

    .text-white a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .text-white a i {
        margin-right: 5px;
        /* Adjust as needed */
    }
</style>
<!-- CSRF token for Laravel security -->
<section class="text-center  bg-light">

    <div class="container-fluid w-75   text-center">
        <header class="container">
            <!-- <div class="text-center">
                    <img src="{{ asset('img/ministry-logo-ar.png') }}" class="img-fluid w-100 h-75" alt="Logo">
            </div> -->
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
        <div class="row">

            <nav class="navbar navbar-expand-lg bg-dark mt-3" >
                <div class="container ">
                    <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <p class="text-white">
                                    <a class="nav-link active text-white" aria-current="page" href="/">
                                        <i class="fa-solid fa-house"></i> Accueil
                                    </a>
                                    <i class="fa-solid fa-arrow-right-long"></i> Espace étudiant
                                </p>

                            </li>
                        </ul>
                            <button class="btn btn-info m-1" onclick="printPage()">
                                <i class="fa-solid fa-print"></i>
                            </button>
                            <button class="btn btn-success m-1" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                                New Reclamation
                            </button>
                            <button class="btn btn-danger m-1" onclick='window.location.href = "{{ url("/") }}"'>
                                Calendrier
                            </button>
                    </div>
                </div>
            </nav>
            <div class="continue-fluid "style="background:#CD853F; ">

                <h5 class="link-danger mt-5">Demande de correction de faute matérielle concernant les résultats des examens.</h5>
                <h5 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h5>
            </div>

        </div>

    </div>

    <div class="container-fluid d-flex align-items-center justify-content-center    p-3" >

        <form action="{{ route('reclamationpost') }}" method="post">
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
                        <input type="number" value="{{ $codeApogee }}" readonly placeholder="" name="napogee" oninput="removeLeadingZeros(this)" maxlength="7" class="form-control" required>
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
                        <select name="module" id="moduleDropdown" class="form-control" required>
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
                        <input type="text" name="lieu" @if($Lieu!='' ) value="{{ $Lieu }}" readonly @endif placeholder="" class="form-control" required>
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

                        <select name="Group" id="GroupDropdown" class="form-control" required>
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
                    <span class="float-end"><span class="text-danger">*</span> مدرس</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="professeur" id="professeurDropdown" class="form-control" required>
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
                        <select name="reclamation" id="idreclamation" class="form-control" required>
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
                        <textarea required class="form-control" placeholder="Leave a comment here" name="couse" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">observations</label>
                    </div>
                </div>
            </div>

            <div class="form-check form-switch " id="formswitch">
                <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" required>
                <label class="form-check-label clearfix" for="flexSwitchCheckDefault">
                    <span class="float-start">Vous avez confirmé que les informations ont été collectées et qu'elles sont correctes | </span>
                    <span class="float-end"> لقد قمت بتأكيد من جمع المعلومات وهي صحيحة </span>
                </label>
            </div>
            <!-- Submit button -->
            <button onclick='window.location.href = "{{ url("/reclamation/")}}"' class="btn btn-secondary  mt-1  float-start   w-25">Back <br>رجوع</button>
            <button type="submit" class="btn btn-success mt-1 w-25 float-end">Valider<br> تأكيد</button>

        </form>
        <!-- <button onclick="generatePDF()">Generate PDF</button> -->
        

    </div>
    <div class="row" style="background: #8B4513; color:antiquewhite" id="paper-footer">
            <p class="page-footer-text">Faculté des sciences juridiques économiques et sociales Université Mohammed Premier, BV Mohammed VI B.P. 724 Oujda 60000 Maroc.</p>
            <p class="page-footer-text">كلية العلوم القانونية والاقتصادية والاجتماعية جامعة محمد الأول، شارع محمد الخامس، ص.ب, 724 وجدة 60000 المغرب</p>
            <p class="page-footer-text">00212536500597</p>
        </div>

    <!-- <button onclick="generatePDF()">Generate PDF</button> -->

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function generatePDF() {
        const doc = new jsPDF();
        let y = 10;
        let lineHeight = 5;

        // Iterate through all input and select elements
        $('input, select').each(function() {
            // Get the label associated with this element
            const label = $('label[for="' + $(this).attr('id') + '"]').text();

            // Get the value of the element
            const value = $(this).val();

            // Add the label and value to the PDF
            doc.text(label + ': ' + value, 10, y);

            // Increment the y-coordinate for the next line
            y += lineHeight;
        });

        // Save the PDF document
        doc.save('form_data.pdf');
    }

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

    function back() {
        window.location.href = "{{ url(" / reclamation + ")}}";
    }

    function removeLeadingZeros(input) {
        // Remove leading zeros using a regular expression
        input.value = input.value.replace(/^0+/, '');

        // Trim the value to the specified maxlength
        if (input.value.length > input.maxLength) {
            input.value = input.value.slice(0, input.maxLength);
        }
    }
    //    $(document).ready(function() {
    //         $('#sub').click(function() {
    //             if ($('#flexSwitchCheckDefault').is(':checked')) {
    //                 // Checkbox is checked, perform your actions here
    //                 // For example, submit the form or execute some other logic
    //             } else {
    //                 // Checkbox is not checked, show a Bootstrap alert
    //                 $('#bootstrapAlert').html(`
    //                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                         Please check the checkbox before submitting.
    //                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                             <span aria-hidden="true">&times;</span>
    //                         </button>
    //                     </div>
    //                 `);
    //             }
    //         });
    //     });
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
    const formswitch = document.getElementById('formswitch');

    const alert = (message, type) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');

        alertPlaceholder.innerHTML = ''; // Clear previous alerts
        alertPlaceholder.append(wrapper);
        formswitch.classList.add('text-danger');
        // Hide the alert after 6 seconds (6000 milliseconds)
        setTimeout(() => {
            alertPlaceholder.innerHTML = ''; // Clear the alert after 6 seconds
        }, 10000);
    };

    const alertTrigger = document.getElementById('sub');

    if (alertTrigger) {
        alertTrigger.addEventListener('click', () => {
            if ($('#flexSwitchCheckDefault').is(':checked')) {
                // Checkbox is checked, perform your actions here
                // For example, submit the form or execute some other logic
            } else {

                alert(`Toutes les informations sont-elles correctes ? Cliquez sur le bouton en fin de page pour accepter<br>
            هل كل المعلومات صحيحة؟ انقر على الزر الموجود في نهاية الصفحة للقبول 
            `, 'danger');
            }
        });
    }
</script>

@endsection