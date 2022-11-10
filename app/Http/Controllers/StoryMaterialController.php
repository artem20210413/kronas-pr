<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Decor;
use App\Models\MaterialModel;
use App\Models\StoryMaterialModel;
use App\Models\TypeMaterialModel;
use Illuminate\Http\Request;

class StoryMaterialController extends Controller
{
    public function StoryMaterialPost($materialId, $code_user, $action){
        $SM = new StoryMaterialModel();
        $material =  MaterialModel::find($materialId);

        //$SM->id = null;
        $SM->vendor_code = $material->vendor_code;
        $SM->type_material = TypeMaterialModel::find($material->type_material_id)->name ;
        $SM->decor = Decor::find($material->decor_id)->name;
        $cell = Cell::find($material->cell_id);
        $SM->cell = $cell->rack . '-'. $cell->storey . '-' . $cell->row;
        $SM->length = $material->length;
        $SM->width = $material->width;
        $SM->thickness = $material->thickness;
        $SM->created_at = $material->created_at;
        $SM->updated_at = $material->updated_at;
        $SM->accounting = $material->accounting;
        $SM->kronas_user = $code_user;
        $SM->action_material_id = $action;
        dump($SM);
        $SM->save();
        dd($SM);
        return true;
    }
}
