<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name ="robots" content="NOINDEX, NOFOLLOW">
    <title> CRM</title>
    <link rel="stylesheet" href="{{ asset('theme/css/log-style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="{{ asset('theme/js/jquery-1.12.0.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</head>
<body>
@yield('content')
<section class="copyright ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <p>Copyright © 2019 All Right Reserved. Privacy Policy | Terms & Conditions </p>
            </div>
        </div>
    </div>
</section>
</body>
</html>