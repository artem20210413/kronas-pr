<?php

namespace App\Models;

use App\Http\Requests\CellRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    public $table = 'cell';
    public $timestamps = false;
    protected $fillable = [
        'rack',
        'storey',
        'row',
    ];


    public function tranporate($rack = '', $storey = 66, $row = 1)
    {
        /* вывести массив отсортированных элементов */
        return self::where('rack', $rack)->get();
        //return self::all();
    }

    public function transform_cell(CellRequest $request)
    {

        //$request->row = $request->row*5;
        /*  Создать новый элемент в таблице */
        $a = Cell::create($request->all());
        dd($a);
    }
    protected static function boot(): void
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->storey = $query->storey * 5;
        });
    }
}
