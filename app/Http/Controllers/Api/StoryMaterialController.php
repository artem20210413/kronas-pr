<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Decor;
use App\Models\MaterialModel;
use App\Models\StoryMaterialModel;
use App\Models\TypeMaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoryMaterialController extends Controller
{

    public function StoryMaterialGet(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material_id = $request->get('type_material');
            $vDecor_id = $request->get('decor');
            $vCell_id = $request->get('cell');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            $vCreated_at = $request->get('created_at');
            $vUpdated_at = $request->get('updated_at');
            $vAccounting = $request->get('accounting');
            $vStorageCode = $request->get('storage_code');

            if ($vId == null && $vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null &&
                 $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null && $vStorageCode == null) {
                $SM = new StoryMaterialModel(); //model
                return $JSON->JSONsuccessArray('Get  all', 'Story material', $SM::all(), 200);
            } else {
                $sm = StoryMaterialModel::where('id', '<>', 0);

                foreach ($request->all() as $key => $req)
                    if ($key != 'id')
                        $sm->where($key, 'like', "%" . $req . "%");
                    else $sm->where($key, $req);

                $GetTM = $sm->get();

                return $JSON->JSONsuccessArray('Пошук по змінній',
                    'Material',
                    $GetTM,
                    200);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }

    public function StoryMaterialPost($materialId, $kronas_user, $action_material_id)
    {
        $SM = new StoryMaterialModel();
        $material = MaterialModel::find($materialId);

        $SM->id = null;
        $SM->vendor_code = $material->vendor_code;
        $SM->type_material = TypeMaterialModel::find($material->type_material_id)->tm_name;
        $SM->decor = Decor::find($material->decor_id)->decor_name;
        $cell = Cell::find($material->cell_id);
        $SM->cell = $cell->rack . '-' . $cell->storey . '-' . $cell->row;
        $SM->length = $material->length;
        $SM->width = $material->width;
        $SM->thickness = $material->thickness;
        $SM->created_at = $material->created_at;
        $SM->updated_at = $material->updated_at;
        $SM->accounting = $material->accounting;
        $SM->storage_code = $material->storage_code;
        $SM->kronas_user = $kronas_user;
        $SM->action_material_id = $action_material_id;
        //dd($SM);
        // dump($SM);
        $SM->save();
        // dd($SM);
        return true;
    }
}
