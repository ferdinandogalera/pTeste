@extends('master.menu')

@section('menucontent')
<div id="admin-main-control" class="col-md-10 p-x-3 p-y-1">
    <div class="content-title m-x-auto">
        <i class="fa fa-dashboard"></i> Incluir URL
    </div>
    <div id='bURL'>
    <p class="text-primary">Separe os links por (,) (;) ou (ENTER) quando for +1
    <p >
    <form id='fURL' method="post" action="" >
        {!! csrf_field() !!}
        
    <textarea style='font-size:14px'  rows="10" cols="80" id='tURL' name='tURL'></textarea>
    </p>
    <p>
    
    <button type="button" id='registro' class="btn btn-primary mt-2 float-end">Registrar</button>
    
    </form>
    </p>
    </div>
    <div style='display:none' id='aviso'></div>
</div> <!-- /#admin-main-control -->

@endsection
