@extends('master.menu')

@section('menucontent')
<div id="admin-main-control" class="col-md-10 p-x-3 p-y-1">
    <div class="content-title m-x-auto">
        <i class="fa fa-dashboard"></i> Validando Minhas URL
        <button type="button" id='validar' class="btn btn-primary mt-2 float-end">INICIAR A VALIDAÇÃO</button>
        <button type="button" id='paravalidar' class="btn btn-danger mt-2 float-end" style='right:10px;top:10px;position:fixed;display:none'>INTERROMPE VALIDAÇÃO</button>
    </div>
    <p class='display-6'>
    <table class='table' id='tAnalise'>
        <thead>
            <th>Id</th>
            <th>Url</th>
            <th>Registrado em</th>
            <th>Atualizado em</th>
            <th>Status Code</th>
            <th>Corpo</th>
            <th>Analise</th>
        </thead>
        <tbody>
            @foreach ($listado as $v)
                <tr class='tvalidar' u="{{ $v['description'] }}" i="{{ $v['id'] }}" id="r{{ $v['id'] }}">
                    <td>{{ $v['id'] }}</td>
                    <td>{{ $v['description'] }}</td>
                    <td>{{ $v['dia'] }}</td>
                    <td id="a{{ $v['id'] }}">{{ $v['atualiza'] }}</td>
                    <td id="s{{ $v['id'] }}">{{ $v['statuscode'] }}</td>
                    <td id="n{{ $v['id'] }}"></td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    </p>
</div> <!-- /#admin-main-control -->
@endsection
