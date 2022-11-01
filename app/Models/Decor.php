<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{
    use HasFactory;

    public $table = 'decor';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    protected static function boot(): void
    {
        parent::boot();
    }
}
