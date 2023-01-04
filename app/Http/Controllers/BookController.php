<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\BookGenre;
use Validator,Session;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('publisher')->with('genre')->with('author')->get();
        $authors = Author::get();
        $genres = Genre::get();
        $publishers = Publisher::get();
        return $books;
        return view('layout.books',compact('books','authors','genres','publishers'));
    }

    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string',
            'pages' => 'required|numeric|min:0',
            'ratings' => 'required|numeric',
            'isbn' => 'required|string',
            'date' =>'required|date'
          ],[   'title.required' => "Title name required",
                'pages.required' => "Total Pages required",
                'ratings.required' => "Ratings required",
                'isbn.required' => "ISBN required",
                'date.required' => "Published Date required",
        
            ]);
        
        if ($validator->fails()) {
            $request->session()->flash('alert-danger', $validator->errors()->first());
        }
        else{
           
            if(empty($request->id)){
                $book = new Book([
                    'title' =>$request->title,
                    'total_pages'  => $request->pages,
                    'ratings' => $request->ratings,
                    'isbn' => $request->isbn,
                    'published_date' => $request->date,
                    'publisher_id' => $request->publisher
                ]);
                if ($book->save()){
                    if($request->author){
                        $author = new BookAuthor([
                            'book_id' => $book->id,
                            'author_id' => $request->author,
                        ]);
                        $author->save();
                    }
                    if($request->genre){
                        $genre = new BookGenre([
                            'book_id' => $book->id,
                            'genre_id' => $request->genre,
                        ]);
                        $genre->save();
                    }
                    $request->session()->flash('alert-success', 'Book added successfully!');
                }
                else
                    $request->session()->flash('alert-danger', 'Error adding new Book!');
            }
            else if ($request->id ){
                BookAuthor::where('book_id',$request->id)->delete();
                BookGenre::where('book_id',$request->id)->delete();
                Book::where('book_id',$request->id)->update([  
                                                        'title' =>$request->title,
                                                        'total_pages'  => $request->pages,
                                                        'ratings' => $request->ratings,
                                                        'isbn' => $request->isbn,
                                                        'published_date' => $request->date,
                                                        'publisher_id' => $request->publisher]);
                if($request->author){
                    $author = new BookAuthor([
                        'book_id' => $request->id,
                        'author_id' => $request->author,
                    ]);
                    $author->save();
                }
                if($request->genre){
                    $genre = new BookGenre([
                        'book_id' => $request->id,
                        'genre_id' => $request->genre,
                    ]);
                    $genre->save();
                }                                   
                $request->session()->flash('alert-success', 'Book updated successfully');
            }
        }
        return redirect('books');
    }

    public function delete( $id)
    {
        
       
        Book::where('book_id', $id)->delete();
        Session::flash('alert-success', 'Book Removed successfully!');
        
        return redirect('books');
        
    }
}
