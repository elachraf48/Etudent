<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->



<!-- CSRF token for Laravel security -->
<section class="text-center">
    <div class="container text-center">
        <div class="row">
            <div class="continue  bg-light">
                <div class="col-md-12 bg-light text-center">
                    <!-- Centered Section with Logo for Mobile -->
                    <div class="mx-auto w-25">
                        <img src="{{ asset('img/banner.png') }}" class="img-fluid w-50" alt="Logo">
                    </div>
                </div>
                <h4 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h4>
                <h4 class="link-danger p-2">Demande de correction de faute matérielle concernant les résultats des examens.</h4>

            </div>
        </div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-center bg-cool   p-3">

        <form action="{{ route('reclamationpost') }}" method="post">
             @csrf

            <div id="liveAlertPlaceholder"></div>

            <!-- Display the current date -->

            <?php
            $currentYear = date('Y');
            $AnneeUniversitaire = ($currentYear - 1) . '-' . $currentYear;
            ?>

            <input type="hidden" name="AnneeUniversitaire" value="<?= $AnneeUniversitaire ?>" />
            @if ($student && count($student) > 0)
                @foreach ($student as $key => $students)
                    @if ($key === count($student) - 1)
                        @php
                            $Nom=$students->Nom;
                            $Prenom=$students->Prenom;
                            $CodeApogee=$students->CodeApogee;
                            $NomGroupe=$students->NomGroupe;
                            $Lieu=$students->Lieu;
                            $NumeroExamen=$students->NumeroExamen;
                        @endphp
                    @endif
                @endforeach
                @else
                    @php
                        $Nom='';
                        $Prenom='';
                        $NomGroupe='';
                        $Lieu='';
                        $NumeroExamen='';
                    @endphp
            @endif
            @if (!$student || count($student) === 0)
            <div class="alert alert-danger" role="alert">
                اسمك غير مدرج في قائمة الامتحانات المرجو ملئ الاستمارة كاملة
                <br>
                Votre nom ne figure pas sur la liste d'examen, veuillez remplir complètement le formulaire.
            </div>
            @endif
            <!-- Input fields for nom and prenom -->
            <div class="row g-2 mt-1  pt-2">
                <label for="nom" class="clearfix">
                    <span class="float-start">Nom de famille</span>
                    <span class="float-end"> اسم العائلي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="nom" @if($Nom!='' ) value="{{ $Nom }}" disabled @endif placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">Nom de famille</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="prenom" class="clearfix">
                    <span class="float-start">prénom</span>
                    <span class="float-end"> الاسم الشخصي </span>
                </label>
                <div class="col-md">

                    <div class="form-floating">
                        <input type="text" name="prenom" @if($Prenom!='' ) value="{{ $Prenom }}" disabled @endif placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">prénom</label>
                    </div>
                </div>
            </div>


            <div class="row g-2 mt-1  pt-2">
                <label for="number" class="clearfix">
                    <span class="float-start">Numéro d'inscription Apogée</span>
                    <span class="float-end"> رقم التسجيل أبوجي</span>
                </label>
                <div class="col-md" alt="madirch 0">
                    <div class="form-floating">
                        <input type="number" value="{{ $codeApogee }}" disabled placeholder="" name="napogee" oninput="removeLeadingZeros(this)" maxlength="7" class="form-control" required>
                        <label for="floatingSelectGrid">Code Apogée</label>

                    </div>
                </div>

            </div>
            <div class="row g-2 mt-1">
                <label for="semester" class="clearfix">
                    <span class="float-start">Semestre <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> السداسي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" value="{{$semester}}" disabled placeholder="" name="semester" class="form-control" required>
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
                        <select name="filiere" id="filiereDropdown" class="form-control" disabled required>
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
                    <span class="float-start">N d'examen <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> رقم الامتحان</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" @if($NumeroExamen!='' ) value="{{ $NumeroExamen }}" disabled @endif name="ndexamen" oninput="removeLeadingZeros(this)" maxlength="7" placeholder="" class="form-control" required>
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
                        <input type="text" name="filiere" @if($Lieu!='' ) value="{{ $Lieu }}" disabled @endif placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">Salle ou Aphhi</label>
                    </div>
                </div>
            </div>
            @if( count($Groups)>1 )
            <div class="row g-2 mt-1  pt-2">
                <label for="option" class="clearfix">
                    <span class="float-start">Group</span>
                    <span class="float-end">مجموعة </span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <!-- <input type="text" value="{{$students->NomGroupe}}" name="option" placeholder="" disabled class="form-control"> -->

                        <select name="module" id="moduleDropdown" class="form-control" required>
                            @foreach($Groups as $Group)
                            <option value="{{ $Group->id }}">{{ $Group->nomGroupe }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelectGrid">Group</label>
                    </div>
                </div>
            </div>
            @endif
            <!-- Input field for professeur -->
            <div class="row g-2 mt-1">
                <label for="professeurv" class="clearfix">
                    <span class="float-start">Professeur <span class="text-danger">*</span></span>
                    <span class="float-end"><span class="text-danger">*</span> مدرس</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="professeur" id="filiereDropdown" class="form-control" required>
                            <option value="S2">S2</option>

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
                            <option disabled value="S5" selected><label class="clearfix">
                                    <span class="float-start">Sujet de la réclamation</span>
                                    <span class="float-end"> موضوع الطلب</span>
                                </label>
                            </option>
                            <option value="S1"><label class="clearfix">
                                    <span class="float-start">Non inscrit au module</span>
                                    <span class="float-end"> غير مسجل في الوحدة</span>
                                </label>
                            </option>
                            <option value="S2"><label class="clearfix">
                                    <span class="float-start">Omission d'attribution de la note</span>
                                    <span class="float-end"> عدم ادراج النقطة</span>
                                </label>
                            </option>
                            <option value="S3"><label class="clearfix">
                                    <span class="float-start">erreur numéro examen ou numéro apogée</span>
                                    <span class="float-end"> خطأ في رقم الامتحان أو رقم أبوجي</span>
                                </label>
                            </option>
                            <option value="S4"><label class="clearfix">
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
                    <span class="float-start">Recueillir des informations correctes ---</span>
                    <span class="float-end"> جمع المعلومات صحيحة </span>
                </label>
            </div>

            <!-- Submit button -->
            <button onclick='window.location.href = "{{ url("/reclamation")}}"' class="btn btn-primary mt-1 w-25 ">Back</button>
            <button type="submit" id="sub" class="btn btn-success mt-1 w-50">Next</button>
        </form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function change_module(selectedSemester, selectedFiliere) {
        $.ajax({
            url: '/fetch-modules/' + selectedFiliere,
            type: 'GET',
            success: function(data) {
                // Assuming the data structure is { "modules": [...] }
                var modules = data.modules;
                optionsHtml += '<option value="' + selectedSemester + '">' + selectedFiliere + '</option>';

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
    $(document).ready(function() {
        // Event listener for changes in the semester dropdown
        $('#filiereDropdown').change(function() {
            var selectedSemester = $('#semesterDropdown').val();
            var selectedFiliere = $('#filiereDropdown').val();
            change_module(selectedSemester, selectedFiliere);
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