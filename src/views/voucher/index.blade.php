@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- booking::voucher.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                var tableInstance = $('.datatable-pulsar').dataTable({
                    "displayStart": {{ $offset }},
                    "sorting": [[0, 'desc']],
                    "columnDefs": [
                        { "sortable": false, "targets": [7,8]},
                        { "class": "checkbox-column", "targets": [7]},
                        { "class": "align-center", "targets": [5,8]}
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


                $('#advancedSearchForm').submit(function (e) {
                    e.preventDefault();
                    var that = this;
                    tableInstance.fnSettings().ajax.data = function (parameters) {

                        var formValues = $(that).serializeArray();
                        parameters.advancedSerach = true;

                        //set here custom parameters
                        parameters.advancedSerachFields = [];
                        $(formValues).each(function(index, element){
                            parameters.advancedSerachFields.push(element);
                        });
                    };

                    // call to api datatable
                    $('.datatable-pulsar').DataTable().ajax.reload();
                });
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
                    <form id="advancedSearchForm" class="form-horizontal" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                @include('pulsar::includes.html.form_datetimepicker_group', [
                                    'fieldSize' => 4,
                                    'label' => trans('pulsar::pulsar.from'),
                                    'name' => 'dateFrom',
                                    'data' => [
                                        'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                                        'locale' => config('app.locale')
                                    ]
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('pulsar::includes.html.form_datetimepicker_group', [
                                    'fieldSize' => 4,
                                    'label' => trans('pulsar::pulsar.to'),
                                    'name' => 'dateTo',
                                    'data' => [
                                        'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                                        'locale' => config('app.locale')
                                    ]
                                ])
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn margin-r10">{{ trans('pulsar::pulsar.search') }}</button>
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