<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal | Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated">
        <div>
            <div>
                <h1 class="logo-name">VLG</h1>
            </div>
            <h3>Rotterdam Portal</h3>

            @if ($errors->has('email') || $errors->has('password'))
            <div class="alert alert-danger">
                Gebruikersnaam en wachtwoord ongeldig
            </div>
            @endif

            <form class="m-t" role="form" method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Wachtwoord" required="">
                </div>

                <div class="form-group">
                    <div class="i-checks text-left">
                        <input type="checkbox" name="remember">
                        <label> Gegevens onthouden</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Wachtwoord vergeten?</small></a>

            </form>
        </div>
    </div>

    {{-- Mainly scripts --}}
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });

        });
    </script>

</body>

</html>
