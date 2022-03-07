<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Meet Key People | Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="{{ asset('/') }}backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/components.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/login.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('/') }}backend/images/favicon.ico" /> 
    </head>

    <body class=" login">
               

        @yield('content')
    

        <div class="copyright"> {{ date('Y')}} © Meet Key People. Admin Panel. </div>
        
        <script src="{{ asset('/') }}backend/js/jquery.min.js" type="text/javascript"></script>
        <script src="{{ asset('/') }}backend/js/bootstrap.min.js" type="text/javascript"></script>

    </body>

</html>