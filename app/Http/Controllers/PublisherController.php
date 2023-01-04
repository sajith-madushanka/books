<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;
use Validator,Session;

class PublisherController extends Controller
{
    public function index()
    {
        $data = Publisher::get();
    
        return view('layout.publisher',compact('data'));
    }

    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required'
          ],['name.required' => "name required"]);
        
        if ($validator->fails()) {
            $request->session()->flash('alert-danger', $validator->errors()->first());
        }
        else{
           
            if(empty($request->id)){
                if (Publisher::addNewPublisher($request))
                    $request->session()->flash('alert-success', 'Publisher added successfully!');

                else
                    $request->session()->flash('alert-danger', 'Error adding new Publisher!');
            }
            else if ($request->id ){
                Publisher::updatePublisherById($request);
                $request->session()->flash('alert-success', 'Publisher updated successfully');
            }
        }
        return redirect('publishers');
    }

    public function delete( $id)
    {
        Publisher::where('publisher_id', $id)->delete();
        Session::flash('alert-success', 'Publisher Removed successfully!');
        return redirect('publishers');
        
    }
}
