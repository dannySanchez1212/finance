
@extends('layouts.app')
@section('title', trans('dictionary.gocardless'))
@section('content')
<section class="admin-users-section">
    <div class="container">
        <div class="admin-users-section-bg" style="text-align: center;">
            <!-- Admin Users Header Area Starts Here -->
            <div class="admin-users-section-header">
                <div class="row">
                    <div >
                        <h2>@lang('Payments Expected The Following 6 Days :')</h2>
                    </div>
                </div>
            </div> 
            <hr />
        <div class="admin-users-section-bg">
            <!-- Admin Users Header Area Starts Here -->
            <div class="admin-users-section-header">
                <div class="row">
                    <div >
                            <!-- Admin Users Header Area Starts Here -->                      
                          

                            <ul class="nav navbar-nav">
                                    
                                    <td class="text-center">
                                          <BIG> <b> <th>  
                                                @foreach($DiasFinal as $key => $Nom) 
                                                                 

                                                                    
                        <button onclick="location.href='/UserConsulta/{{$Fecha[$key]}}/{{$Nom}}/{{$key}}';" id="btn-filter" class="btn btn-primary waves-effect waves-light m-b-25"> {{$Nom}} {{$ContDiasF[$key]}} </button>

                                                        @endforeach




                                                    </th>

                                                 
                                           </b> 
                                       </BIG> 
                                    </td>
                                        

                            </ul>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</section>
@endsection