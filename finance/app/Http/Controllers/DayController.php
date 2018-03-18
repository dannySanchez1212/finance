<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Tenancy;
use App\Day;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayController extends Controller
{


     
    public function index()
    {  $cant=0;     


            
            $diaini=Carbon::now()->format('d');
            $diafin=Carbon::now()->addDay(6)->format('d');
            $mes=Carbon::now()->format('m');

                $day=DayController::fecha();                          

            if ($diafin>$day) {
                 $diafin=$diafinfin-$dia;
                $mesfi=$mes+1;

                $cont=DB::table('tenancies')->whereMonth('next_payment_date', '>=',$mes)->whereMonth('next_payment_date', '>=',$mesfi)->whereDay('next_payment_date', '>=', $diaini)->whereDay('next_payment_date', '<=', $diafin)->count();

            } else {

               $cont=DB::table('tenancies')->whereMonth('next_payment_date', '=',$mes)->whereDay('next_payment_date', '>=', $diaini)->whereDay('next_payment_date', '<=', $diafin)->count();
            }   
               



                  return view( "paymentsday.index",compact('cont', $cont));
                   

           }



    public function fecha(){
                
           $month = date('m');
            $year = date('Y');
            $day = date("d", mktime(0,0,0, $month+1, 0, $year));


                return $day;
    }

}
