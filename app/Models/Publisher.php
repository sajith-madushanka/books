<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public static function addNewPublisher($requestData)
    {
        $sve = self::create([
                            'name' => $requestData->name,
                        ]);

        if($sve)
            return TRUE;
        else
            return FALSE;
    }

    public static function updatePublisherById($requestData)
    {
        self::where('publisher_id', $requestData->id)
                    ->update([
                            'name' => $requestData->name
                        ]);
    }
}
