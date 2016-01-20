<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal | Wachtwoord reset</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox">
        <div class="row">

            <div class="col-md-12">

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <div class="ibox-content">

                    <h2 class="font-bold">Wachtwoord reset</h2>

                    <p>Geef een nieuw wachtwoord op</p>

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="post" action="{{ url('/auth/password/reset', $token) }}">
                                {!! csrf_field() !!}

                                <input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Wachtwoord" required="">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Bevestig" required="">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Opslaan</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
