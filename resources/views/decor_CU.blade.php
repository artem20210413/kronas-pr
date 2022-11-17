@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">



            <form class="needs-validation mt-4" id="setdecor"><!--action="api/v1/decor" method="post"-->
                @csrf
                <div class="row">
                    @if($id != 0)
                    <div class="col-2">

                        <lable>ID</lable>
                    <input disabled placeholder="id" class="form-control mt-1" type="number" name="id" value="{{$id}}">

                    </div>
                    @endif
                    <div class="col-auto"><!--col-10-->
                        <lable>Decor</lable>
                    <input autofocus placeholder="Decor name" class="form-control  mt-1" type="text" name="decor_name"
                           value="{{$decorName}}">
                    </div>
                    <div class="col-6">
                        <button class="w-100 btn btn-dark btn mt-3" onclick="history.back()">Go Back</button>
                    </div>
                    <div class="col-6">
                        <button class="w-100 btn-primary btn mt-3" type="submit">Save</button>
                    </div>
                </div>
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


