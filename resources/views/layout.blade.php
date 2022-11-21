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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

</head>
<body>
<!-- HEADER -->
<header class="p-3 text-bg-dark">
    <div>
        <div class="row flex-wrap align-items-center  justify-content-center justify-content-lg-start">
            <div class="col-3">
                <input id="storage_header" class="form-control mt-2" type="number" name="storey" value="54102">
            </div>
            <div id="url"  class="col-6">
                <ul class="nav  col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                    <li><a id="material_header" href="/" class="nav-link px-2 text-white">Production material</a></li>
                    <li><a id="decor_header" href="/decor" class="nav-link px-2 text-white">Decor</a></li>
                    <li><a id="type_material_header" href="/type_material" class="nav-link px-2 text-white">Type material</a></li>
                    <li><a id="cell_header" href="/cell/" class="nav-link px-2 text-white">Cell</a></li>
                    <li><a id="story_material_header" href="/story_material" class="nav-link px-2 text-white">Story material</a></li>
                </ul>
            </div>
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
<script>
    $("#url").on("click", function (e){
        document.getElementById("cell_header").href = document.getElementById("cell_header").href + document.getElementById("storage_header").value;
    })



</script>
</body>
</html>
