<!-- resources/views/students/index.blade.php -->

@extends('layouts.apps')

@section('content')
<div class="container" >
    <div class="row">
        <!-- Left Top Section -->   
        <HEader>
        

        
        </HEader>
        @if(isset($student))
        <div class="container-fluid ">
            <div class="row">
                <!-- Left Section with Logo -->
                <div class="col-md-6 position-relative bg-light" >
                    <div id="idlogoump" class="text-center w-25">
                        <img src="../img/banner.png" class="img-fluid" alt="Logo">
                    </div>
                </div>
                @foreach($student->filieres as $filiere)
                <!-- Right Top Section -->
                <div class="col-md-6 position-relative bg-light " >
                    <div class="mt-5 m-5">
                        <h5>Année universitaire: <span class="text-primary">{{ $student->detailModules->max('AnneeUniversitaire') }}</span></h5>
                        <h5>Filière: <span class="text-primary">{{ $filiere->NomFiliere }}</span></h5>
                        @if($filiere->Parcours != "")
                            <h5>Parcours: <span class="text-primary"> {{ $filiere->Parcours }}</span></h5>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>       -->
        <!-- Your existing HTML code with Bootstrap classes -->
        <nav class="navbar navbar-expand-lg bg-dark  ">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto ">
            
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                </svg>               
                Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" >  
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                </svg> 
                Espace étudiant</a>
            </li>
            
          </ul>
          <form class="d-flex" role="search">
            <button class="btn btn-outline-danger" type="submit">Déconnexion</button>
          </form>
        </div>
      </div>
    </nav>
            
        <h2  class="text-center m-5">Bonjour <span class="text-danger">{{ $student->Nom }} {{ $student->Prenom }}</span></h2>
       
        <div class="printbt">
            <div class="row">
                <h5 class="col-md-6">Code Apogee: {{ $student->CodeApogee }}</h5>
                
            </div>
        </div>

 

    @endif
    @if(isset($student))
    <h3>Modules:</h3>
    <ul>
    @foreach($student->detailModules as $detailModule)
    @if ($detailModule->AnneeUniversitaire == '2022-2023' && $detailModule->etat == 'I')
        @if ($detailModule->part_Semester == '2' && $detailModule->SESSION == 'RAT')
            <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }} - {{ $detailModule->AnneeUniversitaire }} - RAT</li>
            @break
        @elseif ($detailModule->part_Semester == '2' && $detailModule->SESSION == 'ORD')
            <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }} - {{ $detailModule->AnneeUniversitaire }} - ORD</li>
            @break
        @elseif ($detailModule->part_Semester == '1' && $detailModule->SESSION == 'RAT')
            <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }} - {{ $detailModule->AnneeUniversitaire }} - RAT</li>
            @break
        @elseif ($detailModule->part_Semester == '1' && $detailModule->SESSION == 'ORD')
            <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }} - {{ $detailModule->AnneeUniversitaire }} - ORD</li>
            @break
        @endif
    @endif
@endforeach



    </ul>

    <h3>Groupes:</h3>
    <ul>
        @foreach($student->groupeEtudiants as $groupeEtudiant)
            <li>{{ $groupeEtudiant->groupe->nomGroupe }} - {{ $groupeEtudiant->groupe->AnneeUniversitaire }}</li>
        @endforeach
    </ul>

    <h3>Exams:</h3>
    <ul>
        @foreach($student->infoExames as $infoExame)
            <li>{{ $infoExame->NumeroExamen }} - {{ $infoExame->Semester }} - {{ $infoExame->Lieu }}</li>
        @endforeach
    </ul>
@endif

