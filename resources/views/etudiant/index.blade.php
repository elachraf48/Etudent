<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<link rel="stylesheet" href="{{ asset('css/etudient.css') }}">

<div class="global">
    <!-- CONTENT -->

    <div class="loginContent">
        <div class="main">
            <div class="rightSide ">
                <div class="welcome welcomecl">
                    <div class="inner">
                        <h1 class="welcomeTitle">Bienvenue sur la plateforme de planification des examens <br><br>مرحبًا بك في منصة الاطلاع على جدولة الامتحان الزمنية</h1>
                        <p class="welcomeDesc">Le calendrier des examens comporte la date, l’heure et le lieu de chaque épreuve</p>
                    </div>
                </div>
            </div>
            <div class="leftSide">
                <div class="inner logine">
                    <div class="ministryLogo">
                        <img src="/img/ministry-logo-ar.png" alt="" />
                    </div>
                    <form action="{{ route('search') }}" method="GET" class="">
                        <div class="formLogin">
                            <div class="massarLogo">
                                <img src="/img/banner.png" alt="" />
                            </div>
                            <div class="formLoginStyle">
                                <div class="item">
                                    <input oninput="removeLeadingZeros(this)" maxlength="7" minlength="6" class="" data-val="true" id="CodeApogee" name="CodeApogee" placeholder="Code Apogée" required="required" type="number" value="" />
                                </div>

                                <div class="item">
                                    <button type="submit" id="btnSubmit" class="submitBtn submitBtn-large submitBtncl">calendrier des examens</button>
                                </div>

                                <div class="item">
                                <button class="submitBtn submitBtn-large submitBtnpr"> <a id="btnSubmitd" style="text-decoration: none;font-size: large; color:black;" onclick="redirectToPreinscription()">
            pré-inscription des examens
        </a></button>
</div>
<script>
    function redirectToPreinscription() {
        var codeApogee = document.getElementById("CodeApogee").value;
        var preinscriptionUrl = "{{ route('preinscription.form') }}?CodeApogee=" + codeApogee;
        document.getElementById("btnSubmitd").href = preinscriptionUrl;
    }
</script>

                                <div class="item text-center">
                                    <a style="text-decoration: none;font-size: large;" href="/reclamation">
                                        هل تريد التبليغ عن مشكل في الامتحان ؟<br>
                                        Vous souhaitez signaler un problème lors de l'examen ?
                                    </a>
                                </div>

                                @if (session('error'))
                                <div class="alert alert-danger">
                                    <p>{!! session('error') !!}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>


                    <div id="foot" class="text-secondary text-center">
                        &copy; 2023-<span id="currentYear"></span> <a style="text-decoration: none" href="http://droit.ump.ma/" class="text-secondary" target="_blank" title="Facult&eacute;des Sciences Juridiques, Économiques - Oujda">Facult&eacute;des Sciences Juridiques, Économiques - Oujda</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>

</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    var currentYear = new Date().getFullYear();

    // Set the current year in the HTML
    document.getElementById("currentYear").innerHTML = currentYear;

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