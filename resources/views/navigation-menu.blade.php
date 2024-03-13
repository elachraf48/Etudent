<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/reclamation.css') }}">
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
@if(Auth::user()->role == 0)
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">

        <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <!-- <x-application-mark class="block h-9 w-auto" /> -->
                    <img class="block h-12 w-auto" src="{{ url('./img/banner.png') }}" />

                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <!-- <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link> -->
                @if(Auth::user()->role == 0)
                <x-nav-link class="m-0" :active="request()->routeIs('dashboard')">
                    <ul class="nav-item dropdown m-0">
                        <a class="nav-link dropdown-toggle w-25" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('insert multiple') }}
                        </a>
                        <ul class="dropdown-menu">
                            <x-nav-link href="{{ route('Filier_modules_form') }}" :active="request()->routeIs('dashboard')">
                                {{ __('moudel and filier') }}
                            </x-nav-link>

                            <x-nav-link style="width: 200px;" href="{{ route('insert_student_form') }}" :active="request()->routeIs('dashboard')">
                                {{ __('student group infoExam') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('Calendrier_modules_form') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Calendrier modules') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('detail_modules_form') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Detail Modules') }}
                            </x-nav-link>
                            <br>
                            <x-nav-link href="{{ route('bulk_professeurs_process') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Professeurs') }}
                            </x-nav-link>
                        </ul>
                    </ul>
                </x-nav-link>
                @endif
                <x-nav-link class="m-0" :active="request()->routeIs('dashboard')">
                    <ul class="nav-item dropdown m-0">
                        <a class="nav-link dropdown-toggle w-25" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Reclamation') }}
                        </a>
                        <ul class="dropdown-menu">
                            <x-nav-link href="{{ route('Reclamation_form') }}" :active="request()->routeIs('Reclamation_form')">
                                {{ __('Reclamation details') }}
                            </x-nav-link>

                            <x-nav-link style="width: 200px;" href="{{ route('Reclamation_edit_form') }}" :active="request()->routeIs('Reclamation_edit_form')">
                                {{ __('Reclamation modefier') }}
                            </x-nav-link>
                           
                        </ul>
                    </ul>
                </x-nav-link>
                <!-- <x-nav-link href="{{ route('Reclamation_form') }}" :active="request()->routeIs('Reclamation_form')">
                    {{ __('Reclamation') }}
                </x-nav-link> -->
                <x-nav-link href="{{ route('Professeur_form') }}" :active="request()->routeIs('Professeur_form')">
                    {{ __('Professors') }}
                </x-nav-link>
                <x-nav-link href="{{ route('parameterPage') }}" :active="request()->routeIs('parameterPage')">
                    {{ __('Page') }}
                </x-nav-link>



            </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="ml-3 relative">
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->currentTeam->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <div class="w-60">
                            <!-- Team Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-dropdown-link href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </x-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" />
                            @endforeach
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            @endif

            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </div>
            @endif

            <div>
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <!-- Account Management -->
            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                {{ __('API Tokens') }}
            </x-responsive-nav-link>
            @endif

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

            <!-- Team Management -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="border-t border-gray-200"></div>

            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                {{ __('Team Settings') }}
            </x-responsive-nav-link>

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                {{ __('Create New Team') }}
            </x-responsive-nav-link>
            @endcan

            <div class="border-t border-gray-200"></div>

            <!-- Team Switcher -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Switch Teams') }}
            </div>

            @foreach (Auth::user()->allTeams() as $team)
            <x-switchable-team :team="$team" component="responsive-nav-link" />
            @endforeach
            @endif
        </div>
    </div>
</div>
</nav>
@elseif(Auth::user()->role == 3)
<!-- resources/views/Professeur/index.blade.php -->



<style>
    .btn-primary {
        width: 10em;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}

        </button>
        <ul class="dropdown-menu">
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
            </div>

            <x-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-dropdown-link>


            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                {{ __('API Tokens') }}
            </x-dropdown-link>
            @endif

            <div class="border-t border-gray-200"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </ul>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ">
                <!-- <li class="nav-item ">
                    <a class="nav-link active " aria-current="page" href="/Professeur"> <button type="button" class="btn btn-primary position-relative">
                            Home </button>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('Reclamationpr') }}">
                        <button type="button" class="btn btn-primary position-relative">
                            Reclamation
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="reclamationsCount">
                                0
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>

                    </a>
                </li>


            </ul>
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Fetch the count of reclamations using AJAX
    function updateReclamationsCount() {
        $.ajax({
            url: "{{ route('reclamations.count') }}",
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
    setInterval(updateReclamationsCount, 6000); // Update every minute (adjust as needed)
</script>





@endif