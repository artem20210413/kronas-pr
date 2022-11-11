<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialAllModel extends Model
{
    use HasFactory;
    public $table = 'material_all';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'vendor_code',
        'type_material_id',
        'decor_id',
        'cell_id',
        'length',
        'width',
        'thickness',
        'code_user',
//        'created_at',
//        'updated_at',
        'accounting'
    ];

    public function getFillable()
    {
        return $this->fillable;
    }
    protected static function boot(): void
    {
        parent::boot();
    }

}
