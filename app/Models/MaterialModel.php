<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{
    use HasFactory;
    public $table = 'material';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'vendor_code',
        'type_material_id',
        'decor_id',
        'cell_id',
        'Length',
        'Width',
        'Thickness',
        'created_at',
        'updated_at',
        'Accounting'
    ];

    protected static function boot(): void
    {
        parent::boot();
    }
}
