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
     public function UserConsulta($Fecha,$Nom,$DiasFinal)
    {
            /////////DiasFinal  Posicion de ubicacion del dia

            //dd($Fecha);
                   if ($Nom=='Monday'&&$DiasFinal>=2) {

                        list($Y, $m,$d) = explode('-', $Fecha); 
                        $fechas=$d+2; 
                        $UserDia=DB::table('tenancies')->whereMonth('next_payment_date', '=',$m)->whereDay('next_payment_date', '>=', $d)->whereDay('next_payment_date', '<=', $fechas)->get();
                        $Fecha=$Y.'-'.$m.'-'.$fechas;
                       dd($Fecha);
                   } else {


                    if ($Nom=='Monday'&&$DiasFinal==1) {
                        list($Y, $m,$d) = explode('-', $Fecha);
                       $fechas=$d+2;
                        $UserDia=DB::table('tenancies')->whereMonth('next_payment_date', '=',$m)->whereDay('next_payment_date', '>=', $d)->whereDay('next_payment_date', '<=', $fechas)->get();
                        $Fecha=$Y.'-'.$m.'-'.$fechas;
                      
                        
                    } else {

                        $UserDia=DB::table('tenancies')->where('next_payment_date', '=',$Fecha)->get();
                    }
                    }

         return view( "paymentsmonth.index")->with(['UserDia'=> $UserDia, 'Nom'=>$Nom ,'Fecha'=>$Fecha]);
       
    }
    

    public function index()
    {  $cant=0;               
            $diaini=Carbon::now()->format('d');
            $diaValidar=Carbon::now()->format('d-m-Y');
            $diafin=Carbon::now()->addDay(8)->format('j');
            $diaValidarF=Carbon::now()->addDay(8)->format('m-d-Y');
            $mes=Carbon::now()->format('m');
             $day=DayController::fecha(); 
             $semana=DayController::Validar_dia($diaValidar);            
                                               

            if ($diafin>$day) {
                 $diafin=$diafinfin-$dia;
                $mesfi=$mes+1;

               
                            //$cont=DB::table('tenancies')->whereMonth('next_payment_date', '>=',$mes)->whereMonth('next_payment_date', '>=',$mesfi)->whereDay('next_payment_date', '>=', $diaini)->whereDay('next_payment_date', '<=', $diafin)->count();

                             $cont=DB::table('tenancies')->select('tenancies.next_payment_date')->whereMonth('next_payment_date', '>=',$mes)->whereMonth('next_payment_date', '>=',$mesfi)->whereDay('next_payment_date', '>=', $diaini)->whereDay('next_payment_date', '<=', $diafin)->groupBy('next_payment_date')->get();
            
                   } else {
             
                            $cont=DB::table('tenancies')->select('tenancies.next_payment_date')->whereMonth('next_payment_date', '=',$mes)->whereDay('next_payment_date', '>=', $diaini)->whereDay('next_payment_date', '<=', $diafin)->groupBy('next_payment_date')->get();
               //////////contando dias              


                     //$cont=DB::table('tenancies')->select('tenancies.id','tenancies.next_payment_date')->whereMonth('next_payment_date', '=',$mes)->whereDay('next_payment_date', '=', $diaini)->get();

                        //ORDER BY orderBy('tenancies.next_payment_date', 'asc')


            

                               $cont3=$cont->toarray();  

            
     
           foreach ($cont3 as $CONTS) {

              $ContDias[]=DayController::contar($CONTS->next_payment_date);  
               $Fecha[]=$CONTS->next_payment_date;
                }
                

                $DiasPropuestos=DayController::Calculo_D($cont3);

            

                 
                  // dd($DiasPropuestos);

                foreach ($DiasPropuestos as $key => $Dia) {
                    $keys=$key;
                        
                    if ($Dia=='Saturday') {                        
                      
                      $keys=$key+2;

                      foreach ( $DiasPropuestos as $value =>$busca ) {
                         
                         if($busca=='Monday'){
                               // dd($);
                               
                             $ContDiasF[$value-2]=$ContDias[$value-2]+$ContDias[$value-1]+$ContDias[$value];
                             break;

                         }

                      }                       
                       // $DiasFinal[]='Monday';
                      $keys=$key-2;
                         



                    } 


                    else {
                        
                        if ($Dia=='Sunday') {                            

                            $keys=$key+1;
                            foreach ( $DiasPropuestos as $value =>$busca ) {

                                        
                                     if($busca=='Monday'){

                                        $DiasFinal[]=$busca;
                                        
                                         }
                                         
                                      } 
                             
                            $keys=$key-1;
                                

                        } else {

                                if ($Dia=='Monday') {
                                   // dd($Dia);
                                   // $DiasFinal[]=$Dia;

                                     } else {                                
                                            
                                    $DiasFinal[]=$Dia;
                                    $ContDiasF[]=$ContDias[$key];
                                } 
                                }
                  }

                   
                }
                  //dd($DiasFinal);
                 

              }         
                    return view( "paymentsday.index")->with(['DiasFinal'=> $DiasFinal,'ContDiasF'=> $ContDiasF,'Fecha'=> $Fecha]);
                   
     }




    public function fecha(){
                
           $month = date('m');
            $year = date('Y');
            $day = date("j", mktime(0,0,0, $month+1, 0, $year));
                return $day;
        }



    function Validar_dia($diaSemana){ 

         //         

        $dia = array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
      
        $fecha = $dia[date('N', strtotime($diaSemana))]; 

          
        return $fecha;
    }



    function Calculo_D($diaSemana)
    {
           //dd($diaSemana); 
        foreach ($diaSemana as $dia) {
           
           
        $dias = array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
      
        $est=$dia->next_payment_date;
        $fecha[] = $dias[date('N', strtotime($est))];           

       }        
                
        return $fecha;

    }



    function contar($constante){ 

                   // dd($constante);
              $contan= DB::table('tenancies')->select('tenancies.next_payment_date')->where('next_payment_date', '=', $constante)->count();            

           // dd($contan);

       return $contan;
     }
    

}


    