<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/ico" href="https://i.ibb.co/yy8S6Wn/code.png" />
    <title>Calendrier des examens</title>
    <!-- Add your stylesheets, scripts, or other head elements here -->
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    
<!-- Remove the slim version -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
         
    $(document).ready(function() {

   
        // Initial setup
        updateNomFiliereDropdown();

        // Handle change event of the Semester dropdown
        $('#semesterDropdown').on('change', function() {
            updateNomFiliereDropdown();
        });

        // Handle change event of the NomFiliere dropdown
        $('#nomFiliereDropdown').on('change', function() {
            updateParcoursDropdown();

        });

        // Update the Module dropdown when Parcours changes
        $('#parcoursDropdown').on('change', function() {
            updateModuleDropdown();

        });
         

        // Function to update the NomFiliere dropdown
        function updateNomFiliereDropdown() {
            // Send an AJAX request to the Laravel route
            $.ajax({
                url: '/get-nom-filiere',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {
                    // Update the NomFiliere dropdown list with the new options
                    var nomFiliereDropdown = $('#nomFiliereDropdown');
                    nomFiliereDropdown.empty();
                    $.each(response, function(key, value) {
                        nomFiliereDropdown.append('<option value="' + value + '">' + value + '</option>');
                    });

                    // Trigger change event to update the Parcours dropdown when NomFiliere changes
                    nomFiliereDropdown.trigger('change');
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
                
            });
            
        }

        // Function to update the Parcours dropdown
        function updateParcoursDropdown() {
            // Get selected values
            var selectedNomFiliere = $('#nomFiliereDropdown').val();
            var selectedSemester = $('#semesterDropdown').val();

            // Construct the query dynamically
            var query = {
                _token: '{{ csrf_token() }}',
                nomFiliere: selectedNomFiliere,
                semester: selectedSemester,
            };

            // Send an AJAX request to the Laravel route
            $.ajax({
                url: '/get-parcours',
                type: 'POST',
                data: query,
                dataType: 'json',
                success: function(response) {
                    // Update the parcours dropdown list with the new options
                    var parcoursDropdown = $('#parcoursDropdown');
                    parcoursDropdown.empty();
                    $.each(response, function(key, value) {
                        parcoursDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });

                    // Trigger change event to update the Module dropdown when Parcours changes
                    parcoursDropdown.trigger('change');
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });
        }

        //-----------------------------
  

        // Function to update the Module dropdown
        function updateModuleDropdown() {
            // Get selected values
            var selectedSemester = $('#semesterDropdown').val();
            var selectedNomFiliere = $('#nomFiliereDropdown').val();
            var selectedParcours = $('#parcoursDropdown').val();
            var query = {
                _token: '{{ csrf_token() }}',
                semester: selectedSemester,
                nomFiliere: selectedNomFiliere,
                parcours: selectedParcours,
            };

            // Make an AJAX request to get the modules based on the selected values
            $.ajax({
                url: '/get-modules', // Adjust the route URL accordingly
                type: 'POST',
                data: query,
                dataType: 'json',
                success: function (response) {
                    // Update the Module dropdown list with the new options
                    var moduleDropdown = $('#moduleDropdown');
                    moduleDropdown.empty();
                    $.each(response, function (index, value) {
                        moduleDropdown.append('<option value="' + value.CodeModule + '">' + value.NomModule + '</option>');
                    });
                    moduleDropdown.trigger('change');

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });
        }

    });
    </script>
</body>
</html>
