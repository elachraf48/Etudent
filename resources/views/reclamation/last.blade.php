<!-- resources/views/reclamation/last.blade.php -->

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->

<head>
    <!-- Include your other <head> elements here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">

</head>

<!-- CSRF token for Laravel security -->
<section class="text-center  bg-light">
    <div class="container-fluid-wrapper p-0">

        <div class="container-fluid  text-center">
            <header class="container">
                <!-- <div class="text-center">
                    <img src="{{ asset('img/ministry-logo-ar.png') }}" class="img-fluid w-100 h-75" alt="Logo">
            </div> -->
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
            <div class="row">

                <nav class="navbar navbar-expand-lg mt-3" style="background: #8B4513;">
                    <div class="container ">
                        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="desktop-nav">
                                <li class="nav-item">
                                    <p class="text-white">
                                        <a class="nav-link active text-white" aria-current="page" href="/reclamation/">
                                            <i class="fa-solid fa-house"></i> Reclamation
                                        </a>
                                        <i class="fa-solid fa-arrow-right-long"></i> Espace étudiant
                                    </p>
                                </li>
                            </ul>

                            <button class="btn btn-light" id="mobile-button" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                                <i class="fa-solid fa-house"></i>
                            </button>

                            <!-- <button class="btn btn-info m-1" onclick="printPage()">
                                <i class="fa-solid fa-print"></i>
                            </button> -->
                            <button class="btn btn-success m-1" onclick='window.location.href = "{{ url("/reclamation/") }}"'>
                                New Reclamation
                            </button>
                            <button class="btn btn-danger m-1" onclick='window.location.href = "{{ url("/") }}"'>
                                Calendrier
                            </button>
                        </div>
                    </div>
                </nav>
                <div class="continue-fluid bg-gray" style="background:#CD853F; ">

                    <h5 class="link-danger mt-5">Demande de correction de faute matérielle concernant les résultats des examens.</h5>
                    <h5 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h5>
                </div>

            </div>

        </div>
       
       

    </div>
    <center class="m-5">
        @if (session('error'))
        <div class="alert alert-danger ">
            <h4>{!! session('error') !!}</h4>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success ">
            <h4>{!! session('success') !!}</h4>
        </div>
        @endif
        <button class="cssbuttons-io-button">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
    <path fill="none" d="M0 0h24v24H0z"></path>
    <path fill="currentColor" d="M1 14.5a6.496 6.496 0 0 1 3.064-5.519 8.001 8.001 0 0 1 15.872 0 6.5 6.5 0 0 1-2.936 12L7 21c-3.356-.274-6-3.078-6-6.5zm15.848 4.487a4.5 4.5 0 0 0 2.03-8.309l-.807-.503-.12-.942a6.001 6.001 0 0 0-11.903 0l-.12.942-.805.503a4.5 4.5 0 0 0 2.029 8.309l.173.013h9.35l.173-.013zM13 12h3l-4 5-4-5h3V8h2v4z"></path>
  </svg>
  <span>Download Reclamation</span>
</button>

        </center>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection