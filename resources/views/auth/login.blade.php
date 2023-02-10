<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel=" stylesheet" href="{{asset('auth/css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('auth/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('auth/css/owl.theme.default.css')}}">

</head>

<body>
    <div class="login-1-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-1-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- <div class="logo-img"><img src="images/永昇-removebg-preview.png" class="img-fluid" alt="logo"></div> -->
                            <h3>Log In</h3>
                            <div class="row"> <label for="email"><i class="fa fa-user" aria-hidden="true"></i>
                                    Username</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row"> <label for="password"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row check-box-tick">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <div class="form-button">
                                <button type="submit">Log In</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="{{asset('auth/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('auth/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="{{asset('auth/js/lightbox-plus-jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('auth/js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 10,
                loop: true,
                nav: true,
                navText: [
                    '<i class="fa fa-angle-left"></i>',
                    '<i class="fa fa-angle-right"></i>'
                ],
                dots: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: true
                    }
                }
            });
        })
    </script>
</body>


</html>