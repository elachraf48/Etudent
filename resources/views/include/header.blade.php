<link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">
<style>
    .btn {
        width: 10em;


    }



    .home {
        background-color: white;
        min-height: 100vh;
    }
</style>
<head>
</head>
<header class="bg-white">
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

<nav class="navbar navbar-expand-lg navbar-dark m-0" style="background: #B67352;">
    <div class="container-fluid ">
        <a class="nav-link active text-white mx-5" aria-current="page" href="/">
            <i class="fa-solid fa-house"></i> Accueil
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse text-centre" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto  ">
                <li class="nav-item">
                    <button class="btn btn-primary m-1" style="background: #C38154;" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                        Réclamation <br> شكاية
                    </button>
                </li>
                <li>
                    <button class="btn btn-primary m-1" style="background: #C38154;" id="cl" >
                        Calendrier examen <br>جدول الامتحانات
                    </button>
                </li>
                

                <li class="nav-item">
                    <button type="button" class="btn btn-primary position-relative m-1" style="background: #C38154;" id="rp" data-apogee="">
                        Réponses <br>اجوبة
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="reclamationsCount">
                            0
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </li>
                <!-- <li class="nav-item">
                    <button class="btn btn-info m-1" onclick="printPage()">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </li> -->
            </ul>
            <!-- <div class="hstack gap-3">
  <div class="p-2">First item</div>
  <div class="p-2 ms-auto">Second item</div>
  <div class="vr"></div>
  <div class="p-2">Third item</div>
</div> -->
            <div class="d-flex">
                <button class="btn btn-danger m-1" onclick='window.location.href = "{{ url("/") }}"'>
                    Déconnexion <br>خروج
                </button>
            </div>
        </div>
    </div>
</nav>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
        // Click event handler for the "Repense" button
        $('#rp').click(function() {
            // Get the value of data-apogee attribute
            var CodeApogee = $(this).data('apogee');

            // Navigate to the repense page with CodeApogee as a query parameter
            window.location.href = "/etudiant/Repense?CodeApogee=" + CodeApogee;
        });

        $('#cl').click(function() {
            // Get the value of data-apogee attribute
            var CodeApogee = $(this).data('apogee');

            // Navigate to the repense page with CodeApogee as a query parameter
            window.location.href = "/etudiant/search?CodeApogee=" + CodeApogee;
        });
    function updateReclamationsCount() {
        var CodeApogee = $(this).data('apogee');
        $('.btn-primary').attr('data-apogee', CodeApogee);

        $.ajax({
            url: "/reclamations/etudiant/" + CodeApogee,
            method: 'GET',
            success: function(response) {
                // Update the count in the navigation menu
                $('#reclamationsCount').text(response.count > 0 ? response.count : '0');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    // updateReclamationsCount();

    setInterval(updateReclamationsCount, 6000);
   





</script>