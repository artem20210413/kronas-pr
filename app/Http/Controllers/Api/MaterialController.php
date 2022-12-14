<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialCollection;
use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use PhpParser\ErrorHandler\Collecting;
use Carbon\Carbon;

class MaterialController extends Controller
{


    public function takeMaterial($user, MaterialModel $material)
    {
        try {
           // dd($material_id);
            //$material = MaterialModel::find($material_id);
            //dd($material);
            $material->accounting = 0;
            $material->cell_id = null;
            $material->update();

            (new StoryMaterialController())->StoryMaterialPost($material->id, $user, 3);

            return (new JSONcontroller())->JSONsuccessArray('take', 'Update material', $material, 201);
        } catch (\Exception $e) {
            return (new JSONcontroller())->JSONerror($e->getMessage(), 501);
        }
    }

    public function moveMaterial($user, MaterialModel $material, $cell_id)
    {
        try {
            //$material = MaterialModel::find($material_id);
            $material->accounting = 1;
            $material->cell_id = $cell_id;
            $material->update();
            (new StoryMaterialController())->StoryMaterialPost($material->id, $user, 3);
            return (new JSONcontroller())->JSONsuccessArray('move', 'Update material', $material, 201);
        } catch (\Exception $e) {
            return (new JSONcontroller())->JSONerror($e->getMessage(), 501);
        }
    }

//    function empty($string): stringf
//    {
//        if ($string != null)
//            return ' ' . $string;
//        else
//            return '';
//    }

//    public function GG(Request $request)
//    {
//        //dd(MaterialAllModel::cell());
//        dd(DB::select('CALL material_decor(' . $request->get('id') . ')'));
//
//    }

    public function MaterialHelp()
    {
        $material = new MaterialModel();
        $fields = "";
        foreach ($material->getFillable() as $key => $value) {
            $fields = $fields . '`' . $value . '` ';
        }
        return response()->json([
            '???????????? ?????????? ?? ??????????????' => $fields
        ], 200);
    }

    public function MaterialGet(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material_id = $request->get('type_material_id');
            $vDecor_id = $request->get('decor_id');
            $vCell_id = $request->get('cell_id');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            $vCreated_at = $request->get('created_at');
            $vUpdated_at = $request->get('updated_at');
            $vAccounting = $request->get('accounting');
            $vStorageCode = $request->get('storage_code');

            if ($vId == null && $vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null
                && $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null && $vStorageCode == null) {
                $material = new MaterialModel(); //model
                return $JSON->JSONsuccessArray('Get  all', 'Material', $material::all(), 200);
            } else {
//                $m = MaterialModel::all();
                $m = MaterialModel::where('id', '<>', 0);

                foreach ($request->all() as $key => $req)
                    if ($key == 'length' || $key == 'width' || $key == 'thickness' || $key == 'created_at' || $key == 'updated_at')
                        $m->where($key, 'like', "%" . $req . "%");
                    else $m->where($key, $req);

                $GetTM = $m->get();

//                //$m = MaterialModel::where(['id' => $vId, 'vendor_code' => $vVendor_code])->get();
//                $GetTM = DB::table('material')
//                    ->where('id', 'like', "%" . $vId . "%")
//                    ->where('vendor_code', 'like', "%" . $vVendor_code . "%")
//                    ->where('type_material_id', 'like', "%" . $vType_material_id . "%")
//                    ->where('decor_id', 'like', "%" . $vDecor_id . "%")
//                    ->where('cell_id', 'like', "%" . $vCell_id . "%")
//                    ->where('length', 'like', "%" . $vLength . "%")
//                    ->where('width', 'like', "%" . $vWidth . "%")
//                    ->where('thickness', 'like', "%" . $vThickness . "%")
//                    ->where('created_at', 'like', "%" . $vCreated_at . "%")
//                    ->where('updated_at', 'like', "%" . $vUpdated_at . "%")
//                    ->where('accounting', 'like', "%" . $vAccounting . "%")
//                    ->get();
//                dd(MaterialModel::where(['id'=>1])->get());
                //dd($GetTM);
//                $m = MaterialModel::where(['id' => $vId, 'vendor_code' => $vVendor_code])->get();
//                foreach ($m as $k => $v){
//                    echo $v->decor->name;
//                }

                return $JSON->JSONsuccessArray('?????????? ???? ??????????????',
                    'Material',
                    $GetTM,
                    200);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }


    public function MaterialDelete(Request $request, JSONcontroller $JSON)
    {
        try {
            if (($vId = $request->post('id')) != null) {
                $res = MaterialModel::destroy($vId);
                if ($res != 0) {
                    return $JSON->JSONsuccess('?????????????? ?????????????????? ?????????????? ?? id=' . $vId, 200);
                } else {
                    return $JSON->JSONerror('?????????????? ?? id=' . $vId . ' ???? ??????????????, ?????????????????? ?????? ?????????????? ??????????????', 401);
                }
            } else return $JSON->JSONerror('???????????????? ????????`???????????? ???????? `id`', 401);


        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

//    protected function validToken($Token)
//    {
//
//        //dd($Token);
//        $res = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//            'Authorization' => $Token,
//
//        ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
//        if ($res->status() == 200)
//            return true;
//        else return false;
//
////    $client = new GuzzleHttp\Client();
////    $res = $client->request('GET', 'https://auth.kronas.com.ua/api/v1/my/roles', [
////        'Content-Type' => ['user', 'pass']
////    ]);
////        return false;
//    }

    public function MaterialPost(Request $request, JSONcontroller $JSON, StoryMaterialController $storyMaterial)
    {
        //$this->validToken($request->header('Authorization'));


        try {

            $vId = $request->post('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material_id = $request->get('type_material_id');
            $vDecor_id = $request->get('decor_id');
            $vCell_id = $request->get('cell_id');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            $vUser = $request->get('code_user');
            $vStorageCode = $request->get('storage_code');

            // $storyMaterial->StoryMaterialPost($vId, $vUser);
            //$vAccounting = $request->get('accounting');
            if ($vUser != null) {
                if ($vId == null || $vId == 0) {
                    if ($vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null
                        && $vLength == null && $vWidth == null && $vThickness == null && $vStorageCode == null) {
                        return $JSON->JSONerror('?????????????? ???? ????????`???????????? ?????????? ???? ?????????? ?????? ???????? ??????????????: `vendor_code`, `type_material_id`, `decor_id`, `cell_id`, `length`, `width`, `thickness`, `storage_code`', 401);
                    } else {//?????????????????? ????????
                        $material = new MaterialModel();
                        foreach ($request->all() as $key => $value) {
                            if (($key != 'created_at' || $key != 'updated_at') && Schema::hasColumn($material->table, $key)) {
                                $material->{$key} = $value;
                            }
                        }
                        $material->created_at = Carbon::now();
                        $material->updated_at = Carbon::now();//Carbon::toDateTimeString();;
                        $material->accounting = 1;
                        $material->save();

                        $vNewMaterial = DB::table('material')->latest('id')->first();

                        //???????????? ?? ??????????????
                        $storyMaterial->StoryMaterialPost($vNewMaterial->id, $vUser, 1);

                        return $JSON->JSONsuccessArray('Get  all', 'New material', $vNewMaterial, 201);
                    }
                } else { //?????????????????? ????????
                    $materialU = MaterialModel::find($vId);
                    if ($materialU == null) {
                        return $JSON->JSONerror('???????????????? ?? id: ' . $vId . ' ???? ??????????', 501);
                    }
                    foreach ($request->all() as $key => $value) {
                        if (($key != 'created_at' || $key != 'updated_at') && Schema::hasColumn($materialU->table, $key)) {
                            $materialU->{$key} = $value;
                        }
                    }
                    $materialU->updated_at = Carbon::now();
                    $materialU->update();
                    //???????????? ?? ??????????????
                    $storyMaterial->StoryMaterialPost($vId, $vUser, 2);

                    $vUpdateDecor = DB::table('material')->where('id', $vId)->get();
                    return $JSON->JSONsuccessArray('Update', 'Update material', $vUpdateDecor, 201);
                }
            } else {
                return $JSON->JSONerror('????????`???????????? ???????? `code_user` ???? ?????????? ?????? ??????????????', 401);
            }
//            }
//            else{
//                return $JSON->JSONerror("unauthorized", 401);
//            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }
}
