<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Validator,Session;

class AuthorController extends Controller
{
    public function index()
    {
        $data = Author::get();
    
        return view('layout.author',compact('data'));
    }

    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'f_name' => 'required|string',
            'm_name' => 'required|string',
            'l_name' => 'required|string',
          ],[   'f_name.required' => "First name required",
                'm_name.required' => "Middle name required",
                'l_name.required' => "Last name required",
        
            ]);
        
        if ($validator->fails()) {
            $request->session()->flash('alert-danger', $validator->errors()->first());
        }
        else{
           
            if(empty($request->id)){
                if (Author::addNewAuthor($request))
                    $request->session()->flash('alert-success', 'Author added successfully!');

                else
                    $request->session()->flash('alert-danger', 'Error adding new Author!');
            }
            else if ($request->id ){
                Author::updateAuthorById($request);
                $request->session()->flash('alert-success', 'Author updated successfully');
            }
        }
        return redirect('authors');
    }

    public function delete( $id)
    {
        
       
        Author::where('author_id', $id)->delete();
        Session::flash('alert-success', 'Author Removed successfully!');
        
        return redirect('authors');
        
    }
}
