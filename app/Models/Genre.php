<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'genre','parent_id'
    ];

    public $timestamps = false;

    public static function addNewGenre($requestData)
    {
        $sve = self::create([
                            'genre' => $requestData->genre,
                            'parent_id' => $requestData->parent,
                        ]);

        if($sve)
            return TRUE;
        else
            return FALSE;
    }

    public static function updateGenreById($requestData)
    {
        self::where('genre_id', $requestData->id)
                    ->update([
                            'genre' => $requestData->genre,
                            'parent_id' => $requestData->parent,
                        ]);
    }
}
