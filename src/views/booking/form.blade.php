@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- booking::booking.form -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.magnific-popup').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });

            $('#objectWrapper, #hotelData, #spaData, #wineryData').hide();

            $('[name=place]').on('change', function () {
                var url     = '{{ route('bookingGetDataObjects', ['model' => '%model%']) }}';
                var self    = this;

                $.ajax({
                    type: "POST",
                    url: url.replace('%model%', $(this).children('option:selected').data('model')),
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(data)
                    {
                        if(data.objects == undefined)
                        {
                            // hide select with objects
                            $('#objectWrapper').fadeOut();

                            if($('#spaData').is(":visible"))
                                $('#spaData').slideToggle("slow");
                            if($('#wineryData').is(":visible"))
                                $('#wineryData').slideToggle("slow");
                            if($('#hotelData').is(":visible"))
                                $('#hotelData').slideToggle("slow");
                        }
                        else
                        {
                            // remove all options add empty option
                            $('[name=object]').find('option').remove().end().append($('<option>', {
                                value: null,
                                text : '{{ trans('pulsar::pulsar.select_a') }} ' + data.name
                            })).trigger("change");

                            // add label text
                            $('#objectLabel').html(data.name);

                            // add options values
                            $.each(data.objects, function (i, item) {
                                $('[name=object]').append($('<option>', {
                                    value: item[data.primaryKey],
                                    text : item['name_' + data.suffix]
                                }));
                            });

                            // show select with objects
                            $('#objectWrapper').fadeIn();

                            if($(self).children('option:selected').data('model') == 1)
                            {
                                if($('#spaData').is(":visible"))
                                    $('#spaData').slideToggle("slow");
                                if($('#wineryData').is(":visible"))
                                    $('#wineryData').slideToggle("slow");

                                $('#hotelData').slideToggle("slow");
                            }

                            if($(self).children('option:selected').data('model') == 2)
                            {
                                if($('#hotelData').is(":visible"))
                                    $('#hotelData').slideToggle("slow");
                                if($('#spaData').is(":visible"))
                                    $('#spaData').slideToggle("slow");

                                $('#wineryData').slideToggle("slow");
                            }

                            if($(self).children('option:selected').data('model') == 3)
                            {
                                if($('#hotelData').is(":visible"))
                                    $('#hotelData').slideToggle("slow");
                                if($('#wineryData').is(":visible"))
                                    $('#wineryData').slideToggle("slow");

                                $('#spaData').slideToggle("slow");
                            }
                        }
                    }
                });
            });

            // *********
            // * dates *
            // *********
            var now = moment()
            $('[name=checkInDate]')
                .closest('.datetimepicker')
                .data("DateTimePicker")
                .options({
                    defaultDate: now,
                    minDate: now
                });

            $('[name=checkInDate]')
                .closest('.datetimepicker')
                .on('dp.change', function(ev) {
                    var minDate = ev.date.add(1, 'days');

                    $('[name=checkOutDate]')
                        .closest('.datetimepicker')
                        .data("DateTimePicker")
                        .minDate(minDate);

                    if($('[name=checkOutDate]').closest('.datetimepicker').data("DateTimePicker").date() < minDate && $('[name=checkOutDate]').closest('.datetimepicker').data("DateTimePicker").date() != null)
                        $('[name=checkOutDate]').closest('.datetimepicker').data("DateTimePicker").date(ev.date);
                });

            $('[name=checkOutDate]')
                .closest('.datetimepicker')
                .data("DateTimePicker")
                .options({
                    minDate: moment().add(1, 'days'),
                    useCurrent: true
                });

            $('[name=checkOutDate]')
                .closest('.datetimepicker')
                .on('dp.change', function(ev) {
                    var days          = ev.date.diff($('[name=checkInDate]').closest('.datetimepicker').data("DateTimePicker").date(), 'days');
                    $('[name=nights]').val(days);
                });
        });

        $.relatedCustomer = function (data)
        {
            var value = '';
            var flag = false;

            if(data.name_301 != null)
            {
                value += data.name_301;
                flag = true;
            }

            if(data.surname_301 != null)
            {
                if(flag)
                    value += ' ';
                else
                    flag = true;

                value += data.surname_301;
            }

            if(data.company_301 != null)
            {
                if(flag)
                    value += ' (' + data.company_301 + ')';
                else
                    value += data.company_301;
            }

            $('[name="customer"]').val(value);
            $('[name="customerId"]').val(data.id_301);

            $.magnificPopup.close();
        }
    </script>
    <!-- /booking::booking.form -->
@stop

@section('rows')
    <!-- booking::booking.form -->
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'label' => 'ID',
                'name' => 'id',
                'value' => old('id', isset($object->id_225)? $object->id_225 : null),
                'readOnly' => true
            ])
            @include('pulsar::includes.html.form_select_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans_choice('pulsar::pulsar.status', 1),
                'name' => 'status',
                'value' => old('status', isset($object->status_225)? $object->status_225 : null),
                'objects' => $statuses,
                'idSelect' => 'id',
                'nameSelect' => 'name'
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 6,
                'label' => trans_choice('pulsar::pulsar.date', 1),
                'name' => 'date',
                'value' => isset($object->date_text_225)? $object->date_text_225 : date(config('pulsar.datePattern')),
                'readOnly' => true,
            ])
        </div>
    </div>

    @include('pulsar::includes.html.form_iframe_select_group', [
        'label' => trans_choice('pulsar::pulsar.customer', 1),
        'name' => 'customer',
        'value' => old('customer', isset($object->customer_name_225)? $object->customer_name_225 : null),
        'valueId' => old('customerId', isset($object->customer_id_225)? $object->customer_id_225 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'modalUrl' => route('crmCustomer', [
            'offset' => 0,
            'modal' => 1
        ]),
        'required' => true,
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_textarea_group', [
        'label' => trans('booking::pulsar.customer_observations'),
        'name' => 'customerObservations',
        'value' => old('customerObservations', isset($object->customer_observations_225)? $object->customer_observations_225 : null)
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => trans_choice('booking::pulsar.place', 1),
        'name' => 'place',
        'value' => (int)old('place', isset($object->place_id_226)? $object->place_id_226 : null),
        'objects' => $places,
        'idSelect' => 'id_220',
        'nameSelect' => 'name_220',
        'dataOption' => [
            'model' => 'model_id_220'
        ]
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => isset($objectName)? $objectName : null,
        'containerId' => 'objectWrapper',
        'labelId' => 'objectLabel',
        'name' => 'object',
        'value' => (int) old('object', isset($object->object_id_226)? $object->object_id_226 : null),
        'objects' => isset($objects)? $objects : null,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-product-outer-container'
        ]
    ])

    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.date', 2), 'icon' => 'fa fa-calendar'])
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('booking::pulsar.check_in_date'),
                'name' => 'checkInDate',
                'value' => old('checkInDate', isset($object->check_in_date_225)? date(config('pulsar.datePattern'), $object->check_in_date_225) : null),
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                    'locale' => config('app.locale')
                ]
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('booking::pulsar.check_out_date'),
                'name' => 'checkOutDate',
                'value' => old('checkOutDate', isset($object->check_out_date_225)? date(config('pulsar.datePattern'), $object->check_out_date_225) : null),
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                    'locale' => config('app.locale')
                ]
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => trans_choice('pulsar::pulsar.night', 2),
        'name' => 'nights',
        'value' => old('nights', isset($object->nights_225)? $object->nights_225 : 1),
        'readOnly' => true
    ])

    @include('pulsar::includes.html.form_section_header', ['label' => trans('pulsar::pulsar.people'), 'icon' => 'fa fa-users'])
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_select_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans_choice('pulsar::pulsar.adult', 2),
                'name' => 'nAdults',
                'value' => old('nAdults', isset($object->n_adults_225)? $object->n_adults_225 : null),
                'objects' => $nAdults,
                'idSelect' => 'id',
                'nameSelect' => 'name'
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_select_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans_choice('pulsar::pulsar.child', 2),
                'name' => 'nChildren',
                'value' => old('nChildren', isset($object->n_children_225)? $object->n_children_225 : null),
                'objects' => $nChildren,
                'idSelect' => 'id',
                'nameSelect' => 'name'
            ])
        </div>
    </div>

    <!-- HOTEL section -->
    <div id="hotelData">
        @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('hotels::pulsar.hotel', 1), 'icon' => 'fa fa-h-square'])
        @include('pulsar::includes.html.form_text_group', [
            'label' => trans('booking::pulsar.room_type'),
            'name' => 'roomDescription',
            'value' => old('roomDescription', isset($object->object_description_225)? $object->object_description_225 : null)
        ])
        <div class="row">
            <div class="col-md-6">
                @include('pulsar::includes.html.form_select_group', [
                    'labelSize' => 4,
                    'fieldSize' => 8,
                    'label' => trans_choice('hotels::pulsar.room', 2),
                    'name' => 'nRooms',
                    'value' => old('nRooms', isset($object->n_rooms_225)? $object->n_rooms_225 : null),
                    'objects' => $nRooms,
                    'idSelect' => 'id',
                    'nameSelect' => 'name'
                ])
                @include('pulsar::includes.html.form_select_group', [
                    'labelSize' => 4,
                    'fieldSize' => 8,
                    'label' => trans('booking::pulsar.breakfast'),
                    'name' => 'breakfast',
                    'value' => old('breakfast', isset($object->breakfast_225)? $object->breakfast_225 : null),
                    'objects' => $breakfast,
                    'idSelect' => 'id',
                    'nameSelect' => 'name'
                ])
            </div>
            <div class="col-md-6">
                @include('pulsar::includes.html.form_select_group', [
                    'labelSize' => 4,
                    'fieldSize' => 8,
                    'label' => trans_choice('booking::pulsar.temporary_bed', 2),
                    'name' => 'temporaryBeds',
                    'value' => old('temporaryBeds', isset($object->temporary_beds_225)? $object->temporary_beds_225 : null),
                    'objects' => $temporaryBeds,
                    'idSelect' => 'id',
                    'nameSelect' => 'name'
                ])
            </div>
        </div>
        @include('pulsar::includes.html.form_textarea_group', [
            'label' => trans('booking::pulsar.hotel_observations'),
            'name' => 'hotelObservations',
            'value' => old('hotelObservations', isset($object->place_observations_225)? $object->place_observations_225 : null)
        ])
    </div>

    <!-- SPA section -->
    <div id="spaData">
        @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('spas::pulsar.spa', 1), 'icon' => 'fa fa-tint'])
        @include('pulsar::includes.html.form_text_group', [
            'label' => trans_choice('hotels::pulsar.room', 1),
            'name' => 'roomDescription',
            'value' => old('roomDescription', isset($object->object_description_225)? $object->object_description_225 : null)
        ])
        @include('pulsar::includes.html.form_textarea_group', [
            'label' => trans('booking::pulsar.spa_observations'),
            'name' => 'hotelObservations',
            'value' => old('hotelObservations', isset($object->place_observations_225)? $object->place_observations_225 : null)
        ])
    </div>

    <!-- WINERY section -->
    <div id="wineryData">
        @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('wineries::pulsar.winery', 1), 'icon' => 'fa fa-glass'])
        @include('pulsar::includes.html.form_text_group', [
            'label' => trans_choice('hotels::pulsar.room', 1),
            'name' => 'roomDescription',
            'value' => old('roomDescription', isset($object->object_description_225)? $object->object_description_225 : null)
        ])
        @include('pulsar::includes.html.form_textarea_group', [
            'label' => trans('booking::pulsar.winery_observations'),
            'name' => 'hotelObservations',
            'value' => old('hotelObservations', isset($object->place_observations_225)? $object->place_observations_225 : null)
        ])
    </div>

    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('booking::pulsar.voucher', 2), 'icon' => 'fa fa-sort-alpha-asc'])
    @include('pulsar::includes.html.form_iframe_multiple_select_group', [
        'modalUrl' => route('crmCustomer', [
            'offset' => 0,
            'modal' => 1
        ]),



        'id' => 'forwards',
        'label' => trans('booking::pulsar.add_voucher'),
        'icon'  => 'fa fa-share',
        'dataJson' => isset($forwards)? $forwards : null,
        'thead' => [(object)['class' => null, 'data' => trans('pulsar::pulsar.id')], (object)['class' => null, 'data' => trans('pulsar::pulsar.prefix')], (object)['class' => 'align-center', 'data' => trans_choice('pulsar::pulsar.comment', 2)], (object)['class' => 'align-center', 'data' => trans_choice('pulsar::pulsar.state', 2)]],
        'tbody' => [
            (object)['include' => 'pulsar::includes.html.form_text_group', 'properties' => ['label' => trans('pulsar::pulsar.name'), 'name' => 'name_402', 'required' => true, 'maxLength' => '100', 'rangeLength' => '2,100']],
            (object)['include' => 'pulsar::includes.html.form_text_group', 'properties' => ['label' => trans('pulsar::pulsar.email'), 'name' => 'email_402', 'type' => 'email', 'required' => true, 'maxLength' => '50', 'rangeLength' => '2,50', 'fieldSize' => 5]],
            (object)['include' => 'pulsar::includes.html.form_checkbox_group', 'class' => 'align-center', 'properties' => ['label' => trans_choice('pulsar::pulsar.comment', 2), 'name' => 'comments_402', 'value' => 1]],
            (object)['include' => 'pulsar::includes.html.form_checkbox_group', 'class' => 'align-center', 'properties' => ['label' => trans_choice('pulsar::pulsar.state', 2), 'name' => 'states_402', 'value' => 1]]
        ]
    ])

    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.amount', 2), 'icon' => 'fa fa-usd'])
    @include('pulsar::includes.html.form_textarea_group', [
        'label' => trans_choice('pulsar::pulsar.observations', 2),
        'name' => 'observations',
        'value' => old('observations', isset($object->observations_225)? $object->observations_225 : null)
    ])
    <!-- /booking::booking.form -->
@stop