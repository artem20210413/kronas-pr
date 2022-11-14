@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-8">
            <form class="col-12 mt-3">
                <input class="form-control" type="text" name="decor_name">
                <button class="w-100 btn btn-primary btn mt-3" type="submit">Search</button>
            </form>

            <p class="mt-4">decor</p>
            <form class="needs-validation" id="setdecor"><!--action="api/v1/decor" method="post"-->
                @csrf
                <input placeholder="id" class="form-control" type="number" name="id">
                <input placeholder="decor_name" class="form-control" type="text" name="decor_name">
                <button class="w-100 btn btn-primary btn mt-3" type="submit">Add</button>
            </form>
        </div>
        <table class="table mt-4">
            <tr class="thead-dark">
                <th scope="col">id</th>
                <th scope="col">decor_name</th>
            </tr>

            @foreach($decor as $el)
                <tr>
                    <form method="de">
                        <td name="id" >{{$el->id}}</td>
                        <td>{{$el->decor_name}}</td>
                        <td style="max-width: 40px">
                            <button type="submit" class="w-100 btn btn-warning">edit</button>
                        </td>
                        <td style="max-width: 40px">
                            <button type="submit" class="w-100 btn btn-danger">delete</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </table>

    </div>
    <?php
    //    foreach ()
    //dd(\App\Models\Decor::all())
    //dd($GLOBALS);
    ?>
    <script>

        console.log("+");
        $("#setdecor").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/api/v1/decor',
                data: data,

                success: function (response, u) {
                    console.log(response, u);
                    $.alert({
                        type: 'green',
                        draggable: false,
                        title: response.status,
                        content: response.message
                    });
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


