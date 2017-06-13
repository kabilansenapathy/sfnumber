<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;
use parser\htmlparser;

class ApiController extends Controller
{

    public function getData($value1,$value2){

             $all = DB::table('sfdetails')
                //->where('id', $value1)
                ->where('taluk', 'singanallur')
                ->where('village_no', $value2)
                ->get();
    return $all;
      //  return view('api', ['value' => $value]);

    }

    public function getCity(){

        $all = DB::table('sfdetails')->select('taluk')->distinct()->get();
        // $all = DB::table('sfdetails')
        //     ->distinct('taluk')
        //     ->get();
            return $all;


    }

    public function getVillage($value3){

         $all = DB::table('sfdetails')
         ->select('village')
         ->where('taluk', $value3)
         ->distinct()
         ->get();
        
            return $all;
    }
public function getType($taluk,$village,$sfno){
// print_r("in get type");
         $all = DB::table('sfdetails')
         ->select('*')
         ->where('taluk', $taluk)
         ->where('village', $village)
         ->where('sfno', $sfno)
         ->distinct()
         ->get();
        
            return $all;
    }

    public function ecVillage($srocode){
        $client = new Client([
            'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'Referer' => 'http://ecview.tnreginet.net/',
            'Upgrade-Insecure-Requests' => '1',
            'Origin' => 'http://ecview.tnreginet.net',
            'Host' => 'ecview.tnreginet.net',
            'DNT' => '1',
            'Cookie' => 'ASPSESSIONIDCARRTCBT=LKODPEBADMGFGPGMLIFHCFMM; __utma=125245519.718034216.1491044201.1494311434.1494315413.6; __utmc=125245519; __utmz=125245519.1494315413.6.6.utmcsr=bing|utmccn=(organic)|utmcmd=organic|utmctr=tnreginet.net',
            'Content-Type' => 'application/x-www-form-urlencoded',
            // 'Content-Length' => '406',
            'Cache-Control' => 'max-age=0',
            'Accept-Language' => 'en-US,en;q=0.8',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8 ',
            ],
            'base_uri' => 'http://ecview.tnreginet.net/',
            'timeout' => 10.0,
        ]);

        $response = $client->request('GET', 'getvillage.asp?q='.$srocode.'&tams=');
        $response_body = $response->getBody();
        // $response_body = trim($response_body, "<select name='villagesel' id='villagesel' >option value=''>" );

        // $response_body = trim($response_body, "Select Village");
        // $response_body = trim($response_body, "</select>" );
        //$response_body = strip_tags($response_body, '<option>');
        
        
        echo $response_body;
    //    foreach ($response->getHeaders() as $name => $values) {
    // echo $name . ': ' . implode(', ', $values) . "\r\n";
}
    }
    
    
    

