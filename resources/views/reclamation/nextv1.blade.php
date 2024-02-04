<!-- resources/views/students/next.blade.php -->

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->



<!-- CSRF token for Laravel security -->
<section class="text-center">
    <div class="container text-center">
        <div class="row">
            <div class="continue  bg-light">
                <div class="col-md-12 bg-light text-center">
                    <!-- Centered Section with Logo for Mobile -->
                    <div class="mx-auto w-25">
                        <img src="{{ asset('img/banner.png') }}" class="img-fluid w-50" alt="Logo">
                    </div>
                </div>
                <h4 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h4>
                <h4 class="link-danger p-2">Demande de correction de faute matérielle concernant les résultats des examens.</h4>

            </div>
        </div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-center bg-cool   p-3">

        <form  action="{{ route('reclamation') }}" method="post">
        <div class="col-md">
                <div class="form-floating">
                    <select name="filiere" id="filiereDropdown" class="form-control" required>
                        @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->NomFiliere }}
                            @if($filiere->Parcours!=NULL)
                            {({{ $filiere->Parcours }})}
                            @endif
                        </option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">Filiere</label>
                </div>
            </div>
        <button type="submit" id="sub" class="btn btn-primary mt-1 w-100">Next</button>
        </form>
    </div>
</section>
@endsection