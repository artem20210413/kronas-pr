@extends('layout')

@section('title')
    Decor
@endsection
@section('body')


    <p>Decor</p>
    <form id="setdecor" ><!--action="api/v1/decor" method="post"-->
        @csrf
        <input type="text" name="decor_name">
    <button type="submit" >Add</button>
    </form>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
        </tr>


    @foreach($data as $el)
            <tr>
                <th>{{$el->id}}</th>
                <th>{{$el->decor_name}}</th>
            </tr>
    @endforeach
    </table>

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


