<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialCollection;
use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PhpParser\ErrorHandler\Collecting;
use Carbon\Carbon;

class MaterialController extends Controller
{
    function empty($string): string
    {
        if ($string != null)
            return ' ' . $string;
        else
            return '';
    }

    public function MaterialHelp()
    {
        $material = new MaterialModel();
        $fields = "";
        foreach ($material->getFillable() as $key => $value) {
            $fields = $fields . '`' . $value . '` ';
        }
        return response()->json([
            'Список полів у таблиці' => $fields
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

            if ($vId == null && $vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null
                && $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null) {
                $material = new MaterialModel(); //model
                return $JSON->JSONsuccessArray('Get  all', 'Material', $material::all(), 200);
            } else {
//                $m = MaterialModel::all();
                $m = MaterialModel::where('id', '<>', 0);

                foreach ($request->all() as $key => $req)
                    if ($key == 'length' || $key == 'width' || $key == 'thickness')
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

                return $JSON->JSONsuccessArray('Пошук по змінній',
                    'Material',
                    $GetTM,
                    200);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }


    public function MaterialPost(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->post('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material_id = $request->get('type_material_id');
            $vDecor_id = $request->get('decor_id');
            $vCell_id = $request->get('cell_id');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            //$vAccounting = $request->get('accounting');
            if ($vId == null || $vId == 0) {

                if ($vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null
                    && $vLength == null && $vWidth == null && $vThickness == null) {
                    return $JSON->JSONerror('якогось із обов`зкових полів не існує або воно порожнє: `vendor_code`, `type_material_id`, `decor_id`, `cell_id`, `length`, `width`, `thickness`', 401);
                } else {//Створення поля
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

                    return $JSON->JSONsuccessArray('Get  all', 'New material', $vNewMaterial, 201);
                }
            } else { //Оновлення поля
                $materialU = MaterialModel::find($vId);
                if ($materialU == null) {
                    return $JSON->JSONerror('Елемента з id: ' . $vId . ' не існує', 501);
                }
                foreach ($request->all() as $key => $value) {
                    if (($key != 'created_at' || $key != 'updated_at') && Schema::hasColumn($materialU->table, $key)) {
                        $materialU->{$key} = $value;
                    }
                }
                $materialU->updated_at = Carbon::now();
                $materialU->update();

                $vUpdateDecor = DB::table('material')->where('id', $vId)->get();
                return $JSON->JSONsuccessArray('Update', 'Update material', $vUpdateDecor, 201);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }
}
