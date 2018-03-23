@extends('layouts.app')

@section('title', trans('dictionary.gocardless'))

@section('content')
<section class="admin-users-section">
    <div class="container">
        <div class="admin-users-section-bg">
            <!-- Admin Users Header Area Starts Here -->
            <div class="admin-users-section-header">
                <div class="row">
                    <div >
                      
                        

                            <button onclick="location.href='/paymentsday';" id="btn-filter" class="btn btn-primary waves-effect waves-light m-b-25">Return</button>
                                     <BIG><b><center><th><a href="" style="width: 100%;">{{$Nom}} {{$Fecha}}</a></th></center></b></BIG>
                                        
                    <div class="row">
                        <div class="col-sm-12">
                      <div class="table-responsive">
                        <table id="datatableTenancies" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('dictionary.id')</th>
                                            <th>@lang('dictionary.amount')</th>
                                          <th>@lang('dictionary.rent-payment-reference')</th>
                                            <th>@lang('dictionary.deposit-payment-reference')</th>
                                            <th>@lang('dictionary.holding-deposit-payment-reference')</th>
                                            <th>@lang('dictionary.property-full-address')</th>                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($UserDia as $UserDias)
                                          
                                          <tr @<?php echo $UserDias->id==false ? 'class="rowRed"' : ''  ?> >
                                                <td>{{ $UserDias->id }}</td>
                                                <td>{{ $UserDias->total_rent_amount }}</td>
                                                <td>{{ $UserDias->rent_payment_reference }}</td>
                                                <td>{{ $UserDias->deposit_payment_reference }}</td>
                                                <td>{{ $UserDias->holding_deposit_payment_reference }}</td>
                                                <td>{{ $UserDias->property_full_address }}</td>                                                
                                                <td class="text-center">

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                             </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</section>

@endsection