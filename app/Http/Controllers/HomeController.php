<?php

namespace App\Http\Controllers;
use App\Models\taburls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DOMDocument;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lista()
    {

        $userid = Auth::user()->id;

        $data = taburls::select("id","description","valido")
        ->orderBy("created_at","desc")
        ->where("userid", "=", $userid)
        ->get();
        $t = array();
        foreach ($data as $k => $v) { 
            $s = ($v['valido'] == "0") ? "Não" : "Sim";
            $t[] = array($v['id'],$v['description'],$s);
        }    
        return view('lista', ['listado' => $t]);
    
    }

    public function validar()
    {
        $userid = Auth::user()->id;

        $data = taburls::select("id","description","valido", 
        taburls::raw("DATE_FORMAT(created_at,'%d-%m-%Y %H:%i') as dia"),
        "statuscode",
        taburls::raw("DATE_FORMAT(updated_at,'%d-%m-%Y %H:%i') as atualiza"))
        ->orderBy("created_at","desc")
        ->where("userid", "=", $userid)
        ->get();
        return view('validar', ['listado' => json_decode($data,true)]);
    }

    public function remover(Request $request) 
    {
        $userid = Auth::user()->id;
        $idreg = $request["id"];
        taburls::where("id","=",$idreg)->where("userid","=",$userid)->delete();
        return true;
    }

    public function gravar(Request $request) {
        $bids = $request;
        $userid = Auth::user()->id;
        $b = str_replace("\r\n","",$bids['tURL']);
        $www = substr($b,0,3);
        if ($www!="www" and $www!="htt") {
            $b = "http://www.".$b;
        }   
        $url = parse_url( $b ) ;
        if (!isset($url['scheme'])) {
            if ($www!="htt") {
               $b = "http://".$b;
            }
        }   
        $file_headers = @get_headers($b);
        $exists = (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'|| $file_headers === false) ? 0 : 1;
        $horario = date("Y-m-d H:i:s");
        $horario2 = date("d-m-Y H:i:s");
        $existis = ($exists=="0") ? "404" : "200";
        if ($bids['f']=="1") {
           taburls::insertOrIgnore(['description' => $b, 'userid' => $userid, "valido" => $exists ]);
        } else { 
           taburls::where('id', "=", $bids['id'])
           ->update(['updated_at' => $horario, 'statuscode' => $existis]);
        }
        return ["statuscode" => $existis, "hora" => $horario2];
    }

    
}
