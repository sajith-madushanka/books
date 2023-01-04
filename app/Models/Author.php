<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name','middle_name','last_name'
    ];

    public $timestamps = false;

    public static function addNewAuthor($requestData)
    {
        $sve = self::create([
                            'first_name' => $requestData->f_name,
                            'middle_name' => $requestData->m_name,
                            'last_name' => $requestData->l_name,
                        ]);

        if($sve)
            return TRUE;
        else
            return FALSE;
    }

    public static function updateAuthorById($requestData)
    {
        self::where('author_id', $requestData->id)
                    ->update([
                        'first_name' => $requestData->f_name,
                        'middle_name' => $requestData->m_name,
                        'last_name' => $requestData->l_name,
                        ]);
    }
}
