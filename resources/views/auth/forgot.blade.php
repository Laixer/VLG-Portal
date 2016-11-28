<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal | Wachtwoord vergeten</title>

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

                    <h2 class="font-bold">Wachtwoord vergeten</h2>

                    <p>Vul uw email adres in en een link wachtwoord reset link zal worden opgestuurd.</p>

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="post" action="{{ url('/password/reset') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email adres" required="">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Reset wachtwoord</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
