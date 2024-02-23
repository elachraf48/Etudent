<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<link rel="stylesheet" href="{{ asset('css/etudient.css') }}">

<div class="global">
    <!-- CONTENT -->

    <div class="loginContent">
        <div class="main">
            <div class="rightSide ">
                <div class="welcome welcomere" >
                    <div class="inner">
                        <p class="welcomeTitle">Demande de correction de faute matérielle concernant les résultats des examens.</p>
                        <h1 class="welcomeTitle">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h1>
                        
                    </div>
                </div>
            </div>
            <div class="leftSide">
                <div class="inner logine">
                    <div class="ministryLogo">
                        <img src="/img/ministry-logo-ar.png" alt="" />
                    </div>
                    <form action="{{ route('reclamation.next') }}" method="GET" class="" onsubmit="return validateForm()">
                        <div class="formLogin">
                            <div class="massarLogo">
                                <img src="/img/banner.png" alt="" />
                            </div>
                            <div class="formLoginStyle">
                                <div class="item">
                                    <input oninput="removeLeadingZeros(this)" maxlength="7" minlength="6" Title="" class="" data-val="true" id="CodeApogee" name="CodeApogee" placeholder="Code Apogée" required="required" type="number" value="" />

                                    <select name="semester" id="semesterDropdown" required>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                        <option value="S4">S4</option>
                                        <option value="S5">S5</option>
                                        <option value="S6">S6</option>
                                    </select>
                                    <select name="filiere" id="filiereDropdown" required>
                                        @foreach($filieres as $filiere)
                                        <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }}
                                            @if($filiere->Parcours!='')
                                            {({{ $filiere->Parcours }})}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    <button id="btnSubmit" class="submitBtn submitBtn-large" type="submit">Reclamation</button>

                                </div>
                                <div class="item">
                                </div>
                                <div id="parcoursError" class="alert alert-danger" style="display: none;">
                                    Code Apogée incorrect .
                                </div>

                                @if (session('error'))
                                <div class="alert alert-danger">
                                    <p>{!! session('error') !!}</p>
                                </div>
                                @elseif(session('success'))
                                <div class="alert alert-success">
                                   <p>{!! session('success') !!}</p>
                                </div>
                                @endif

                            </div>
                        </div>
                    </form>
                    <div class="text-secondary">
                        &copy; 2023 <a style="text-decoration: none" href="http://droit.ump.ma/" class="text-secondary" target="_blank" title="Facult&eacute;des Sciences Juridiques, Économiques - Oujda">Facult&eacute;des Sciences Juridiques, Économiques - Oujda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function removeLeadingZeros(input) {
        // Remove leading zeros using a regular expression
        input.value = input.value.replace(/^0+/, '');

        // Trim the value to the specified maxlength
        if (input.value.length > input.maxLength) {
            input.value = input.value.slice(0, input.maxLength);
        }
    }

    function validateForm() {
        var codeApogee = document.getElementById('CodeApogee').value;

        if (codeApogee.length < 6) {
            document.getElementById('parcoursError').style.display = 'block';
            return false;
        } else {
            document.getElementById('parcoursError').style.display = 'none';
        }


        // Additional validation logic can be added here

        return true;
    }
    $(document).ready(function() {
        // Event listener for changes in the semester dropdown
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
                }
            });

        });


    });
</script>
@endsection