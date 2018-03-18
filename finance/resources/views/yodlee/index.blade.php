@extends('layouts.app')

@section('title', trans('dictionary.gocardless'))

@section('content')
<section class="admin-users-section">
    <div class="container">
        <div class="admin-users-section-bg">
            <div class="admin-users-section-header">
                <div class="row">
                    <div class="col-sm-3">
                        <h2>@lang('dictionary.feeds') > @lang('dictionary.yodlee')</h2>
                    </div>
                </div>
            </div> 
            <hr />
            <div class="admin-users-section-body">
                <div class="admin-users-table">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="datatableYodlee" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('dictionary.id')</th>
                                            <th>@lang('dictionary.amount')</th>
                                            <th>@lang('dictionary.tenancy-id')</th>
                                            <th>@lang('dictionary.date')</th>
                                            <th>@lang('dictionary.edit')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ json_decode($transaction->amount)->amount }} {{ json_decode($transaction->amount)->currency }}</td>
                                                <td>{{ $transaction->tenancy_id }}</td>
                                                <td>{{ $transaction->date }}</td>
                                                <td class="text-center">
                                                    {!! Form::open(['method' => 'get', 'route' => ['yodlee.edit', $transaction->id]]) !!}
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
        $('#datatableYodlee').dataTable();
  </script>
@endpush