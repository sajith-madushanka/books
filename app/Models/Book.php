<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id','title','total_pages','ratings','isbn','published_date','publisher_id'
    ];

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id','publisher_id');
    }

    public function genre(){
		return $this->belongsTo(Genre::class, 'book_genres', 'book_id', 'genre_id');
	}
   

    public function author(){
        return $this->belongsTo(Author::class, 'book_authors');
    } 
    public $timestamps = false;
}
