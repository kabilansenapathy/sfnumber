<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
    

}
