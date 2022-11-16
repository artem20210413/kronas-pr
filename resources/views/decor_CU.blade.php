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
                <input autofocus placeholder="Decor name" class="form-control mt-2" type="text" name="decor_name" value="{{$decorName}}">
                <button class="w-100 btn btn-primary btn mt-3" type="submit">Save</button>
            </form>

        </div>

    </div>

    <script>

        $("#setdecor").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/decor',
                data: data,

                success: function () {
                    //console.log(response, u);
                    window.location.href = "/decor";
                    //window.history.back();
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


