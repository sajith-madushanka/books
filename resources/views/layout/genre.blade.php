@extends('layout.master')
@section('content')
<section class="content asd">
    <div class="box box-danger">
        <div class="box-header" style="padding:20px 0px 0px 10px"><span class="header-text"><h3>New Genre</h3></span></div>
        <div class="box-body">
            <form action="{{url('genres/add')}}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                <div class="col-md-4">
                    <label>Genre</label>
                    <input type="text" class="form-control" id="t_genre" name="genre">
                </div>
                <div class="col-md-3">
					<label>Parent</label>
					<select class="form-control" id="t_parent" name="parent">
						<option value="" selected>None</option>
						@foreach($data as $t)
						<option value="{{ $t->genre_id }}">{{ $t->genre}}</option>
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
            <div class="flash-message"style="padding:0px 0px 0px 80%" >
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                  @endif
                @endforeach
            </div>
            <table id="practice_wrapper" class="table table-bordered table-striped" style="padding-top:500px">
                <thead>
                    <th style="width: 10%">ID</th>
                    <th style="width: 20%">Genre</th>
                    <th style="width: 20%">Parent ID</th>
                    <th style="width: 20%">Action</th>
                </thead>
                <tbody>	
                    @foreach ($data as $t)
                    <tr>
                        <td>{{$t->genre_id}}</td>
                        <td>{{$t->genre}}</td>
                        <td>{{$t->parent_id}}</td>
                        <td>
                             <a href="javascript:void(0)" class="edit_gen btn btn-xs btn-primary" data-id="{{$t->genre_id}}" data-genre="{{$t->genre}}" data-parent="{{$t->parent_id}}" >Edit</a>
                             <a href="{{url('genres/delete/'.$t->genre_id)}}" class="btn btn-xs btn-danger">Delete</a>
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
    $('.edit_gen').click(function(){
        console.log('here');
        $('#selected_id').val($(this).data('id'));
        $('#t_genre').val($(this).data('genre'));
        $('#t_parent').val($(this).data('parent'));
       
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