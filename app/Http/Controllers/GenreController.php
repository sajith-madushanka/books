<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Validator,Session;

class GenreController extends Controller
{
    public function index()
    {
        $data = Genre::get();
    
        return view('layout.genre',compact('data'));
    }

    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'genre' => 'required',
          ],['genre.required' => "Genre required"]);
        
        if ($validator->fails()) {
            $request->session()->flash('alert-danger', $validator->errors()->first());
        }
        else{
           
            if(empty($request->id)){
                if (Genre::addNewGenre($request))
                    $request->session()->flash('alert-success', 'Genre added successfully!');

                else
                    $request->session()->flash('alert-danger', 'Error adding new Genre!');
            }
            else if ($request->id ){
                Genre::updateGenreById($request);
                $request->session()->flash('alert-success', 'Genre updated successfully');
            }
        }
        return redirect('genres');
    }

    public function delete( $id)
    {
        
       
        if(Genre::where('parent_id',$id)->first()){
            
            Session::flash('alert-danger', 'Remove Childrens First!');
        }
        else{
            Genre::where('genre_id', $id)->delete();
            Session::flash('alert-success', 'Genre Removed successfully!');
        }
        
        return redirect('genres');
        
    }
}
