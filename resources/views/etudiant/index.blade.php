<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-cool-color"> <!-- Center the container vertically and horizontally, and apply cool background color -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="section text-center shadow p-4 mb-4 ">
                <div id="idlogoump" class="mb-4">
                    <img src="./img/banner.png" class="w-50" alt="Logo">
                </div>
                <style>
                    .hr-custom-color {border: 0;height: 2px;background: linear-gradient(to right, red, green, blue);opacity: 1;}
                </style>
                <hr class="hr-custom-color mb-4" />

                <div>
                    <h3><span class="text-danger">منصة الاطلاع على جدولة الامتحان الزمنية</span></h3>
                    <h3><span class="text-danger">الخاصة بكل طالب</span></h3>
                    <h3 class="text-secondary">Consultation du calendrier des examens</h3>
                    <h3 class="text-secondary">propre à chaque étudiant</h3>
                    <p class="text-secondary">Le calendrier des examens comporte la date, l’heure et le lieu de chaque épreuve.</p>
                </div>
                <hr class="hr-custom-color mb-4" />

                <form action="{{ route('search') }}" method="GET" class="mb-4">
                    <div class="row justify-content-center">
                        <div class="col-12">
                        <div class="form-floating">
                        <input type="number" placeholder="" name="CodeApogee" oninput="removeLeadingZeros(this)" maxlength="7" class="form-control" required>
                        <label for="floatingSelectGrid">Code Apogée</label>

                    </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 mt-2 shadow">Trouver</button>
                        </div>
                        <div class="col-md-12">
                            <!-- Display the error message if no student is found -->
                            @if(session('error'))
                                <b class="text-danger">{{ session('error') }}</b>
                               @endif
                        </div>
                    </div>
                </form>
                <hr class="hr-custom-color mb-4" />

                <div class="text-secondary">
                    &copy; 2023 <a style="text-decoration: none" href="http://droit.ump.ma/" class="text-secondary" target="_blank" title="Facult&eacute;des Sciences Juridiques, Économiques - Oujda">Facult&eacute;des Sciences Juridiques, Économiques - Oujda</a>
                </div>
            </div>
        </div>
    </div>

   
</div>
<script>
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
