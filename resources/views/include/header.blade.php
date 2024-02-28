
<link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">
<style>
    .btn {
        width: 8em;
        height: 2.5em;
    }

   

    .home {
        background-color: white;
        min-height: 100vh;
    }
</style>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0">
    <div class="container-fluid ">
        <a class="nav-link active text-white m-6" aria-current="page" href="/">
            <i class="fa-solid fa-house"></i> Accueil
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-centre" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto ">
                <li class="nav-item">
                    <button class="btn btn-success m-1" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                        Reclamation
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary position-relative m-1">
                        Repense
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
            <div class="d-flex">
                <button class="btn btn-danger m-1" onclick='window.location.href = "{{ url("/") }}"'>
                    Déconnexion
                </button>
            </div>
        </div>
    </div>
</nav>
