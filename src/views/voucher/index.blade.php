@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- booking::voucher.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aoColumnDefs': [
                        { 'bSortable': false, 'aTargets': [7,8]},
                        { 'sClass': 'checkbox-column', 'aTargets': [7]},
                        { 'sClass': 'align-center', 'aTargets': [5,8]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- booking::voucher.index -->
@stop

@section('headButtons')
    @if($viewParameters['newButton'])
        <a class="btn margin-b10 margin-l10" href="{{ route('createBookingVoucher', ['offset' => 0, 'bulk' => 1]) }}"><i class="fa fa-bolt"></i> {{ trans('booking::pulsar.vouchers_bulk_create') }}</a>
    @endif
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
    <!-- /.booking::voucher.index -->
@stop