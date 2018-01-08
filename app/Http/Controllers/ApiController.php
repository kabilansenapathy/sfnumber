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

        $all = DB::table('sfdetails')->select('village')->distinct()->get();
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

    public function getSfResult($village,$sfno){
// print_r("in get type");
         $all = DB::table('sfdetails')
         ->select('*')
         //->where('taluk', $taluk)
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
        $village_name = array();
        $village_value = array();
        $i = 0;
        $response = $client->request('GET', 'getvillage.asp?q='.$srocode.'&tams=');
        $response_body = $response->getBody();
        $dom = new \DOMDocument;
        $dom->loadHTML($response_body);
        $options = $dom->getElementsByTagName('option');
        $v = new village();
        $v->vill_name = "Coimbatore";
        $v->vill_value = "1";
        foreach($options as $option){
            // echo $option->nodeValue, PHP_EOL;
             //array_push($village_name, array($option->nodeValue=>$option->getAttribute('value')));
             array_push($village_name, array('value'=>$option->getAttribute('value')));
             //array_push($village_value, $option->getAttribute('value'));
        // echo $village_value[$i];
         $i++;
         
            // echo $option->getAttribute('value'), PHP_EOL;
         }
         //$json_village = array_merge($village_name);
         //json_encode(array('value'=>$json_village), JSON_FORCE_OBJECT);
//return $json_village;
     
     

     return $village_name;
     
     
    // echo $response_body;
// echo $village_name;
}

public function getChitta(){

    $client = new Client();
    $res = $client->request('GET', 'http://eservices.tn.gov.in/eservicesnew/land/chitta.html?lan=en');

    $response = $client->request('POST', 'http://eservices.tn.gov.in/eservicesnew/land/chittaCheck_en.html?lan=en', [$res->getHeaders(),
    'form_params' => [
       'task' => 'chittaEng',
       'districtCode' => '12',
       'areaType' => 'urban'
   ]]);
   $response_body = $response->getBody();
   $dom = new \DOMDocument;
   $internalErrors = libxml_use_internal_errors(true);
   $dom->loadHTML($response_body);
   libxml_use_internal_errors($internalErrors);
    $images = $dom->getElementsByTagName('img');
$i=0;
foreach($images as $image){
    $i++;
    if($i==3){
    echo $image->getAttribute('src'), PHP_EOL;
         define('DIRECTORY', 'img');
         $image = file_get_contents("http://eservices.tn.gov.in/eservicesnew/land/simpleCaptcha.html");
         file_put_contents(DIRECTORY . '/image.jpg', $image);
         echo $image;
    }
}

}

 }
    class village
        {
            public $vill_value = "";
            public $vill_name = "";
        }
    
    
    

