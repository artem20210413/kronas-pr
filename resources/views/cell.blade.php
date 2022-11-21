@extends('layout')

@section('title')
    Cell
@endsection
@section('body')

    <div class="row justify-content-md-center text-center">
        <div class="col-md-12">

            <div class="mb-3 mt-4 row">

                <div class="col-2 offset-5"><!--offset-md-5-->
                    <form method="get" action="/cell/{{$storage_id}}" id="rack_form">
                        <lable>Storage id: {{$storage_id}}</lable>
                        <select class="form-control" type="select" name="rack" id="rack_select">
                            <option value="">all</option>
                            @foreach($allRack as $el)
                                <option @if($el->rack == $rack)selected
                                        @endif value="{{$el->rack}}">{{$el->rack}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="col-2 offset-3">
                    <a class="w-100 btn btn-success" href="/cell/update/{{$storage_id}}">Editing cell</a>
                </div>

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

    <script>



        $("#rack_select").on("change", function () {
            $("#rack_form").submit();
        });
    </script>
@endsection


