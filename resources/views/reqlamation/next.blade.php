<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-cool-color  ">
    <!-- Center the container vertically and horizontally, and apply cool background color -->

    <form>
        @csrf
        <!-- CSRF token for Laravel security -->

        <!-- Display the current date -->
        <label for="date" class="">{{ now()->toDateString() }}</label>

        <!-- Input fields for nom and prenom -->
        <div class="row g-2 mt-1">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" name="nom" placeholder="" class="form-control" required>
                    <label for="floatingSelectGrid">Nom</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" name="prenom" placeholder="" class="form-control" required>
                    <label for="floatingSelectGrid">Prenom</label>
                </div>
            </div>
        </div>


        <div class="row g-2 mt-1">
            <div class="col-md" alt="madirch 0">
                <div class="form-floating">
                    <input type="number" placeholder="" name="napogee" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7" class="form-control" required>
                    <label for="floatingSelectGrid">N apogee</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="semester" id="semesterDropdown" class="form-control" required>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="S4">S4</option>
                        <option value="S5">S5</option>
                        <option value="S6">S6</option>
                    </select>
                    <label for="floatingSelectGrid">Semester</label>
                </div>
            </div>
        </div>
        <!-- Dropdown list for semester, filiere, option -->
        <!-- Input fields for N apogee and N d'examen -->
        <div class="row g-2 mt-1">
            <div class="col-md">
                <div class="form-floating">
                    <select name="nomFiliere" id="nomFiliereDropdown" class="form-control" required>
                        @foreach($filiereOptions as $nomFiliere)
                        <option value="{{ $nomFiliere }}">{{ $nomFiliere }}</option>
                        @endforeach
                    </select>
                    <label for="nomFiliereDropdown">Nom Filiere</label>
                </div>
            </div>


            <div class="form-floating parcours-dropdown ">
                <select name="parcours" id="parcoursDropdown" class="form-control" required>
                    <!-- Options will be dynamically populated using JavaScript -->
                </select>
                <label for="parcoursDropdown">Parcours</label>
            </div>
        </div>

        <div class="col-md mt-1">
            <div class="form-floating">
                <input type="text" name="ndexamen" class="form-control" placeholder="">
                <label for="floatingSelectGrid">N d'examen</label>
            </div>
        </div>
        <div class="row g-2 mt-1">
            <div class="col-md">
                <div class="form-floating">
                    <select name="filiere" class="form-control" required>

                    </select>
                    <label for="floatingSelectGrid">Salle ou Aphhi</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select name="option" class="form-control" required>

                    </select>
                    <label for="floatingSelectGrid">Group</label>
                </div>
            </div>
        </div>
        <div class="col-md mt-1">
            <div class="form-floating">
                <select name="module" id="moduleDropdown" class="form-control" required>
                </select>
                <label for="floatingSelectGrid">Module</label>
            </div>
        </div>




        <div class="col-md mt-1">
            <div class="form-floating">
                <input type="text" name="element" class="form-control" placeholder="" required>
                <label for="floatingSelectGrid">Element de module</label>
            </div>
        </div>
        <!-- Input field for professeur -->


        <div class="col-md mt-1">

            <div class="form-floating">
                <input type="text" name="professeur" class="form-control" placeholder="" required>
                <label for="floatingSelectGrid" dir="rtl" style="display: flex; justify-content: space-between;">
                    <!-- <span>مدرس</span> -->
                    <span>Professeur</span>
                </label>

            </div>
        </div>
        <!-- Input field for Comments -->
        <label>Nature de lerreur</label>

        <div class="form-floating mt-1">

            <textarea class="form-control" placeholder="Leave a comment here" name="couse" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Nature de lerreur</label>

        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mt-1 w-100">Next</button>
    </form>
</div>


@endsection