<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\taburls;

class ExampleCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Veririca URL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = taburls::select("id","description")
        ->orderBy("created_at","desc")
        ->get();
        $horario = date("Y-m-d H:i:s");
        foreach ($data as $k => $v) { 
            $b = str_replace("\r\n","",$v['description']);
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
            $existis = ($exists=="0") ? "404" : "200";
            taburls::where('id', "=", $v['id'])
                    ->update(['updated_at' => $horario, 'statuscode' => $existis]);
        }    
        return 0;
    }
}
