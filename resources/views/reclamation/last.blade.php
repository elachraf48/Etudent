<!-- resources/views/reclamation/last.blade.php -->
@include('include.header')

@extends('layouts.apps')

@section('content')
<!-- Center the container vertically and horizontally, and apply cool background color -->

<head>
    <!-- Include your other <head> elements here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">

</head>
<style>
    .custom-table {
        width: 90%;
        border-collapse: collapse;
    }

    .custom-table td,
    .custom-table th {
        border: black 1px solid;
        padding: 10px;
        text-align: center;
        font-size: x-small;

    }

    /* Custom table header styles */
    .custom-table-header {
        background-color: #343a40;
        /* Adjust as needed */
        color: #fff;
        /* Adjust as needed */
    }

    /* Custom table column styles */


    /* Custom table body styles */
    .custom-table-body {
        background-color: #fff;
        /* Adjust as needed */
    }


    #reclamatinshow {
        width: 50vw;
        /* Set width to 50% of the viewport width */
        margin: 50px auto;
        /* Center the element horizontally */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        /* Apply box shadow */
        padding: 10px;
        /* Add any additional styling here */
    }

    @media screen and (max-width: 768px) {
        #reclamatinshow {
            width: 100vw;
            /* Set width to 50% of the viewport width */
            /* Add any additional styling here */
        }

        .custom-table td,
        .custom-table th {
            padding: 0;
            font-size: 10px;

        }

        .info {
            font-size: 5px;
        }
    }
</style>


<!-- CSRF token for Laravel security -->
<section id="section" class="text-center m-0   bg-gray">
    <div class="container-fluid-wrapper ">
        <div class="continue-fluid p-5 bg-light">
            <h5 class="link-danger ">Demande de correction de faute matérielle concernant les résultats des examens.</h5>
            <h5 class="link-success ">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h5>
        </div>



    </div>
    <center class="m-5 ">
        @if (session('error'))
        <div class="alert alert-danger ">
            <h4>{!! session('error') !!}</h4>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success ">
            <h4>{!! session('success') !!}</h4>
        </div>
        @endif
        <!-- <button id="download-pdf" class="cssbuttons-io-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path fill="currentColor" d="M1 14.5a6.496 6.496 0 0 1 3.064-5.519 8.001 8.001 0 0 1 15.872 0 6.5 6.5 0 0 1-2.936 12L7 21c-3.356-.274-6-3.078-6-6.5zm15.848 4.487a4.5 4.5 0 0 0 2.03-8.309l-.807-.503-.12-.942a6.001 6.001 0 0 0-11.903 0l-.12.942-.805.503a4.5 4.5 0 0 0 2.029 8.309l.173.013h9.35l.173-.013zM13 12h3l-4 5-4-5h3V8h2v4z"></path>
            </svg>
            <span>Download Reclamation</span>
        </button> -->
    </center>

</section>
<div id="reclamatinshow">
    <section id="reclamation">
        <!-- <div class="container  text-center">
            <header class="container ">
                <div class="text">
                    <!-- English text on the left --
                    Université Mohammed Premier<br>
                    Faculté des Sciences Juridiques,<br>
                    Economique et Sociales
                </div>
                <img src="/img/banner.png" alt="University Image" width="150" height="150">
                <div class="text arabic">
                    <!-- Arabic text on the right --
                    جامعة محمد الأول بوجدة<br>
                    كلية العلوم القانونية <br>والاقتصادية والاجتماعية
                </div>
            </header>
        </div> -->
        <center>


            <div class="continue info" style="margin: 30px 0;">
                <!-- Centered Section with Logo for Mobile -->
                <h6 class="custom-link-success custom-p-2">تم تقديم شكوى بالنجاح</h5>
                    <h6 class="custom-link-danger custom-p-2">Une plainte a été soumise avec succès.</h5>
                        <h5>Annee Universitaire: {{ $result->AnneeUniversitaire }}</h5>
                        <h5>Date de réclamation: {{ $result->created_at }}</h5>

            </div>
            <table class="custom-table">
                <thead class="custom-table-header">
                    <tr>
                        <th scope="col" class="custom-table-col">Nom</th>
                        <th colspan="2" class="custom-table-col">
                            {{ $result->Nom }} {{ $result->Prenom }}
                        </th>
                        <th scope="col" class="custom-table-col">اسم</th>
                    </tr>
                    <tr>
                        <th scope="row" class="custom-table-row">Numéro Apogée</th>
                        <th colspan="2" class="custom-table-row" id="CodeApogee">
                            {{ $result->CodeApogee }}
                        </th>
                        <th class="custom-table-row">رقم أبوجي</th>
                    </tr>
                </thead>
                <tbody class="custom-table-body">
                    <tr>
                        <th scope="row"> <span class="float-start">Semestre </span></th>
                        <td colspan="2">{{ $result->Semester }}</td>
                        <th> <span class="float-end"> السداسي</span></th>
                    </tr>
                    <tr>
                        <th scope="row"> <span class="float-start">Filiere </span></th>
                        <td colspan="2">{{ $result->NomFiliere }}</td>
                        <th scope="row"> <span class="float-end"> المسلك</span></th>
                    </tr>
                    <tr>
                        <th scope="row"> <span class="float-start">Module </span></th>
                        <td colspan="2">{{ $result->NomModule }}</td>
                        <th scope="row"> <span class="float-end"> الوحدة</span></th>
                    </tr>
                    @if ($result->NumeroExamen)
                    <tr>
                        <th scope="row"> <span class="float-start">N d'examen </span></th>
                        <td colspan="2">{{ $result->NumeroExamen }}</td>
                        <th scope="row"> <span class="float-end"> رقم الامتحان</span></th>
                    </tr>
                    @endif
                    @if ($result->Lieu)
                    <tr>
                        <th scope="row"> <span class="float-start">Salle ou Aphhi </span></th>
                        <td colspan="2">{{ $result->Lieu }}</td>
                        <th scope="row"> <span class="float-end"> مكان اجتياز الامتحان</span></th>
                    </tr>
                    @endif

                    <tr>
                        @if ($result->nomGroupe)
                        <th scope="row"><span class="float-start">Group</span></th>
                        <td colspan="2">{{ $result->nomGroupe }}</td>
                        <th scope="row"><span class="float-end">مجموعة </span> </th>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row"> <span class="float-start">Professeur </span></th>
                        <td colspan="2">{{ $result->ProfNom }} {{ $result->ProfPrenom }}</td>
                        <th scope="row"> <span class="float-end"> مدرس</span></th>
                    </tr>
                    <tr>
                        <th scope="row"> <span class="float-start">Sujet de la réclamation </span></th>
                        <td colspan="2">{{ $result->Sujet }}</td>
                        <th scope="row"> <span class="float-end"> موضوع الطلب</span></th>
                    </tr>
                    <tr>
                        <th scope="row"> <span class="float-start">observations </span></th>
                        <td colspan="2">{{ $result->observations }}</td>
                        <th scope="row"> <span class="float-end"> ملاحظات</span></th>
                    </tr>
                </tbody>
            </table>
            <!-- <div style="font-size: xx-small;" class="mt-2 p-0" id="paper-footers">
                <p class="page-footer-texts">Faculté des sciences juridiques économiques et sociales Université Mohammed Premier, BV Mohammed VI B.P. 724 Oujda 60000 Maroc.</p>
                <p class="page-footer-textsss">كلية العلوم القانونية والاقتصادية والاجتماعية جامعة محمد الأول، شارع محمد الخامس، ص.ب, 724 وجدة 60000 المغرب</p>
                <p class="page-footer-texts">00212536500597</p>
            </div> -->
    </section>
</div>
<div id="paper-footer">
    <p class="page-footer-text">Faculté des sciences juridiques économiques et sociales Université Mohammed Premier, BV Mohammed VI B.P. 724 Oujda 60000 Maroc.</p>
    <p class="page-footer-text">كلية العلوم القانونية والاقتصادية والاجتماعية جامعة محمد الأول، شارع محمد الخامس، ص.ب, 724 وجدة 60000 المغرب</p>
    <p class="page-footer-text">00212536500597</p>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="/js/html2canvas.js"></script>

<script>
     function updateReclamationsCount() {
        var CodeApogee = $('#CodeApogee').text();
        $('.btn-primary').attr('data-apogee', CodeApogee);

        $.ajax({
            url: "/reclamations/etudiant/" + CodeApogee,
            method: 'GET',
            success: function(response) {
                // Update the count in the navigation menu
                $('#reclamationsCount').text(response.count > 0 ? response.count : '0');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the function initially to update the count
    updateReclamationsCount();

    // Optionally, you can set up a timer to periodically update the count
    setInterval(updateReclamationsCount, 6000);


    window.jsPDF = window.jspdf.jsPDF;
    document.getElementById('download-pdf').addEventListener('click', function() {
        // Capture the content of the <section id="reclamation"> as an image
        html2canvas(document.getElementById('reclamation')).then(function(canvas) {
            // Convert the image to data URL
            var imgData = canvas.toDataURL('image/png');

            // Initialize jsPDF
            var pdf = new jsPDF('p', 'mm', 'a4');

            // Add the image to the PDF
            pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(),
                pdf.internal.pageSize.getHeight()); // Adjust dimensions as needed

            // Save the PDF
            pdf.save('reclamation.pdf');
        });
    });
    $(document).ready(function() {
        $('.cssbuttons-io-buttondd').on('click', function() {
            var reclamationId = window.location.pathname.split('/').pop();

            axios.get(`/convertHtmlToPdf/${reclamationId}`, {
                    params: {
                        reclamationId: reclamationId
                    }
                })
                .then(response => {
                    var htmlContent = response.data.html;

                    html2canvas(htmlContent, {
                            scale: 2,
                            useCORS: true,
                            logging: true,
                            profile: true,
                            useCORS: true
                        })
                        .then(canvas => {
                            var imgData = canvas.toDataURL("image/png", 0.9);
                            var src = encodeURI(imgData);
                            var pdf = new jsPDF("p", "mm", "a4");

                            pdf.addImage(src, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());
                            pdf.save("reclamation.pdf");
                        })
                        .catch(error => {
                            console.error("Error converting HTML to PDF:", error);
                        });
                })
                .catch(error => {
                    console.error("Error fetching HTML content:", error);
                });
        });
    });
    $('#download-pdfss').click(function() {
        var reclamationId = $(this).data('reclamation-id');
        $.ajax({
            url: '/convert-to-pdf/' + reclamationId,
            method: 'POST',
            success: function(response) {
                // Trigger download if successful
                const blob = new Blob([response], {
                    type: 'application/pdf'
                });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'reclamation.pdf';
                link.click();
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
    });
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    document.getElementById('download-pdfss').addEventListener('click', function() {
        // Assuming you retrieve the reclamation ID from your page logic:
        const reclamationId = window.location.pathname.split('/').pop();

        fetch(`/reclamation/convert-to-pdf/${reclamationId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.blob();
            })
            .then(blob => {
                // Create a URL object for the downloaded PDF
                const url = window.URL.createObjectURL(blob);

                // Trigger download with appropriate filename and content type
                const link = document.createElement('a');
                link.href = url;
                link.download = `reclamation-${reclamationId}.pdf`;
                link.click();
            })
            .catch(error => {
                // Handle errors gracefully: display message, log, etc.
                console.error('Error downloading PDF:', error);
                // Add user-friendly error display (e.g., alert)
            });
    });

   
</script>


@endsection