@extends('layout')

@section('title')
    Story material
@endsection
@section('body')


    <form class="mt-3 mb-3">
        <div class="row">

            <div class="col-2 p-2">
                <label> type_material </label>
                <input class="form-control" name="type_material" id="type_material" type="text">
            </div>
            <div class="col-2 p-2">
                <label> decor </label>
                <input class="form-control" name="decor" id="decor" type="text">
            </div>
            <div class="col-1 p-2">
                <label> cell </label>
                <input class="form-control" name="cell" id="cell" type="text">
            </div>
            <div class="col-1 p-2">
                <label> length </label>
                <input class="form-control" name="length" id="length" type="number">
            </div>
            <div class="col-1 p-2">
                <label> width </label>
                <input class="form-control" name="width" id="width" type="number">
            </div>
            <div class="col-1 p-2">
                <label> thickness </label>
                <input class="form-control" name="thickness" id="thickness" type="number">
            </div>
            <div class="col-1 p-2">
                <label> id </label>
                <input class="form-control" name="id" id="id" type="number">
            </div>
            <div class="col-1 p-2">
                <label> storage_code </label>
                <input class="form-control" name="storage_code" id="storage_code" type="number">
            </div>
            <div class="col-1 p-2">
                <label> vendor_code </label>
                <input class="form-control" name="vendor_code" id="vendor_code" type="number">
            </div>
            <div class="col-2 p-2">
                <label> created_at </label>
                <input class="form-control" name="created_at" id="created_at" type="date">
            </div>

            <div class="col-2 p-2">
                <label> updated_at </label>
                <input class="form-control" name="updated_at" id="updated_at" type="date">
            </div>
            <div class="col-1 p-2">
                <label> kronas_user </label>
                <input class="form-control" name="kronas_user" id="kronas_user" type="number">
            </div>
            <div class="col-1 p-2">
                <label> action_material_id </label>
                <input class="form-control" name="action_material_id" id="action_material_id" type="number">
            </div>
            <div class="col-1 p-2">
                <label> accounting </label>
                <input class="form-control" name="accounting" id="accounting" type="text">
            </div>
            <div class="col-1 p-2">
                <label> storage_code </label>
                <input class="form-control" name="storage_code" id="storage_code" type="text">
            </div>
            <button class="w-100 btn btn-primary">Search</button>
        </div>
    </form>
    <table class="table mt-4" id="story_table">
        <tr class="thead-dark">
            <th scope="col">Id</th>
            <th scope="col">storage_code</th>
            <th scope="col">vendor_code</th>
            <th scope="col">type_material</th>
            <th scope="col">decor</th>
            <th style="width: 70px" scope="col">cell</th>
            <th scope="col">length</th>
            <th scope="col">width</th>
            <th scope="col">thickness</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">kronas_user</th>
            <th scope="col">material_id</th>
            <th scope="col">accounting</th>
        </tr>

        @foreach($SM as $el)
            <tr id="{{$el->id}}">
                <td>{{$el->id}}</td>
                <td>{{$el->storage_code}}</td>
                <td>{{$el->vendor_code}}</td>
                <td>{{$el->type_material}}</td>
                <td>{{$el->decor}}</td>
                <td>{{$el->cell}}</td>
                <td>{{$el->length}}</td>
                <td>{{$el->width}}</td>
                <td>{{$el->thickness}}</td>
                <td>{{$el->created_at}}</td>
                <td>{{$el->updated_at}}</td>
                <td>{{$el->kronas_user}}</td>
                <td>{{$el->action_material_id}}</td>
                <td>{{$el->accounting}}</td>
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

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("decor_name");
            filter = input.value.toUpperCase();
            table = document.getElementById("story_table");
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


