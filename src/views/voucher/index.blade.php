@extends('pulsar::layouts.index')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/js/select2.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/js/i18n/' . config('app.locale') . '.js') }}"></script>
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
                        { "visible": false, "targets": [6,7]}, // hidden column 1 and prevents search on column 1
                        { "visible": false, "searchable": false, "targets": [3]}, // hidden column 1 and prevents search on column 1
                        { "dataSort": 3, "targets": [4] }, // sort column 2 according hidden column 1 data
                        { "sortable": false, "targets": [12,13]},
                        { "class": "checkbox-column", "targets": [12]},
                        { "class": "align-center", "targets": [9,10,13]}
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


                $('#advancedSearch').click(function (e) {
                    // set target of request
                    $('[name=target]').val('advancedSearch');
                    $('#advancedSearchForm').submit();
                });

                $('.export-file').click(function (e) {
                    // set target of request
                    $('[name=target]').val('export');
                    $('[name=extensionFile]').val($(this).data('extension-file'));
                    $('#advancedSearchForm').submit();
                });

                $('#advancedSearchForm').submit(function (e) {

                    // TODO, check number of rows, if there are not any rows, don't export to excel

                    // reset dates values to set values from datepicker
                    $('[name=dateFrom], [name=dateTo]').val('');

                    // get seconds unix timestamp from datetimepicker
                    if($('#dateFromPicker').data("DateTimePicker").date() !== null)
                        $('[name=dateFrom]').val($('#dateFromPicker').data("DateTimePicker").date().unix());

                    if($('#dateToPicker').data("DateTimePicker").date() !== null)
                        $('[name=dateTo]').val($('#dateToPicker').data("DateTimePicker").date().unix());


                    // set params and reload datatable object
                    if($('[name=target]').val() === 'advancedSearch')
                    {
                        e.preventDefault();
                        var that = this;

                        // reload datatable with new query
                        tableInstance.fnSettings().ajax.data = function (parameters) {
                            //set here advanced search parameters, convert form to array
                            parameters.searchColumns = $(that).serializeArray();
                        };

                        // call to api datatable
                        $('.datatable-pulsar').DataTable().ajax.reload();
                    }

                    // check if there are results with this advanced search to export
                    if($('[name=target]').val() === 'export')
                    {
                        e.preventDefault();
                        var that = this;

                        // check number results
                        $.ajax({
                            dataType:   'json',
                            type:       'POST',
                            url:        '{{ route('bookingVoucherAdvancedSearchDataCount') }}',
                            data:       $(this).serialize(),
                            headers:  {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success:  function(data)
                            {
                                if(data.success == true && data.nRows > 0)
                                {
                                    $(that).unbind('submit').submit()
                                }
                                else
                                {
                                    new PNotify({
                                        type:   'error',
                                        title:  '{{ trans('pulsar::pulsar.action_error') }}',
                                        text:   '{{ trans('pulsar::pulsar.no_data_advanced_search_to_export') }}',
                                        opacity: .9,
                                        styling: 'fontawesome'
                                    });
                                }
                            }
                        });
                    }
                });
            }

            // display advenced search form
            $('#advancedSearchContent').hide();
            $('.advanced-search').on('click', function(){
                $('#advancedSearchContent').slideToggle("slow");
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
                    <form id="advancedSearchForm" class="form-horizontal" method="post" action="{{ route('exportCsvBookingVoucher') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <!-- set operations columns -->
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'operationColumns',
                                    'value' => json_encode([
                                            ['column' => 'price_226', 'operation' => 'sum'],
                                            ['column' => 'cost_226', 'operation' => 'sum']
                                        ])
                                ])

                                <!-- set query order -->
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'order',
                                    'value' => json_encode([
                                            'column' => 'id_226',
                                            'dir' => 'asc'
                                        ])
                                ])

                                <!-- set in javascrit where sent petition, datatable or export file -->
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'target'
                                ])

                                <!-- set type file to export -->
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'extensionFile'
                                ])

                                <!-- start form -->
                                @include('pulsar::includes.html.form_datetimepicker_group', [
                                    'fieldSize' => 4,
                                    'label' => trans('pulsar::pulsar.from'),
                                    'name' => 'dateFromPicker',
                                    'id' => 'dateFromPicker',
                                    'data' => [
                                        'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                                        'locale' => config('app.locale')
                                    ]
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'dateFrom'
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'dateFrom_operator',
                                    'value' => '>'
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'dateFrom_column',
                                    'value' => 'date_226'
                                ])
                                @include('pulsar::includes.html.form_select_group', [
                                    'fieldSize' => 8,
                                    'label' => trans_choice('booking::pulsar.campaign', 1),
                                    'name' => 'campaign',
                                    'value' => null,
                                    'objects' => $campaigns,
                                    'idSelect' => 'id_221',
                                    'nameSelect' => 'name_221',
                                    'class' => 'select2',
                                    'data' => [
                                        'language' => config('app.locale'),
                                        'width' => '100%',
                                        'error-placement' => 'select2-product-outer-container'
                                    ]
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'campaign_operator',
                                    'value' =>  '='
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'campaign_column',
                                    'value' =>  'campaign_id_226'
                                ])

                            </div>
                            <div class="col-md-6">
                                @include('pulsar::includes.html.form_datetimepicker_group', [
                                    'fieldSize' => 4,
                                    'label' => trans('pulsar::pulsar.to'),
                                    'name' => 'dateToPicker',
                                    'id' => 'dateToPicker',
                                    'data' => [
                                        'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                                        'locale' => config('app.locale')
                                    ]
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' => 'dateTo'
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'dateTo_operator',
                                    'value' =>  '<'
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'dateTo_column',
                                    'value' =>  'date_226'
                                ])

                                @include('pulsar::includes.html.form_select_group', [
                                    'fieldSize' => 4,
                                    'label' => trans('booking::pulsar.used'),
                                    'name' => 'used',
                                    'value' => null,
                                    'objects' => $used,
                                    'idSelect' => 'id',
                                    'nameSelect' => 'name'
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'used_operator',
                                    'value' =>  '='
                                ])
                                @include('pulsar::includes.html.form_hidden', [
                                    'name' =>   'used_column',
                                    'value' =>  'has_used_226'
                                ])
                            </div>
                        </div>
                        <div class="form-actions">
                            <button id="advancedSearch" type="button" class="btn margin-r10">{{ trans('pulsar::pulsar.search') }}</button>
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-upload"></i> {{ trans_choice('pulsar::pulsar.export', 1) }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="export-file" data-extension-file="csv" href="#"><i class="fa fa-table"></i> CSV</a></li>
                                    <li><a class="export-file" data-extension-file="xls" href="#"><i class="fa fa-file-excel-o"></i> Excel (.xls)</a></li>
                                    <li><a class="export-file" data-extension-file="xlsx" href="#"><i class="fa fa-file-excel-o"></i> Excel (.xlsx)</a></li>
                                </ul>
                            </div>
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
        <th>{{ trans('pulsar::pulsar.expire_date') }}</th>
        <th>{{ trans('pulsar::pulsar.expire_date') }}</th>
        <th data-hide="phone">{{ trans_choice('pulsar::pulsar.name', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.bearer', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.name', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.price', 1) }}</th>
        <th>{{ trans('pulsar::pulsar.active') }}</th>
        <th>{{ trans('pulsar::pulsar.paid') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.cost', 1) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /booking::voucher.index -->
@stop