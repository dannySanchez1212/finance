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
                        <h2>@lang('dictionary.tenancies')</h2>
                    </div>
                </div>
            </div> 
            <hr />
            <div class="admin-users-section-body">
                <div class="admin-users-table">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <div class="general-registration-bottom">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <button id="btn-filter" class="btn btn-primary waves-effect waves-light m-b-25">Show Only Arrears</button>
                                        </div>
                                    </div>
                                </div> 
                                <table id="datatableTenancies" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('dictionary.id')</th>
                                            <th>@lang('dictionary.amount')</th>
                                            <th>@lang('dictionary.rent-payment-reference')</th>
                                            <th>@lang('dictionary.deposit-payment-reference')</th>
                                            <th>@lang('dictionary.holding-deposit-payment-reference')</th>
                                            <th>@lang('dictionary.property-full-address')</th>
                                            <th>@lang('dictionary.last-paid')</th>
                                            <th>@lang('dictionary.match')</th>
                                            <th>@lang('dictionary.edit')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tenancies as $tenancy)
                                            <tr @php echo  $tenancy->err==true ? 'class="rowRed"' : '' @endphp>
                                                <td>{{ $tenancy->id }}</td>
                                                <td>{{ $tenancy->total_rent_amount }}</td>
                                                <td>{{ $tenancy->rent_payment_reference }}</td>
                                                <td>{{ $tenancy->deposit_payment_reference }}</td>
                                                <td>{{ $tenancy->holding_deposit_payment_reference }}</td>
                                                <td>{{ $tenancy->property_full_address }}</td>
                                                <td>{{ $tenancy->last_paid }}</td>
                                                <td>{{ $tenancy->match }}</td>
                                                <td class="text-center">
                                                    {!! Form::open(['method' => 'get', 'route' => ['tenancies.edit', $tenancy->id]]) !!}
                                                        <button class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-edit"></i> </button>
                                                    {!! Form::close() !!}
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
</section>

@endsection

@push('scripts')
  <script type="text/javascript">
        var table = $('#datatableTenancies').DataTable();
        $('#btn-filter').on('click',function(){
            if($('#btn-filter').html()=='Show Only Arrears'){
                $('#btn-filter').html('Show All');
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                      return $(table.row(dataIndex).node()).hasClass('rowRed');
                    }
                );
                table.draw();
            }
            else{
                $('#btn-filter').html('Show Only Arrears');
                $.fn.dataTable.ext.search.pop();
                table.draw();   
            }
        });
    
  </script>
@endpush
