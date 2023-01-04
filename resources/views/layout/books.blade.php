@extends('layout.master')
@section('content')
<section class="content asd">
    <div class="box box-danger">
        <div class="box-header" style="padding:20px 0px 0px 10px"><span class="header-text"><h3>New Book</h3></span></div>
        <div class="box-body">
            <form action="{{url('books/add')}}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                <div class="col-md-3">
                    <label>Title</label>
                    <input type="text" class="form-control" id="t_title" name="title">
                </div>
                <div class="col-md-2">
                    <label>Total Pages</label>
                    <input type="number" class="form-control" id="t_pages" name="pages">
                </div>
                <div class="col-md-2">
                    <label>Ratings</label>
                    <input type="number" class="form-control" id="t_ratings" name="ratings">
                </div>
                <div class="col-md-2">
                    <label>ISBN</label>
                    <input type="text" class="form-control" id="t_isbn" name="isbn">
                </div>
                <div class="col-md-12 mt-20">
                </div>
                <div class="col-md-2">
                    <label>Published Date</label>
                    <input type="date" class="form-control" id="t_date" name="date">
                </div>
                <div class="col-md-3">
					<label>Publisher</label>
					<select class="form-control" id="t_publisher" name="publisher">
						<option value="" selected>None</option>
						@foreach($publishers as $t)
						<option value="{{ $t->publisher_id }}">{{ $t->name}}</option>
						@endforeach
					</select>
				</div>
                <div class="col-md-3">
					<label>Genre</label>
					<select class="form-control" id="t_genre" name="genre">
						<option value="" selected>None</option>
						@foreach($genres as $t)
						<option value="{{ $t->genre_id }}">{{ $t->genre}}</option>
						@endforeach
					</select>
				</div>
                <div class="col-md-3">
					<label>Author</label>
					<select class="form-control" id="t_author" name="author">
						<option value="" selected>None</option>
						@foreach($authors as $t)
						<option value="{{ $t->author_id }}">{{ $t->first_name.' '.$t->middle_name.' '.$t->last_name}}</option>
						@endforeach
					</select>
				</div>
                <div class="col-md-12 mt-20">
                    <input type="hidden" id="selected_id" name="id">
                    <button type="submit" class="btn btn-sm btn-success pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="box box-danger" >
        <div class="box-body">
            <div class="flash-message"style="padding:0px 0px 0px 75%" >
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                  @endif
                @endforeach
            </div>
            <table id="practice_wrapper" class="table table-bordered table-striped" style="padding-top:500px">
                <thead>
                    <th style="width: 5%">ID</th>
                    <th style="width: 10%">Title</th>
                    <th style="width: 10%">Total Pages</th>
                    <th style="width: 10%">Ratings</th>
                    <th style="width: 10%">ISBN</th>
                    <th style="width: 10%">Published Date</th>
                    <th style="width: 10%">Publisher</th>
                    <th style="width: 10%">Author</th>
                    <th style="width: 10%">Genre</th>
                    <th style="width: 10%">Action</th>
                </thead>
                <tbody>	
                    @foreach ($books as $t)
                    <tr>
                        <td>{{$t->book_id}}</td>
                        <td>{{$t->title}}</td>
                        <td>{{$t->total_pages}}</td>
                        <td>{{$t->ratings}}</td>
                        <td>{{$t->isbn}}</td>
                        <td>{{$t->published_date}}</td>
                        <td>{{$t->publisher->name}}</td>
                        <td>{{$t->}}</td>
                        <td>{{$t->publisher->name}}</td>
                        <td>
                             <a href="javascript:void(0)" class="edit_auth btn btn-xs btn-primary" data-id="{{$t->author_id}}" data-f="{{$t->first_name}}" data-m="{{$t->middle_name}}" data-l="{{$t->last_name}}" >Edit</a>
                             <a href="{{url('books/delete/'.$t->book_id)}}" class="btn btn-xs btn-danger">Delete</a>
                        <td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    $('.edit_auth').click(function(){
        $('#selected_id').val($(this).data('id'));
        $('#t_f').val($(this).data('f'));
        $('#t_m').val($(this).data('m'));
        $('#t_l').val($(this).data('l'));
       
    });
</script>
@endpush
@section('styles')
<style>
.mt-20 {
    margin-top: 20px;
}
.box-header {
    border-bottom: 1px solid #eee;
}
.header-text {
    font-size: 16px;
    font-weight: 600;
}
.warning {
    color: red;
}
.btn-xs{
    padding: 1px 5px!important;
}
</style>
@endsection