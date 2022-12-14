<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMaterialModel extends Model
{
    use HasFactory;

    public $table = 'type_material';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tm_name'
    ];

    protected static function boot(): void
    {
        parent::boot();
    }
}
