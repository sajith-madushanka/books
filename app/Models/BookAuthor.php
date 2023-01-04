<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id','author_id'
    ];

    public $timestamps = false;


    public function books(){
        return $this->belongsToMany(Book::class, 'book_id');
    }
}
