<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or ''}} : Rana</title>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">


    <link href="/css/dataTable.css" rel="stylesheet">
    <link href="/css/jqueryDataTable.css" rel="stylesheet">
    <link href="/css/buttonDataTable.css" rel="stylesheet">



    @yield('head')
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.menu')
        <div id="content-container">
            @include('layouts.messages')
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')

    <!-- Scripts -->
    

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataTable').DataTable( {
                paging: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css('font-size', '10pt');
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' ).css( 'font-size', 'inherit' );
                        }
                    }
                ]
            } );
} );        

    </script>
    @yield('script')
</body>
</html>
    