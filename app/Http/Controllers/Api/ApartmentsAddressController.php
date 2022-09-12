<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsAddressController extends Controller
{

    public static function index($prova) {
        $result = strstr($prova, ',', true);
        $url = Http::get('https://api.tomtom.com/search/2/geocode/'. $result.'.json?storeResult=true&language=it-IT&view=Unified&key=H97FXaSDT7RHiYR8ApDuoF894E4WPAXv');
        $coord = $url->getBody();
        $coord = json_decode($url, true);
        if($coord['results']!= []){
            return $link=$coord['results'][0]['position'];;
        }else{
        $i=0;
        $bool = false;
        $assembarray= [];
        $truncatearray = explode(" ",$result);
        while(! $bool || $i >= count($truncatearray) ){
            if( ( is_numeric( $truncatearray[$i]) || $i = 3 ) ){
                $bool=true;
                $assembarray[$i]=$truncatearray[$i];
            }else{
                dd('eccomi');
                $assembarray[$i]=$truncatearray[$i];
                $i++;
            }
        }
        $finalmente = implode(" ",$assembarray);
        $url = Http::get('https://api.tomtom.com/search/2/geocode/'. $finalmente.'.json?storeResult=true&language=it-IT&view=Unified&key=b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA');
        $coord = $url->getBody();
        $coord = json_decode($url, true);
        if($coord['results']!= []){
            return $link=$coord['results'][0]['position'];;
        }else{
        return $link= [
            'lat' => 3.3333,
            'lot' => 3.3333
        ];
        }
    }
    function truncateAddress($result){
    
        dd('funziona');
        $i=0;
        $bool=false;
        $truncatearray = explode(" ",$result);
        while($bool == true){
            dd('funziona');
            if((is_numeric($truncatearray[$i] ))){
                $bool=true;
                $assembarray[$i+1]=$truncatearray[$i+1];
            }else{
                $i++;
                $assembarray[$i]=$truncatearray[$i];
            }
    
        }
        
        return $finalmente=implode(" ",$assembarray);
    }
}
}
