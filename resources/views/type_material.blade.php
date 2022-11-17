@extends('layout')

@section('title')
    Type material
@endsection

@section('body')

    <div class="row justify-content-md-center text-center">
        <div class="col-md-12">
            <form class="mt-3">
                <div class="row">
                    <div class="col-10">
                        <input class="form-control" type="text" id="tm_name" name="tm_name" onkeyup="myFunction()"
                               value="{{$tmname}}">
                    </div>
                    <div class="col-2">
                        <button class="w-100 btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <div class=" mt-2">
                <a class="w-100 btn btn-success" href="/type_material/0/TM">Create new decor </a>
            </div>
        </div>

        <table class="table mt-4" id="tm_table">
            <tr class="thead-dark">
                <th scope="col">Id</th>
                <th scope="col">Decor name</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>

            @foreach($TM as $el)
                <tr id="{{$el->id}}">
                    <form data-id="{{$el->id}}" data-name="{{$el->tm_name}}" onsubmit="return send_id(this);">
                        @csrf
                       <!-- method('DELETE')-->
                        <td>{{$el->id}}</td>
                        <td>{{$el->tm_name}}</td>

                        <td style="max-width: 50px">
                            <a class="w-100 btn btn-warning"
                               href="/type_material/{{$el->id}}/{{$el->tm_name}}">Update</a>
                        </td>
                        <td style="max-width: 50px">
                            <button type="submit" class="w-100 btn btn-danger delete">Delete</button>
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
        function send_id(obj) {
            console.log(obj.dataset.id);

            $.ajax({
                type: "DELETE",
                url: '/type_material/' + obj.dataset.id,
                data: {'_token': $('input[name="_token"]').val()},

                success: function (response, u) {
                    location.reload();
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
            return false;
        }


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

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("tm_name");
            filter = input.value.toUpperCase();
            table = document.getElementById("tm_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection


