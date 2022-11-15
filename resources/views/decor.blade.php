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

            <p class="mt-4">Decor</p>
            <form class="needs-validation" id="setdecor"><!--action="api/v1/decor" method="post"-->
                @csrf
                <input placeholder="id" class="form-control" type="number" name="id">
                <input placeholder="decor_name" class="form-control mt-2" type="text" name="decor_name">
                <button class="w-100 btn btn-primary btn mt-3" type="submit">Add</button>
            </form>
        </div>
        <table class="table mt-4">
            <tr class="thead-dark">
                <th scope="col">Id</th>
                <th scope="col">Decor name</th>
            </tr>

            @foreach($decor as $el)
                <tr id="{{$el->id}}">
                    <form action="{{ url('/decor', ['id' => $el->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <td >{{$el->id}}</td>
                        <td>{{$el->decor_name}}</td>

                        <td style="max-width: 50px">
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

        $("#setdecor").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: '/api/v1/decor',
                data: data,

                success: function (response, u) {
                    console.log(response, u);
                    //location.reload();
                    $.alert({
                        //theme: 'black',
                        type: 'green',
                        draggable: false,
                        title: response.status,
                        content: response.message,
                        confirm: function () {
                            location.reload();
                        }
                    });
                    // location.reload();
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


