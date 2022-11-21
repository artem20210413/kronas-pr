<?php

namespace App\Http\Controllers\Web\Decor;


use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Controllers\Controller;
use App\Models\StoryMaterialModel;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class WebStoryMaterialController extends Controller
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
            $vKronasUser = $request->get('kronas_user');
            $vCount = $request->get('count');

            if ($vCount == null || $vCount == 0) {
                $vCount = 512;
            }
            if ($vId == null && $vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null &&
                $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null && $vStorageCode == null && $vKronasUser == null) {
                $TM = new StoryMaterialModel(); //model
                $GetTM = $TM->all();
            } else {
                $sm = StoryMaterialModel::where('id', '<>', 0);
                foreach ($request->all() as $key => $req)
                    if ($key != 'id')
                        $sm->where($key, 'like', "%" . $req . "%");
                    else $sm->where($key, $req);
                $GetTM = $sm->skip($vCount)->take($vCount)->get();
            }
            return view('story_material', ['SM' => $GetTM]);
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }
}
