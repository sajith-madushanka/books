@extends('layout.master')
 
@section('content')
    <div class="row" style="padding: 5% 0 0 0">
            <div class="col-md-3" style="padding: 0 3px 0 3px">
                <a class="btn btn-primary" href="books">Books</a>
            </div>
            <div class="col-md-3" style="padding: 0 3px 0 3px">
                <a class="btn btn-primary"  href="authors">Authors</a>
            </div>
            <div class="col-md-3" style="padding: 0 3px 0 3px">
                <a class="btn btn-primary" href="publishers">Publishers</a>
             </div>
             <div class="col-md-3" style="padding: 0 3px 0 3px">
                <a class="btn btn-primary" href="genres" >Genres</a>
             </div>
    </div>
@endsection