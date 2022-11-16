@extends('layout')

@section('title')
    Cell
@endsection
@section('body')

    <div class="row justify-content-md-center text-center">
        <div class="col-md-12">

            <form method="get" action="/cell" class="mt-3" id="rack_form">
                    <div class="row">

                        <div class="col-md-2 offset-md-5">
                            <select class="form-control" type="select" name="rack" id="rack_select">
                                <option value=" ">all</option>
                                @foreach($allRack as $el)
                                    <option @if($el->rack == $rack)selected @endif value="{{$el->rack}}">{{$el->rack}}</option>
                                @endforeach
                            </select>
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

        $("#rack_select").on("change", function () {
            $("#rack_form").submit();
        });
    </script>
@endsection


