<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'length',
        'width',
        'thickness',
        'code_user',
        'accounting'
    ];

    public function getFillable()
    {
        return $this->fillable;
    }

    protected $guarded = ['created_at'];

    public function decor(): HasOne
    {
        return $this->hasOne(Decor::class, 'id', 'decor_id');
    }

//    protected static function boot(): void
//    {
//        parent::boot();
//    }
}
