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
                        background: linear-gradient(to right, red, green,blue);
                        opacity: 1;
                    }
                </style>
                <hr class="hr-custom-color mb-4" />

                <div>
                    <h3><span class="text-danger">منصة الاطلاع على جدولة الامتحان الزمنية</span></h3>
                    <h3><span class="text-danger">الخاصة بكل طالب</span></h3>
                    <h3 class="text-secondary">Consultation du calendrier des examens</h3>
                    <h3 class="text-secondary">propre à chaque étudiant</h3>
                    <p class="text-secondary">Le calendrier des examens, comporte la date, l’heure et le lieu de chaque épreuve.</p>
                </div>
                <hr class="hr-custom-color mb-4" /> <!-- Apply custom color to the hr element -->

                <form  action="{{ route('search') }}" method="GET" class="mb-4">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">

                                <input type="text" name="CodeApogee" required class="form-control shadow" placeholder="Enter Code Apogee">
                            </div>
                        </div>
                        <div class="col-12"> <!-- Make the column full-width -->
                            <button type="submit" class="btn btn-primary w-100 mt-2 shadow" >Trouver</button>
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

@endsection
