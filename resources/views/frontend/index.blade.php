    <!doctype html>
    <html lang="en" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <meta name="tags" content="Developed by BrainCave Software Pvt. Ltd" href="https://braincavesoft.com/">
        <title>HOME | Micro Aire-Care  </title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="theme-color" content="#7952b3">
        <!-- Custom styles for this template -->
        <link href="cover.css" rel="stylesheet">
    </head>

    <body class="d-flex h-100 text-center text-white bg-dark">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">Micro Aire-Care </h3>
                    
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        @if(Auth::user())
                        <a class="nav-link text-white mx-2 btn btn-sm btn-primary active" aria-current="page" href="{{route('SA-Dashboard')}}">Dashboard</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-white btn btn-sm bg-danger">Log Out</button>
                        </form>
                        @else
                        <a class="nav-link text-white btn btn-sm btn-primary active" aria-current="page" href="{{route('login')}}">Login</a>
                        @endif
                    </nav>
                </div>
            </header>
            <main class="px-3">
                <h1>Welcome to Micro Aire-Care </h1>
                <p class="lead">Cover is a one-page template for building simple and beautiful home pages.</p>
                
            </main>

            <footer class="mt-auto text-white-50">
                <p>copyright &copy; BrainCave Software Pvt. Ltd.</p>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>