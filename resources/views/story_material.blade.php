@extends('layout')

@section('title')
    Story material
@endsection
@section('body')


    <form class="mt-3 mb-3">
        <div class="accordion" id="accordionExample">

            <div class="row text-center p-3">
                <div class="col-3 p-2">
                    <label> decor </label>
                    <input class="form-control" name="decor" id="decor" onkeyup="searchFunction()" type="text"
                           value="{{$request->decor}}">
                </div>
                <div class="col-2 p-2 ">
                    <label> type_material </label>
                    <input class="form-control" name="type_material" id="type_material" onkeyup="searchFunction()"
                           type="text" value="{{$request->type_material}}">
                </div>
                <div class="col-2 p-2">
                    <label> cell </label>
                    <input class="form-control" name="cell" id="cell" onkeyup="searchFunction()" type="text"
                           value="{{$request->cell}}">
                </div>
                <div class="col-2 p-2">
                    <label> length </label>
                    <input class="form-control" name="length" id="length" onkeyup="searchFunction()" type="number"
                           value="{{$request->length}}">
                </div>
                <div class="col-2 p-2">
                    <label> width </label>
                    <input class="form-control" name="width" id="width" onkeyup="searchFunction()" type="number"
                           value="{{$request->width}}">
                </div>
                <div class="col-1 p-2">
                    <label> thickness </label>
                    <input class="form-control" name="thickness" id="thickness" onkeyup="searchFunction()" type="number"
                           value="{{$request->thickness}}">
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Rest serach
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                     data-bs-parent="#accordionExample">
                    <div class="p-3 row text-center">

                        <div class="col-2 p-2">
                            <label> id </label>
                            <input class="form-control" name="id" id="id" type="number" value="{{$request->id}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> storage_code </label>
                            <input class="form-control" name="storage_code" id="storage_code" type="number"
                                   value="{{$request->storage_code}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> vendor_code </label>
                            <input class="form-control" name="vendor_code" id="vendor_code" type="number"
                                   value="{{$request->vendor_code}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> created_at </label>
                            <input class="form-control" name="created_at" id="created_at" type="date"
                                   value="{{$request->created_at}}">
                        </div>

                        <div class="col-2 p-2">
                            <label> updated_at </label>
                            <input class="form-control" name="updated_at" id="updated_at" type="date"
                                   value="{{$request->updated_at}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> kronas_user </label>
                            <input class="form-control" name="kronas_user" id="kronas_user" type="number"
                                   value="{{$request->kronas_user}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> action_material_id </label>
                            <input class="form-control" name="action_material_id" id="action_material_id" type="number"
                                   value="{{$request->action_material_id}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> accounting </label>
                            <input class="form-control" name="accounting" id="accounting" type="text"
                                   value="{{$request->accounting}}">
                        </div>
                        <div class="col-2 p-2">
                            <label> storage_code </label>
                            <input class="form-control" name="storage_code" id="storage_code" type="text"
                                   value="{{$request->storage_code}}">
                        </div>


                        <!--<button class="w-100 btn btn-primary">Search</button>-->
                    </div>

                </div>
            </div>
        </div>

        <button type="submit" class="w-100 btn btn-primary mt-2"> Search</button>


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


        function searchFunction() {
            var filter, table, tr, td, i, txtValue, filter_tm, txtValue_tm, td_tm, filter_cell, txtValue_cell, td_cell,
                filter_l, txtValue_l, td_l, filter_w, txtValue_w, td_w, filter_t, txtValue_t, td_t;
            filter = document.getElementById("decor").value.toUpperCase();
            filter_tm = document.getElementById("type_material").value.toUpperCase();
            filter_cell = document.getElementById("cell").value.toUpperCase();
            filter_l = document.getElementById("length").value.toUpperCase();
            filter_w = document.getElementById("width").value.toUpperCase();
            filter_t = document.getElementById("thickness").value.toUpperCase();

            table = document.getElementById("story_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                td_tm = tr[i].getElementsByTagName("td")[3];
                td_cell = tr[i].getElementsByTagName("td")[5];
                td_l = tr[i].getElementsByTagName("td")[6];
                td_w = tr[i].getElementsByTagName("td")[7];
                td_t = tr[i].getElementsByTagName("td")[8];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    txtValue_tm = td_tm.textContent || td_tm.innerText;
                    txtValue_cell = td_cell.textContent || td_cell.innerText;
                    txtValue_l = td_l.textContent || td_l.innerText;
                    txtValue_w = td_w.textContent || td_w.innerText;
                    txtValue_t = td_t.textContent || td_t.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 &&
                        txtValue_tm.toUpperCase().indexOf(filter_tm) > -1 &&
                        txtValue_cell.toUpperCase().indexOf(filter_cell) > -1 &&
                        txtValue_l.toUpperCase().indexOf(filter_l) > -1 &&
                        txtValue_w.toUpperCase().indexOf(filter_w) > -1 &&
                        txtValue_t.toUpperCase().indexOf(filter_t) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection


