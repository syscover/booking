@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- booking::product_prefix.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'displayStart' : {{ $offset }},
                    'columnDefs': [
                        { 'sortable': false, 'targets': [3,4]},
                        { 'class': 'checkbox-column', 'targets': [3]},
                        { 'class': 'align-center', 'targets': [4]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- booking::product_prefix.index -->
@stop

@section('tHead')
    <!-- booking::product_prefix.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-hide="phone">{{ trans_choice('pulsar::pulsar.product', 1) }}</th>
        <th>{{ trans('pulsar::pulsar.prefix') }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /.booking::product_prefix.index -->
@stop