<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StoryMaterialModel extends Model
{
    use HasFactory;
    public $table = 'story_material';
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
        'code_user',
        'created_at',
        'updated_at',
        'accounting'
    ];



    public function decor(): HasOne
    {
        return $this->hasOne(Decor::class, 'id', 'decor_id');
    }

    protected static function boot(): void
    {
        parent::boot();
    }
}
