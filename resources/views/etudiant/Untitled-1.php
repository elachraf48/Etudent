

        <h3>Modules:</h3>
        <ul>
            @foreach($student->detailModules as $detailModule)
            @if ( $detailModule->etat == 'I')
            <li>{{ $detailModule->module->NomModule }} - {{ $detailModule->SESSION }} - {{ $detailModule->AnneeUniversitaire }} - RAT</li>

            @endif
            @endforeach



        </ul>

        <h3>Groupes:</h3>
        <ul>
            @if($student->groupeEtudiants)
            @foreach($student->groupeEtudiants as $groupeEtudiant)
            @if($groupeEtudiant->groupe)
            <li>{{ $groupeEtudiant->groupe->nomGroupe }} - {{ $groupeEtudiant->groupe->AnneeUniversitaire }}</li>
            @endif
            @endforeach
            @endif
        </ul>

        <h3>Exams:</h3>
        <ul>
            @foreach($student->infoExames as $infoExame)
            <li>{{ $infoExame->NumeroExamen }} - {{ $infoExame->Semester }} - {{ $infoExame->Lieu }}</li>
            @endforeach
        </ul>
        @endif 






        -----------------
         @if(isset($student))
        @foreach($student->infoExames->unique('Semester') as $semesterInfo)
        <h5 class="mb-3 text-success">
            Licence d'études fondamentales Session de Printemps Semestre {{ $semesterInfo->Semester }}
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered border-primary">
                <thead class="table-light">
                    <tr class="text-center">
                        <th colspan="4">
                            <h5>
                                Filière: {{ $filiere->NomFiliere ?? 'N/A' }}
                                | Semester: {{ $semesterInfo->Semester ?? 'N/A' }}
                                | N° Exam: {{ $semesterInfo->NumeroExamen ?? 'N/A' }}
                                @php
                                $groupeEtudiant = optional($student->groupeEtudiants)->firstWhere('idGroupe', $semesterInfo->idGroupe);
                                $groupe = optional($groupeEtudiant)->groupe; // Update this line
                                @endphp
                                | Groupe: {{ $groupe ? $groupe->nomGroupe : 'Groupe Not Found' }}
                            </h5>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th>
                            <h4>Modules</h4>
                        </th>
                        <th>
                            <h4>Lieu</h4>
                        </th>
                        <th>
                            <h4>Date</h4>
                        </th>
                        <th>
                            <h4>Horaire</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->infoExames->where('Semester', $semesterInfo->Semester) as $exam)
                    @php
                    $detailModules = $student->detailModules
                    @endphp

                    @foreach($detailModules as $detailModule)
                    <tr>
                        <td>
                            <h5>
                                {{ optional($detailModule->module)->NomModule ?? 'N/A' }}
                            </h5>
                        </td>
                        <td>{{ $exam->Lieu ?? 'N/A' }}</td>
                        <td>{{ $detailModule->->Date ?? 'N/A' }}</td>
                        <td>{{ $exam->Houre ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        @endif


















        



    
        <h5 class="mb-3 text-success">
            Licence d'études fondamentales Session de Printemps Semestre {{ $semesterInfo->Semester }}
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered border-primary">
                <thead class="table-light">
                    <tr class="text-center">
                        <th colspan="4">
                            <h5>
                                Filière: {{ $filiere->NomFiliere ?? 'N/A' }}
                                | Semester: {{ $semesterInfo->Semester ?? 'N/A' }}
                                | N° Exam: {{ $semesterInfo->NumeroExamen ?? 'N/A' }}
                                @php
                                $groupeEtudiant = optional($student->groupeEtudiants)->firstWhere('idGroupe', $semesterInfo->idGroupe);
                                $groupe = optional($groupeEtudiant)->groupe; // Update this line
                                @endphp
                                | Groupe: {{ $groupe ? $groupe->nomGroupe : 'Groupe Not Found' }}
                            </h5>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th>
                            <h4>Modules</h4>
                        </th>
                        <th>
                            <h4>Lieu</h4>
                        </th>
                        <th>
                            <h4>Date</h4>
                        </th>
                        <th>
                            <h4>Horaire</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->infoExames->where('Semester', $semesterInfo->Semester) as $exam)
                    @php
                    $detailModules = $student->detailModules
                    @endphp

                    @foreach($detailModules as $detailModule)
                    <tr>
                        <td>
                            <h5>
                                {{ module->NomModule }}
                            </h5>
                        </td>
                        <td>{{ $exam->Lieu }}</td>
                        <td>{{ $detailModule->->Date}}</td>
                        <td>{{ $exam->Houre }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        @endif
       


        










        @foreach ($filiere->modules as $module)
            <h4>Module: {{ $module->NomModule }}</h4>

            @foreach ($module->calendrierModules as $calendrierModule)
                <p>Date: {{ $calendrierModule->DateExamen }} | Hour: {{ $calendrierModule->Houre }}</p>
            @endforeach
        @endforeach

    <h2>Exam Details</h2>

    @foreach ($etudiant->examens as $examen)
        <p>Lieu: {{ $examen->Lieu }} | Annee Universitaire: {{ $examen->AnneeUniversitaire }} | Numero Examen: {{ $examen->NumeroExamen }}</p>
    @endforeach