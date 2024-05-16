<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Users</title>
        
        @yield('scripts')
        @yield('styles')
        
        <!-- Fonts -->
        <!-- <link rel="stylesheet" href="/public/style.css" /> -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('other-scripts')
         
    </head>
    <body id="app" class="font-sans">
      <nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6 mb-10">
        <div class="flex items-center flex-shrink-0 text-white mr-12">
          <span class="font-semibold text-xl tracking-tight">Project for Auctions Live - Ulrik Wildy</span>
        </div>
        
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
          <div class="text-sm lg:flex-grow">
            <a href="{{ route('users.list') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
              View All Users
            </a>
            <a href="{{ route('users.create') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
              Create a User
            </a>
          </div>    
          
        </div>
      </nav>

      @yield('content')

      
    </body>
</html>
