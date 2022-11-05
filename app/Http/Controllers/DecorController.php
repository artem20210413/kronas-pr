<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecorRequest;
use App\Models\Decor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class DecorController extends Controller
{

    public function testURL(Request $request, JSONcontroller $JSON)
    {

//        Route::get('test/&v={v}',[DecorController::class, 'testURL']);//test
        $first = request()->segment(3);
        $second = request()->segment(4);
//        $param = URL::current();
//        $username = $v = '';
//        parse_str($param);
        echo $request->route('v') . '_';
        echo $request->route('g');
//        echo $first;
//        echo $second;
    }
    public function DecorCreate(DecorRequest $request, JSONcontroller $JSON)
    {
        try {

            //$decor = new Decor();
            //$decor->name = $request->input('name');
            //$decor->save();
            Decor::create($request->all());
            return $JSON->JSONsuccess('Успіх', 201);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorUpdate(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $decor = Decor::find($request->input('id'));
            //$decor->name = $request->input('name');
            //$decor->save();
            //and
            $decor->update($request->all());
            return $JSON->JSONsuccess('Успіх', 201);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorGet(Request $request, JSONcontroller $JSON)
    {

        try {
            $TM = new Decor(); //model
            try {
                $request->validate([
                    'name' => 'required'
                ]);

            } catch (\Exception $e) {
                return $JSON->JSONsuccessArray('Get  all', 'Decor', $TM::all(), 200);
            }

            $GetTM = DB::table('decor')->where('name', 'like', "%" . $request->input('name') . "%")->get();
            //$GetTM = DB::select("select * from decor where name like '%" . $request->input('name') . "%'");

            return $JSON->JSONsuccessArray('Get name by like ' . $request->input('name') . '',
                'Decor',
                $GetTM,
                200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorDestroy(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $res = Decor::destroy($request->get('ids'));
            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
