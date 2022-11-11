<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<!-- HEADER -->
<header class="p-3 text-bg-dark">
    <div>
        <div class="flex-wrap align-items-center  justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Production material</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Decor</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Type material</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Cell</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Story material</a></li>
            </ul>
            <!--
                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                            <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                        </form>s
            -->
            <!--  <div class="text-end">
                  <button type="button" class="btn btn-outline-light me-2">Login</button>
                  <button type="button" class="btn btn-warning">Sign-up</button>
              </div>-->
        </div>
    </div>
</header>
<!--BODY-->
<div class="container">
@yield('body')
</div>
</body>
</html>
