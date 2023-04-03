<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>123</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-200 dark:bg-gray-700">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:text-gray-50">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script>
            if(localStorage.theme === 'dark' || (!'theme' in localStorage) && window.matchMedia('(prefers-color-scheme:dark)').matches){
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }

            document.getElementById('switchTheme').addEventListener('click', () =>
            {
              let htmlClasses = document.querySelector('html').classList;
              if(localStorage.theme === 'dark'){
                  htmlClasses.remove('dark');
                  localStorage.removeItem('theme')
              } else {
                  htmlClasses.add('dark');
                  localStorage.theme = 'dark'
              }
            });
        </script>


    </body>
</html>
