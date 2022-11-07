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
//        $first = request()->segment(3);
//        $second = request()->segment(4);
////        $param = URL::current();
//        $part_1 = $request->route('part_1');
//        $part_2 = $request->route('part_2');
//        $part_1_  =explode("=", $part_1);
//        $part_2_  =explode("=", $part_2);
//
//        if($part_1_[0]='name'){
//            echo 'name = '. $part_1_[1].' / ';
//            echo 'id = '. $part_2_[1];
//        }else if ($part_1_[0]='id')
//        {
//            echo 'name = '. $part_2_[1].' / ';
//            echo 'id = '. $part_1_[1].' / ';
//        }

        echo $this->get_URL_variable($request, 'id', 2);
        // echo $part_1_[1] . '_' . $part_2_[1];
    }

    public function testURL2(Request $request, JSONcontroller $JSON)
    {
//       dd($request->get('a'));
        dd($request->all());
    }

    public function DecorCreateAndUpdate(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vName = $request->get('name');
            if ($vName == null) {
                return $JSON->JSONerror('Нічого не передали або немає аргумента `name`', 401);
            } else if ($vId == null) {
                $decor = new Decor();
                $decor->name = $vName;
                $decor->save();
                return $JSON->JSONsuccess('Успіх', 201);
            } else {
                $decor = Decor::find($vId);
                $decor->update($request->all());
                return $JSON->JSONsuccess('Успіх', 201);
            }
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
