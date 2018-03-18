@extends('layouts.app')

@section('title', trans('dictionary.gocardless'))

@section('content')
<section class="admin-users-section">
    <div class="container">
        <div class="admin-users-section-bg">
            <!-- Admin Users Header Area Starts Here -->
            <div class="admin-users-section-header">
                <div class="row">
                    <div class="col-sm-3">
                        
                            <ul class="nav navbar-nav">
                                    
                                    
                                        <right>
                                            
                                           <big>  
                                        @lang('Payments Expected The Following 6 Days :')
                                            
                                            <b>
                                            <a style="width: 100%;">                               
                                                {{  $cont }}   </a>
                                           </b></big>
                                        </right>

                               </ul>                   

                    </div>
                </div>
            </div> 
        </div>  
    </div>
</section>

@endsection