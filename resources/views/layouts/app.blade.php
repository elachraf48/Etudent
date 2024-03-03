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
        </main>
    </div>
    <span style="position: fixed;"><a style="text-decoration: none" target="_blank" href="http://cv.achraf48.co"> Réaliser et Développé par Achraf-Elabouye</a> </span>

    @stack('modals')

    @livewireScripts
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    </script>
</body>

</html>