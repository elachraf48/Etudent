<!-- resources/views/admin/Calendrier_modules.blade.php -->

@extends('dashboard')

@section('content')
<div class="container">
    <h2>Insert Calendrier Modules Data</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('Calendrier_modules_form') }}">
        @csrf
        <div class="row g-2 mt-1">

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
        <!-- Add a textarea to paste the data -->
        <div class="mb-3">
            <textarea name="exam_data" class="form-control" rows="10" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Insert Data</button>
    </form>
</div>
<!-- ... Your existing HTML code ... -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
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
                        if (filiere.Parcours !== 'NULL') {
                            optionsHtml += ' (' + filiere.Parcours + ')';
                        }
                        
                        optionsHtml += '</option>';                    });

                    // Set the updated options HTML to the dropdown
                    $('#filiereDropdown').html(optionsHtml);
                }
            });

        });
    });
</script>

<!-- ... Your existing Blade code ... -->

@endsection