<?php

namespace App\Http\Controllers\Web\Decor;


use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebMaterialController extends Controller
{

    private function getMaterial(){
//        $Ms =  MaterialModel::all();
        $Ms =  MaterialModel::where('id', '<>', 0)->get();
        //dump("Ms / " . $Ms);
        foreach ($Ms as $M) {
            //dump("M / " . $M);
            foreach ($M as $kay => $value) {
                //if ($kay == 'decor_id') {
                    dump($kay . " / " . $value);
               // }
            }
        }
        dd(5);
        return ;
    }
    public function index(Request $request, JSONcontroller $JSON)
    {$this->getMaterial();
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
                $GetTM = $material::all();
//                $m = MaterialModel::all();
                $m = MaterialModel::where('id', '<>', 0);

                foreach ($request->all() as $key => $req) {
                    if ($key == 'length' || $key == 'width' || $key == 'thickness' || $key == 'created_at' || $key == 'updated_at') {
                        $m->where($key, 'like', "%" . $req . "%");
                    } else {
                        $m->where($key, $req);
                    }
                }

                $GetTM = $m->get();
                return view('production_material', ['M' => $GetTM, 'request' => $request]);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
