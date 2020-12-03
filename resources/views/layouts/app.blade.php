<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="image_upload" content="Auth::user()">
        @if (!Auth::guest())
            <meta name="user_id" content="{{Auth::user()->id}}"> 
        @endif
        

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="app">
            @guest
                @include('inc.guest_navbar')
            @else
                @include('inc.navbar')
            @endguest
            
            <main class="py-4 container">
                @include('inc.messages')
                @yield('content')
            </main>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=1b60267e0a67d7613bdbed"></script>
    <script src="https://kit.fontawesome.com/5bedb9cf34.js" crossorigin="anonymous"></script>
    <script>
        ClassicEditor
	  .create( document.querySelector( '#editor' ), {
	} )
	  .then( editor => {
		  console.log( editor );
	  } )
	  .catch( error => {
		  console.error( error );
	  } );
    </script>
    
</html>
