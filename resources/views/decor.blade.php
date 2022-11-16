@extends('layout')

@section('title')
    Decor
@endsection
@section('body')
    <div class="row justify-content-md-center text-center">
        <div class="col-md-12">
            <form class="mt-3">
                <div class="row">
                    <div class="col-10">
                        <input class="form-control" type="text" name="decor_name" value="{{$name}}">
                    </div>
                    <div class="col-2 ">
                        <button class="w-100 btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <div class=" mt-2">
                <a class="w-100 btn btn-success" href="/decor/0/Decor name">Create new decor </a>
            </div>
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
                        <td>{{$el->id}}</td>
                        <td>{{$el->decor_name}}</td>

                        <td style="max-width: 50px">
                            <a class="w-100 btn btn-warning" href="/decor/{{$el->id}}/{{$el->decor_name}}">Update</a>
                        </td>
                        <td style="max-width: 50px">
                            <button type="submit" class="w-100 btn btn-danger">Delete</button>
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

        $("#f").submit(function (e) {
            e.preventDefault();

            const data = $(this).serializeArray();

            $.ajax({
                type: "DELETE",
                url: '/decor',
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


