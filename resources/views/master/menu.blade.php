@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style='width:100vw'>
            <div class="card">
                <div class="card-header">{{ __('Cadastro URL') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<head>
    <title>PROJETO AVALIAÇÃO</title> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">    
            <div id="admin-sidebar" class="col-md-2 p-x-0 p-y-3">
                <ul class="sidenav admin-sidenav list-unstyled">
                    <li><a href="{{ route('home') }}">Incluir</a></li>
                    <li><a href="{{ route('listando') }}">Lista</a></li>
                    <li><a href="{{ route('validando') }}">Validar </a></li>
                </ul>
            </div> <!-- /#admin-sidebar -->
            @yield('menucontent')
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>    
    <script type="text/javascript">
        var parar = 0 ;
        var paratudo = 0;
        xhr_all = [];

        $(document).ready(function() {
            $('#table_id').DataTable();
            $(document).on( "click", "#paravalidar", function() {
                parar = 1;
                $("#paravalidar").hide();
                $("#validar").show();
                return true;
            });


            function ajaxFetch(u,i) {
                var XHR = $.post({
                    url: "{{ route('gravando') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tURL : u,
                        id: i,
                        f:2
                    },
                    cache: false,
                    async: true,
                    success: function (data) {
                        console.log(parar + " => "+i);
                        var cor = (data['statuscode']==200) ? 'green' : 'red';
                        $("#s"+i).html(data['statuscode']).css("color",cor);
                        $("#a"+i).html(data['hora']).css("color",'blue');
                        
                        window.scrollTo(0, $("#r"+i).offset().top-100);
                        if (parar==1) { 
                            clearTimeout(paratudo);
                            for (var xxi = 0; xxi < xhr_all.length; xxi++) {
                                console.log(xxi);
                                xhr_all[xxi].abort();
                            }
                            alert("Processo Interrompido");
                            
                            return false;
                        }
                    }
                });
                xhr_all.push(XHR);
            }



            
            $(document).on( "click", "#validar", function(e) {
                parar = 0; 
                $("#validar").css("display","none");
                $("#paravalidar").css("display","");
                var t = $("#tURL").val();
                var x = 1;
                $( ".tvalidar" ).each(function() {
                    var i = $(this).attr("i");
                    if (parar == 0) {
                        var u = $(this).attr("u");
                        $("#s"+i).html("");
                        $("#a"+i).html("");
                        paratudo = setTimeout(function() {
                            ajaxFetch(u,i,parar)
                        }, 20 ); // change delay from 20 -> 20 * x
                        x = x + 1;
                    } else { 
                        return true;
                    }
                });
            });    

            $(document).on( "click", "#registro", function() {
                var t = $("#tURL").val();
                if (t=="") {
                    alert("Por favor preencha com valores validos conforme solicitado");
                    return false;
                }
                t = t.replace(";","\n");
                t = t.replace(",","\n");
                var it3 = t.split("\n");
                
                if (it3.length==0) {
                    alert("Não conseguimos reconhecer os links informado, separe por virgula,ponto e virgula ou enter");
                    return false;
                }
                var tit = "";
                $("#bURL").hide();
                if (window.confirm("Confirma os dados?")) {
                    for (i=0;i<=it3.length;i++) {
                        if (it3[i]!="" && it3[i]!=undefined) {
                            console.log(it3[i]);
                            tit = it3[i];
                            $("#aviso").html("").show().html("Processando: <b>"+i+"/"+it3.length+"</b><br><h1>"+tit+"</h1>");
                            $.ajax({
                                url: "{{route('gravando')}}",
                                type: "POST",
                                async: true,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    tURL : tit,
                                    f:1
                                },
                                success: function(data){

                                }
                            });
                            
                        } else { 
                            $("#aviso").html("");
                            alert("Verifique na opção LISTA os link incluidos");
                            $("#bURL").show();
                            $("#tURL").val("");
                            break;
                        }
                    }

                } else { 
                    $("#bURL").show();

                }
            }); 
            function sleepFor(sleepDuration){
                var now = new Date().getTime();
                while(new Date().getTime() < now + sleepDuration){ /* Do nothing */ }
            }
            $(document).on( "click", ".apaga", function() {
               var t = $(this).attr("i");
               if (window.confirm("Confirma a exclusão do registro: [["+t+"]] ?")) {
                    $.ajax({
                        url: "{{route('removendo')}}",
                        data: {
                            id : t
                        },
                        success: function(data){
                            $("#tr"+t).fadeOut("slow").html("");
                        }
                    });
                }
            });


        });
    </script>            
</body>
            </div>
        </div>
    </div>
</div>

@endsection
