<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Tenancy;
use App\Day;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FechaController extends Controller
{
     
    public function index( $Fecha , $ContDiasF , $DiasFinal)
    {


    	//dd($ContDiasF);


    	//return view( "paymentsday.index");
    }


}