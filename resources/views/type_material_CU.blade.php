@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">


            <p class="mt-4">Type material</p>
            <form class="needs-validation" id="settm"><!--action="api/v1/decor" method="post"-->
                @csrf
                <input placeholder="id" class="form-control" type="number" name="id" value="{{$id}}">
                <input autofocus placeholder="Type material name" class="form-control mt-2" type="text" name="tm_name"
                       value="{{$tmName}}">
                <div class="row">
                    <div class="col-6">
                        <button class="w-100 btn btn-dark btn mt-3" onclick="history.back()">Go Back</button>
                    </div>
                    <div class="col-6">
                    <button class="w-100 btn btn-primary btn mt-3" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>


        $("#settm").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/type_material',
                data: data,

                success: function () {
                    window.location.href = "/type_material";
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


