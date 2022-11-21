@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">


            <p class="mt-4">Cell</p>
            <form id="cell_form" class="needs-validation" action="" method="POST">
                @csrf
                <div class="mb-3 col-4 offset-4">
                    <!--<input placeholder="id" class="form-control" type="number" name="id" value="">-->
                    <input autofocus placeholder="A" class="form-control mt-2" type="text" id="rack" name="rack"
                           value="">
                    <input placeholder="2" class="form-control mt-2" type="number" name="storey" value="">
                    <input placeholder="3" class="form-control mt-2" type="number" name="row" value="">
                </div>
                <div class="row">
                    <div class="col-4">
                        <button class=" w-100 btn btn-dark btn mt-3" onclick="history.back()">Go Back</button>
                    </div>
                    <div class="col-4">
                        <button id="CellSave" class="w-100 btn btn-primary btn mt-3" type="submit" >Save</button>
                    </div>
                    <div class="col-4">
                        <button id="CellDelete" class="w-100 btn btn-danger btn mt-3">Delete</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <script>
        $("#cell_form").submit(function (e) {
            e.preventDefault();
            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/cell/' + document.getElementById("storage").value,
                data: data,

                success: function (response) {
                    //console.log(response.rack);
                    window.location.href = "/cell/" + window.location.href.split('/').pop() + "?rack=" + response.rack;
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

        $("#CellDelete").on('click', function (e) {
            e.preventDefault();

            console.log($("#rack").val());
            $.ajax({
                url: '/cell/' + window.location.href.split('/').pop(),
                type: 'DELETE',
                data: {'_token': $('input[name="_token"]').val(), rack: $('#rack').val()},
                success: function (result) {
                    window.location.href = "/cell/" + window.location.href.split('/').pop();
                },
                error: function (response) {
                    $.alert({
                        type: 'red',
                        draggable: false,
                        title: JSON.parse(response.responseText).status,
                        content: JSON.parse(response.responseText).message
                    });
                }
            });
            //var res = $.delete('/cell',$("#rack").val());
            //console.log(res);
            //$("#rack").val()
        });

    </script>

@endsection


