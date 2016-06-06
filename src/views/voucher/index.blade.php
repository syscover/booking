@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- booking::voucher.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'displayStart' : {{ $offset }},
                    'columnDefs': [
                        { 'sortable': false, 'targets': [7,8]},
                        { 'class': 'checkbox-column', 'targets': [7]},
                        { 'class': 'align-center', 'targets': [5,8]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
                }).fnSetFilteringDelay();
            }

            $('#advancedSearchContent').hide();
            $('.advanced-search').on('click', function(){
                $('#advancedSearchContent').toggle("slow");
            });
        });
    </script>
    <!-- /booking::voucher.index -->
@stop

@section('headButtons')
    @if($viewParameters['newButton'])
        <a class="btn margin-b10 margin-l10" href="{{ route('createBookingVoucher', ['offset' => 0, 'bulk' => 1]) }}"><i class="fa fa-bolt"></i> {{ trans('booking::pulsar.vouchers_bulk_create') }}</a>
    @endif
    <a class="btn margin-b10 margin-l10 advanced-search"><i class="fa fa-search"></i> {{ trans('pulsar::pulsar.advanced_search') }}</a>

    <div class="row" id="advancedSearchContent">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="fa fa-reorder"></i> {{ isset($customTransHeader)? $customTransHeader : trans_choice($objectTrans, 2) }}</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <form id="recordForm" class="form-horizontal" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                @include('pulsar::includes.html.form_text_group', [
                                    'labelSize' => 4,
                                    'fieldSize' => 4,
                                    'label' => 'ID',
                                    'name' => 'id',
                                    'value' => null
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('pulsar::includes.html.form_text_group', [
                                    'labelSize' => 4,
                                    'fieldSize' => 6,
                                    'label' => trans_choice('pulsar::pulsar.date', 1),
                                    'name' => 'date',
                                    'value' => null
                                ])
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn margin-r10">{{ trans('pulsar::pulsar.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('tHead')
    <!-- booking::voucher.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-class="expand">{{ trans('pulsar::pulsar.prefix') }}</th>
        <th>{{ trans_choice('booking::pulsar.campaign', 1) }}</th>
        <th data-hide="phone">{{ trans_choice('pulsar::pulsar.name', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.price', 1) }}</th>
        <th>{{ trans('pulsar::pulsar.paid') }}</th>
        <th>{{ trans_choice('pulsar::pulsar.cost', 1) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /booking::voucher.index -->
@stop