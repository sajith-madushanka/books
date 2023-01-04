@extends('layout.master')
@section('content')
<section class="content asd">
    <div class="box box-danger">
        <div class="box-header" style="padding:20px 0px 0px 10px"><span class="header-text"><h3>New Author</h3></span></div>
        <div class="box-body">
            <form action="{{url('authors/add')}}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                <div class="col-md-3">
                    <label>First Name</label>
                    <input type="text" class="form-control" id="t_f" name="f_name">
                </div>
                <div class="col-md-3">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" id="t_m" name="m_name">
                </div>
                <div class="col-md-3">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="t_l" name="l_name">
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
                    <th style="width: 10%">ID</th>
                    <th style="width: 20%">First Name</th>
                    <th style="width: 20%">Middle Name</th>
                    <th style="width: 20%">Last Name</th>
                    <th style="width: 20%">Action</th>
                </thead>
                <tbody>	
                    @foreach ($data as $t)
                    <tr>
                        <td>{{$t->author_id}}</td>
                        <td>{{$t->first_name}}</td>
                        <td>{{$t->middle_name}}</td>
                        <td>{{$t->last_name}}</td>
                        <td>
                             <a href="javascript:void(0)" class="edit_auth btn btn-xs btn-primary" data-id="{{$t->author_id}}" data-f="{{$t->first_name}}" data-m="{{$t->middle_name}}" data-l="{{$t->last_name}}" >Edit</a>
                             <a href="{{url('authors/delete/'.$t->author_id)}}" class="btn btn-xs btn-danger">Delete</a>
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