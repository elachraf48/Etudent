<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<link rel="stylesheet" href="{{ asset('css/etudient.css') }}">

<div class="global">
    <!-- CONTENT -->

    <div class="loginContent">
        <div class="main">
            <div class="rightSide ">
                <div class="welcome">
                    <div class="inner">
                        <p class="welcomeTitle">Demande de correction de faute matérielle concernant les résultats des examens.</p>
                        <h1 class="welcomeTitle">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h1>
</div>
                </div>
            </div>
            <div class="leftSide">
                <div class="inner logine">
                    <div class="ministryLogo">
                        <img src="/img/ministry-logo-ar.png" alt="" />
                    </div>
                    <form action="{{ route('reclamation.next') }}" method="POST" class="">
                        @csrf
                        <div class="formLogin">
                            <div class="massarLogo">
                                <img src="/img/banner.png" alt="" />
                            </div>
                            <div class="formLoginStyle">
                                <div class="item">
                                    <input oninput="removeLeadingZeros(this)" maxlength="7" minlength="6" Title="" class="" data-val="true" id="CodeApogee" name="CodeApogee" placeholder="Code Apogée" required="required" type="number" value="" />

                                </div>




                                <div class="item">
                                    <button id="btnSubmit" class="submitBtn submitBtn-large" type="submit">Reclamation</button>
                                </div>

                                
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    <p>{!! session('error') !!}</p>
                                </div>
                                @endif
                               
                            </div>
                        </div>
                    </form>
                    <div class="text-secondary">
                    &copy; 2023 <a style="text-decoration: none" href="http://droit.ump.ma/" class="text-secondary" target="_blank" title="Facult&eacute;des Sciences Juridiques, Économiques - Oujda">Facult&eacute;des Sciences Juridiques, Économiques - Oujda</a>
                </div>
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