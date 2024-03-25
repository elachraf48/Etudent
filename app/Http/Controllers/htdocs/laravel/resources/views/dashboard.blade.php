<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            <!-- {{ __('WHELCOME') }}                                  -->
            {{ __('Bonjour') }}  <span class="text-danger">{{ Auth::user()->name }}</span>

        </h2>
    </x-slot>
    <div class="p-3" >
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <!-- <x-welcome /> -->
                <div id="app">
                    @yield('content')
                </div>
                <!-- Add a link to the bulk insert page -->
            </div>
        </div>
    </div>
    <span style="position: fixed; bottom: 3vh;"><a style="text-decoration: none;position: fixed;" target="_blank" href="http://cv.achraf48.co">  Réaliser et  Développé par Achraf-Elabouye</a> </span>

    
</x-app-layout>
