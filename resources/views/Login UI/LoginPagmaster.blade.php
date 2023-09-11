<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>M U Tracking System</title>

    <link rel="stylesheet" href="/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Data Table/DataTables-1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="Login Page Resources/style.css">

    @if(Auth::check())
    <script>
        window.location = "logout";
    </script>
    @else

    @endif

    <style>
        .navbar-brand {
            text-align: center;
            margin: auto;
        }

        body {
            color: #434444;
        }

        .container {
            padding-top: 50px;
        }

        hr {
            width: 300px;
            border: 3px solid #434444;
        }

        /* Product Grid */
        .product-grid {
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .product-grid:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .image {
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: rgba(67, 68, 68, 0.7);
        }

        .image:hover .overlay {
            opacity: 1;
        }

        .detail {
            color: #fff;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        .buy {
            background-color: transparent;
            color: #434444;
            border-radius: 0;
            border: 1px solid #434444;
            width: 100%;
            margin-top: 20px;
        }

        .buy:hover {
            background-color: #434444;
            color: #fff;
        }
    </style>

</head>

<body>
    @yield('constant')
    <script src="/bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
    <script src="/Jquery/jquery.min.js"></script>
    <script src="/Jquery/jquery.validate.min.js"></script>
    <script src="/Data Table/DataTables-1.10.23/js/jquery.dataTables.js"></script>

    @stack('scripts')
</body>

</html>