<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    public $table = 'cell';
    public $timestamps = false;
    protected $fillable = [
        'rack',
        'story',
        'row',
        ];


}
