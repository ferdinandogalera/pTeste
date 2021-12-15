@extends('master.menu')

@section('menucontent')
<div id="admin-main-control" class="col-md-10 p-x-3 p-y-1">
    <div class="content-title m-x-auto">
        <i class="fa fa-dashboard"></i> Lista de Minhas URL
    </div>
    <p class='display-12'>
    <table class='table' id='table_id'>
        <thead>
            <th>Id</th>
            <th>Url</th>
            <th>Valido</th>
            <th>Opções</th>
        </thead>
        <tbody>
            @foreach ($listado as $t)
                <tr id='tr{{ $t[0] }}'>
                    <td>{{ $t[0] }}</td>
                    <td><a href="{{ $t[1] }}" target=_blank>{{ $t[1] }}</a></td>
                    @if ($t[2] == "Sim")
                       <td class='bg-success text-white'>{{ $t[2] }}</td>
                    @else
                       <td class='bg-danger text-white'>{{ $t[2] }}</td>
                    @endif
                    
                    <td>
                        <a href="#" class='btn btn-primary apaga' i="{{ $t[0] }}">Remover</a>
                        <a href="https://check-host.net/check-ping?host={{ $t[1] }}" target=_blank class='btn btn-primary ml=2 pinga'>Ping</a>
                        <a href="https://check-host.net/ip-info?host={{ $t[1] }}" target=_blank class='btn btn-primary ml=2 pinga'>Info</a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
    </p>
</div> <!-- /#admin-main-control -->
@endsection
