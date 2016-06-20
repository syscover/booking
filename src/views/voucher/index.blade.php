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

                    // reset value datepicker
                    $('[name=dateFrom], [name=dateTo]').val('');

                    // get seconds unix timestamp from datetimepicker
                    if($('#dateFromPicker').data("DateTimePicker").date() !== null)
                        $('[name=dateFrom]').val($('#dateFromPicker').data("DateTimePicker").date().unix());

                    if($('#dateToPicker').data("DateTimePicker").date() !== null)
                        $('[name=dateTo]').val($('#dateToPicker').data("DateTimePicker").date().unix());



                    tableInstance.fnSettings().ajax.data = function (parameters) {
                        //set here custom parameters
                        parameters.searchColumns = $(that).serializeArray();
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
                                    'required' => true,
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
                                    'value' =>  'campaign_id_226'
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