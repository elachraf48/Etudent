<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/ico" href="https://i.ibb.co/yy8S6Wn/code.png" />
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            <!-- confirmation delete old data -->
 
        </main>
    </div>
    <div class="modal " id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content p-3" style="border: 3px solid red; margin-top: 40vh;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-bodyy">
                        <label class="form-check-label clearfix" for="flexSwitchCheckDefault">
                            <span class="float-start">Voulez-vous supprimer toutes les informations avant de inséré ? </span><br>
                            <span class="float-end">هل تريد إزالة جميع المعلومات قبل الإدراج؟</span>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler <br>الغاء</button>
                        <button type="button" class="btn btn-success" id="confirm-submit-btn">Valider<br> تأكيد</button>
                    </div>
                </div>
            </div>
        </div>
    <span style="position: fixed;"><a style="text-decoration: none" target="_blank" href="http://cv.achraf48.co"> Réaliser et Développé par Achraf-Elabouye</a> </span>

    @stack('modals')

    @livewireScripts
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function saveAsCSV() {
            // Get all textareas with the class 'data-input'
            var textareas = document.getElementsByTagName('textarea');

            // Initialize an array to store all the lines of data
            var placeholderTexts = [];

            // Loop through each textarea element
            for (var i = 0; i < textareas.length; i++) {
                // Get the placeholder text of each textarea and push it to the array
                var placeholder = textareas[i].getAttribute('placeholder');
                placeholderTexts.push(placeholder);
            }

            // Convert rows to CSV format
            const csvContent = placeholderTexts.join(","); // Join all placeholder texts with a comma
            const bom = "\uFEFF";
            const csvData = bom + csvContent;

            // Create a Blob containing the CSV data
            const blob = new Blob([csvData], {
                type: "text/csv"
            });

            // Specify the filename for the CSV file
            const filename = "output.csv";

            // Create a link element to trigger the download
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = filename;

            // Programmatically trigger the download
            link.click();

        }
         //select semester
         const sessionDropdown = document.getElementById('sessionDropdown');
        const semesterDropdown = document.getElementById('semesterDropdown');

        // Add event listener to the session dropdown
        sessionDropdown.addEventListener('change', function() {
            // Clear previous options
            semesterDropdown.innerHTML = '';

            // Get the selected session type
            const sessionType = this.options[this.selectedIndex].getAttribute('data-session-type');

            // Define the options based on the selected session type
            let options = [];
            if (sessionType === '1') {
                options = ['S1', 'S3', 'S5'];
            } else {
                options = ['S2', 'S4', 'S6'];
            }

            // Add the options to the semester dropdown
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                semesterDropdown.appendChild(optionElement);
            });
        });
    </script>
</body>

</html>