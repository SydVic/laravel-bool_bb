<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LengthException;
class ApartmentsViewController extends Controller
{
    // public function index($id){

    //     $c = View::select(DB::raw("Year(date) as year"))
    //     ->where('apartment_id','=',$id)
    //     ->groupBy('year')
    //     ->get();
    //     $data = [];

    //     foreach($c as $row) {
    //       $data['anno'][] = $row->year;
    //     }
    
    //     $prova=$data['anno'];
        
    //     return view('user.visual.views',compact('prova','id'));
    // }









    public function index($id){

    $c = View::select(DB::raw("Year(date) as year"))
    ->where('apartment_id','=',$id)
    ->groupBy('year')
    ->get();
    $data = [];

    foreach($c as $row) {
          $data['anno'][] = $row->year;
      }
    
       $anno=$data['anno'];
               /////////////////////////////////////////////// Calcolo e ordiamento dei mesi di uno specifico anno 
        ///////////////////////////////////////////////
      for($d=0; $d<count($anno); $d++){
        $c = View::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(date) as monthname"))
        ->where('apartment_id','=',$id)
        ->whereYear('date', date($anno[$d]))
        ->groupBy('monthname')
        ->get();
       
        $data = []; 
        foreach($c as $row) {
        $data['label'][] = $row->monthname;
        $data['data'][] = (int) $row->count;
        }
        // dd($data['label']);
        $i = 0;
        $prova['mese'] = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $prova['valore'] =[0,0,0,0,0,0,0,0,0,0,0,0];
        $prova['mNumero'] =['01','02','03','04','05','06','07','08','09','10','11','12'];
        $prova['gNumero'] = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $prova['valoreg'] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
          $k = 0;
          $bool = false;
    
          while($k < 12){
            $i = 0;
           
            for($i=0; $i < count($data['label']); $i++){
            if($data['label'][$i] == $prova['mese'][$k]){
              $prova['valore'][$k] = $data['data'][$i];
              // $bool = true;
             }
            }
          $k++;
        }
          $nomea = 'anno_'.$anno[$d];
          
         $annom[$nomea] = $prova['valore'];
        for($i=0; $i < count($prova['mese']); $i++){
          $prova['valoreg'] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
         $c = View::select(DB::raw("(COUNT(*)) as count"),DB::raw("DAY(date) as dayname"))
         ->where('apartment_id','=',$id)
         ->whereMonth('date','=',$prova['mNumero'][$i])
         ->whereYear('date', date($anno[$d]))
         ->groupBy('dayname')
         ->get();
          // dd($c);
        $giorno = []; 
        foreach($c as $row) {
        $giorno['day'][] = (int) $row->dayname;
        $giorno['data'][] = (int) $row->count;
        }
         $f=0;
      //  dd($giorno['day'][0]);
        if(! empty($giorno['day'])){
        while($f < 31){
          for($b=0; $b < count($giorno['day']); $b++){
          if($giorno['day'][$b] == $prova['gNumero'][$f]){
            $prova['valoreg'][$f] = $giorno['data'][$b];
            // $bool = true;
           }
          }
        $f++;
       }
      }
      $nomem = 'anno_'.$anno[$d].'_mese_'.$prova['mese'][$i];
      
      $annom[$nomem] = $prova['valoreg']; 
      }
      }
   
        
      //  $data['chart_data'] = json_encode($data);
        //////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////
       return view('user.visual.views',compact('anno'),$annom);
    }
}
