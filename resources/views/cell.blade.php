@extends('layout')

@section('title')
    Cell
@endsection
@section('body')

    <div class="row justify-content-md-center text-center">
        <div class="col-md-12">
            <form method="get" action="/cell" class="mt-3">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control" type="text" name="rack" value="{{$rack}}">
                        </div>
                        <div class="col-2 ">
                            <button class="w-100 btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

            <div class=" mt-2">
                <a class="w-100 btn btn-success" href="/cell/update">Create or update cell </a>
            </div>
        </div>

        <table class="table mt-4">
            <tr class="thead-dark">
                <th scope="col">Id</th>
                <th scope="col">Decor name</th>
            </tr>

            @foreach($cell as $el)
                <tr id="{{$el->id}}">
                    @csrf
                    <td>{{$el->id}}</td>
                    <td>{{$el->rack . '-' . $el->storey . '-' . $el->row}}</td>
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


