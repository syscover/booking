@extends('pulsar::layouts.index')

@section('head')
    @parent
    <!-- booking::voucher.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    "displayStart": {{ $offset }},
                    "sorting": [[0, 'desc']],
                    "columnDefs": [
                        { "visible": false, "searchable": false, "targets": [2,4]}, // hidden column 1 and prevents search on column 1
                        { "visible": false, "searchable": true, "targets": [8]},
                        { "dataSort": 2, "targets": [3] }, // sort column 2 according hidden column 1 data
                        { "dataSort": 4, "targets": [5] }, // sort column 2 according hidden column 1 data
                        { "sortable": false, "targets": [10,11]},
                        { "class": "checkbox-column", "targets": [10]},
                        { "class": "align-center", "targets": [11]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('jsonData' . ucfirst($routeSuffix)) }}",
                        "type": "POST",
                        "headers": {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- /booking::voucher.index -->
@stop

@section('tHead')
    <!-- booking::voucher.index -->
    <tr>
        <th data-class="expand">ID</th>
        <th>{{ trans_choice('pulsar::pulsar.status', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.date', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.date', 1) }}</th>
        <th>{{ trans('booking::pulsar.check_in_date') }}</th>
        <th>{{ trans('booking::pulsar.check_in_date') }}</th>
        <th>{{ trans_choice('booking::pulsar.establishment', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.name') }}</th>
        <th>Prefix</th>
        <th data-hide="phone,tablet">{{ trans_choice('booking::pulsar.voucher', 2) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /booking::voucher.index -->
@stop