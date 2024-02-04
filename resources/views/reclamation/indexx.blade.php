<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-cool-color"> <!-- Center the container vertically and horizontally, and apply cool background color -->
    <div class="row justify-content-center">
        <div class="col-md-10"> <!-- Increase the width of the column -->
            <div class="section text-center shadow p-4 mb-4 bg-white">
                <div id="idlogoump" class="mb-4">
                    <img src="./img/banner.png" class="w-50" alt="Logo">
                </div>
                <style>
                    .hr-custom-color {
                        border: 0;
                        height: 2px;
                        background: linear-gradient(to right, red, green, blue);
                        opacity: 1;
                    }
                </style>
                <hr class="hr-custom-color mb-4" />

                <div>
                    <h3 class="text-danger">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h4>
                    <h4 class="text-secondary">Demande de correction de faute matérielle <br>concernant les résultats des examens.</h5>
                    <!-- <p class="text-secondary">Le calendrier des examens, comporte la date, l’heure et le lieu de chaque épreuve.</p> -->
                </div>
                <hr class="hr-custom-color mb-4" /> <!-- Apply custom color to the hr element -->

                <form action="{{ route('reclamation.next') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md" alt="madirch 0">
                            <div class="form-floating">
                                <input type="number" placeholder="" name="napogee" oninput="removeLeadingZeros(this)" maxlength="7" class="form-control" required>
                                <label for="floatingSelectGrid">N apogee</label>
                            </div>
                        </div>
                        <div class="row g-2 mt-1 p-1">

                            <div class="col-md-3">
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
                            <div class="col-md-9">
                                <div class="form-floating">
                                    <select name="filiere" id="filiereDropdown" class="form-control" required>
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
                        <div class="row g-2 mt-1 p-1">
                            
                        </div>

                        <div class="col-12"> <!-- Make the column full-width -->
                            <button type="submit" class="btn btn-primary w-100 mt-2 shadow">Reclamation</button>
                        </div>
                        <div class="col-md-12">
                            <b id="noStudentError" class="text-danger" style="display: none;">Aucun étudiant trouvé avec le Code Apogee fourni.</b>
                        </div>

                    </div>
                </form>
                <hr class="hr-custom-color mb-4" /> <!-- Apply custom color to the hr element -->

                <div class="text-secondary">
                    &copy; 2023 <a style="text-decoration: none" href="http://droit.ump.ma/" class="text-secondary" target="_blank" title="Facult&eacute;des Sciences Juridiques, Économiques - Oujda">Facult&eacute;des Sciences Juridiques, Économiques - Oujda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Student Details if Search is Performed -->
    <div id="studentDetails" style="display: none;">
        <!-- Display student details here -->
        <p id="studentDetailsContent"></p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function setHiddenValues() {
        // Set the value of hidden input for 'numero apogee'
        var napogeeInput = document.getElementById('hiddenNapogee');
        napogeeInput.value = document.querySelector('[name="napogeeInput"]').value;
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

    function removeLeadingZeros(input) {
        // Remove leading zeros using a regular expression
        input.value = input.value.replace(/^0+/, '');

        // Trim the value to the specified maxlength
        if (input.value.length > input.maxLength) {
            input.value = input.value.slice(0, input.maxLength);
        }
    }
</script>

@endsection