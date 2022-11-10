<?php

namespace App\Http\Controllers;

use App\Models\MaterialModel;
use App\Models\StoryMaterialModel;
use Illuminate\Http\Request;

class StoryMaterialController extends Controller
{
    public function StoryMaterialPost($materialId, $code_user, $action){
        $SM = new StoryMaterialModel();
        $material =  MaterialModel::find($materialId);

        //$SM->id = 0;
        $SM->vendor_code = $material->vendor_code;
        $SM->type_material_id = $material->type_material_id;
        $SM->decor_id = $material->decor_id;
        $SM->cell_id = $material->cell_id;
        $SM->length = $material->length;
        $SM->width = $material->width;
        $SM->thickness = $material->thickness;
        $SM->created_at = $material->created_at;
        $SM->updated_at = $material->updated_at;
        $SM->accounting = $material->accounting;
        $SM->code_user = $code_user;
        $SM->action_material_id = $action;
        dump($SM);
        $SM->save();
        dd($SM);
        return true;
    }
}
