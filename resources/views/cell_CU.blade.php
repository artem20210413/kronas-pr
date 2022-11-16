@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">


            <p class="mt-4">Cell</p>
            <form class="needs-validation" id="cell">
                @csrf
                    <div class="mb-3 col-4 offset-4">
                <!--<input placeholder="id" class="form-control" type="number" name="id" value="">-->
                <input autofocus placeholder="A" class="form-control mt-2" type="text" name="rack" value="">
                <input autofocus placeholder="2" class="form-control mt-2" type="number" name="storey" value="">
                <input autofocus placeholder="3" class="form-control mt-2" type="number" name="row" value="">
                    </div>
                <div class="row">
                    <div class="col-4"> <button class=" w-100 btn btn-dark btn mt-3" onclick="history.back()">Go Back</button>  </div>
                    <div class="col-4">  <button class= " w-100 btn btn-primary btn mt-3" type="submit">Save</button> </div>
                    <div class="col-4">  <button class= " w-100 btn btn-danger btn mt-3" type="button">Delete</button>  </div>


                </div>
            </form>

        </div>

    </div>

    <script>

        $("#cell").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/cell',
                data: data,

                success: function (response) {
                    //console.log(response.rack);
                    window.location.href = "/cell?rack=" + response.rack;
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


