<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->

@csrf
<!-- CSRF token for Laravel security -->
<section class="">
<center>

        <div class="continue bg-dark w-75 ">
        <div class="col-md-6 position-relative" >
                    <div id="idlogoump" class="text-center w-25">
                        <img src="../img/banner.png" class="img-fluid" alt="Logo">
                    </div>
                </div>
                <h4 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h4>
                <h4 class="link-danger p-2">Demande de correction de faute matérielle concernant les résultats des examens.</h4>
            </center>

        </div>

    <div class="container-fluid d-flex align-items-center justify-content-center bg-cool-color   p-3">
        <form>
            <!-- Display the current date -->
            <input type="hidden" value="{{ now()->toDateString() }}">
            <!-- Input fields for nom and prenom -->
            <div class="row g-2 mt-1  pt-2">
                <label for="nom" class="clearfix">
                    <span class="float-start">Nom de famille</span>
                    <span class="float-end"> اسم العائلي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="nom" placeholder="" class="form-control" required>
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
                        <input type="text" name="prenom" placeholder="" class="form-control" required>
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
                        <input type="number" placeholder="" name="napogee" oninput="removeLeadingZeros(this)" maxlength="7" class="form-control" required>
                        <label for="floatingSelectGrid">Code Apogée</label>

                    </div>
                </div>

            </div>
            <div class="row g-2 mt-1">
                <label for="semester" class="clearfix">
                    <span class="float-start">Semestre</span>
                    <span class="float-end"> السداسي</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="semester" id="semesterDropdown" class="form-control" required>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                        </select>
                        <label for="floatingSelectGrid">Semester</label>
                    </div>
                </div>
            </div>

            <!-- Dropdown list for semester, filiere, option -->
            <!-- Input fields for N apogee and N d'examen -->
            <div class="row g-2 mt-1">
                <label for="filiere" class="clearfix">
                    <span class="float-start">Filiere</span>
                    <span class="float-end"> المسلك</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="filiere" id="filiereDropdown" class="form-control" required>
                            @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }}
                                @if($filiere->Parcours!='NULL')
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
                    <span class="float-start">Module</span>
                    <span class="float-end"> الوحدة</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="module" id="moduleDropdown" class="form-control" required>
                            @foreach($Modules as $Module)
                            <option value="{{ $Module->id }}">{{ $Module->NomModule }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelectGrid">Module</label>
                    </div>
                </div>
            </div>



            <div class="row g-2 mt-1  pt-2">
                <label for="ndexamen" class="clearfix">
                    <span class="float-start">N d'examen</span>
                    <span class="float-end"> رقم الامتحان</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" name="ndexamen" oninput="removeLeadingZeros(this)" maxlength="7" placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">N d'examen</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="filiere" class="clearfix">
                    <span class="float-start">Salle ou Aphhi</span>
                    <span class="float-end"> مكان اجتياز الامتحان</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="filiere" placeholder="" class="form-control" required>
                        <label for="floatingSelectGrid">Salle ou Aphhi</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mt-1  pt-2">
                <label for="option" class="clearfix">
                    <span class="float-start">Group</span>
                    <span class="float-end"> </span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="option" placeholder="" class="form-control">
                        <label for="floatingSelectGrid">Group</label>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-1">
                <label for="reclamation" class="clearfix">
                    <span class="float-start">Sujet de la réclamation</span>
                    <span class="float-end"> موضوع الطلب</span>
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





            <!-- Input field for professeur -->
            <div class="row g-2 mt-1">
                <label for="professeurv" class="clearfix">
                    <span class="float-start">Professeur</span>
                    <span class="float-end"> مدرس</span>
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


            <!-- Input field for Comments -->
            <div class="row g-2 mt-1  pt-2">
                <label for="couse" class="clearfix">
                    <span class="float-start">observations</span>
                    <span class="float-end">ملاحظات</span>
                </label>
                <div class="col-md">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="couse" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">observations</label>
                    </div>
                </div>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label clearfix" for="flexSwitchCheckDefault">
                    <span class="float-start">Recueillir des informations correctes ---</span>
                    <span class="float-end"> جمع المعلومات صحيحة </span>
                </label>
            </div>

            <!-- Submit button -->
            <button type="submit" id="sub" class="btn btn-primary mt-1 w-100">Next</button>
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
                        if (filiere.Parcours !== 'NULL') {
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
    $(document).ready(function() {
        $('#sub').click(function() {
            if ($('#flexSwitchCheckDefault').is(':checked')) {
                // Checkbox is checked, perform your actions here
                // For example, submit the form or execute some other logic
            } else {
                // Checkbox is not checked, show an alert
                alert('Please check the checkbox before submitting.');
            }
        });
    });
</script>

@endsection