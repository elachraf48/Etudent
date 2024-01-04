<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- resources/views/layouts/app.blade.php -->

    <!-- Bootstrap CSS -->

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" type="image/ico" href="https://i.ibb.co/yy8S6Wn/code.png" />


    <title>Calendrier des examens</title>
    <!-- Add your stylesheets, scripts, or other head elements here -->
</head>
<body>
<!-- <header class="banner overlay bg-cover " data-background=""  style="background-color: gold;" >
        <nav class="navbar navbar-expand-md navbar-dark" >
            <div class="container">
                <a class="navbar-brand px-2" href="index.html"><img
                        src="/img/banner.png" height="100px;"
                        width="100px" />

                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                

                </div>
            </div>

        </nav>
        <!-- banner 
        <div class="container section " id="cols">

            <div class="row " >

                <div class="col-lg-12 text-center mx-auto">
                    <h2 class="text mb-3" >Découvrez vos informations relatives au matériel, au lieu et à l'heure de l'examen</h2>
                    <p class="text mb-4">Pour en bénéficier, saisissez votre code étudiant 'Apogee' et votre année de naissance</p>
                    <div class="position-relative">


                    </div>
                </div>

            </div>
        </div>
        <!-- /banner
    </header> -->
    <div id="app">
        @yield('content')
    </div>
    <!-- Add your scripts or other elements before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
