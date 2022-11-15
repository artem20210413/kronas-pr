@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">


            <p class="mt-4">Decor</p>
            <form class="needs-validation" id="setdecor"><!--action="api/v1/decor" method="post"-->
                @csrf
                <input placeholder="id" class="form-control" type="number" name="id" value="{{$id}}">
                <input autofocus placeholder="decor_name" class="form-control mt-2" type="text" name="decor_name">
                <button class="w-100 btn btn-primary btn mt-3" type="submit">Add</button>
            </form>

        </div>

    </div>

    <?php
    //    foreach ()
    //dd(\App\Models\Decor::all())
    //dd($GLOBALS);
    ?>
    <script>

        $("#setdecor").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/api/v1/decor',
                data: data,

                success: function (response, u) {
                    console.log(response, u);
                    window.history.back();
                },
                error: function (response, u, v) {
                    $.alert({
                        type: 'red',
                        draggable: false,
                        title: JSON.parse(response.responseText).status,
                        content: JSON.parse(response.responseText).message
                    });
                }
            });
        });
    </script>

@endsection


