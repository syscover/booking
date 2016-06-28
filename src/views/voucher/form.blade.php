@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- booking::voucher.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    @include('pulsar::includes.html.froala_references')

    <script>
        $(document).ready(function() {
            $('.magnific-popup').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });

            $('.wysiwyg').froalaEditor({
                language: '{{ config('app.locale') }}',
                toolbarInline: false,
                toolbarSticky: true,
                tabSpaces: true,
                shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', 'insertLink', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                toolbarButtonsMD: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', 'insertLink', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                heightMin: 130,
                enter: $.FroalaEditor.ENTER_BR,
                key: '{{ config('pulsar.froalaEditorKey') }}'
            });

            $('[name=campaign]').on('change', function () {

                $.updateCodePrefix();
            });

            $('[name=product]').on('change', function () {

                $.updateCodePrefix();

                if($(this).val() == '')
                {
                    $('[name=price]').val('');
                    $('[name=name]').val('');
                    $('[name=description]').froalaEditor('html.set', '');
                }
                else
                {
                    var url = '{{ route('apiShowMarketProduct', ['lang' => base_lang()->id_001, 'id' => '%id%', 'api' => 1]) }}';
                    $.ajax({
                        type: "POST",
                        url: url.replace('%id%', $(this).val()),
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function(data)
                        {
                            $('[name=price]').val(data.price_111);
                            $('[name=name]').val(data.name_112);
                            $('[name=description]').froalaEditor('html.set', data.description_112);
                        }
                    });
                }
            });

            $('[name=place]').on('change', function () {
                var url = '{{ route('bookingGetDataObjects', ['model' => '%model%']) }}';
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
                        }
                    }
                });
            });

            @if(! isset($objects))
                $('#objectWrapper').hide();
            @endif

            // start invoice ID
            $.formatInvoice = function(invoice) {
                if(invoice.invoiceNumberFormatted == undefined)
                {
                    return '{{ trans('pulsar::pulsar.searching') }}...';
                }
                else
                {
                    return invoice.invoiceNumberFormatted;
                }
            };

            $.formatInvoiceSelection = function (invoice) {
                if(invoice.invoiceNumberFormatted == undefined)
                {
                    @if(isset($invoices))
                        return '{{ $invoices->first()->invoiceNumberFormatted }}'
                    @else
                        return invoice;
                    @endif
                }
                else
                {
                    // save data in input hidden to save in controller
                    $('[name=invoiceCode]').val(invoice.invoiceNumberFormatted);
                    $('[name=invoiceCustomerId]').val(invoice.client.id);
                    $('[name=invoiceCustomerName]').val(invoice.client.name);

                    return invoice.invoiceNumberFormatted;
                }
            };

            var itemsPerPage = 25; // intems per page
            $('#invoiceId').select2({
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    url: '{{ route('apiFacturadirectaInvoices') }}',
                    data: function (params) {
                        return {
                            invoiceNumberFormatted:  params.term, // search term
                            start: params.page * itemsPerPage,
                            limit: itemsPerPage
                        };
                    },
                    dataType: 'json',
                    delay: 300,
                    processResults: function (data, params) {

                        params.page = params.page || 0;

                        return {
                            results: data.invoice,
                            pagination: {
                                more: (params.page * itemsPerPage) < data.attributes.total
                            }
                        }
                    },
                    cache: true
                },
                minimumInputLength: 1,
                templateResult: $.formatInvoice,
                templateSelection: $.formatInvoiceSelection
            });
            // end invoice ID
        });

        function relatedCustomer(data)
        {
            console.log(data)

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

        $.updateCodePrefix = function(){
            var productPrefix = $('[name=product]').children('option:selected').data('prefix');
            var campaignPrefix = $('[name=campaign]').children('option:selected').data('prefix');

            if(productPrefix == undefined || productPrefix == '')
            {
                if(campaignPrefix == undefined || campaignPrefix == '')
                    $('[name=codePrefix]').val('');
                else
                    $('[name=codePrefix]').val(campaignPrefix);
            }
            else
            {
                if(campaignPrefix == undefined || campaignPrefix == '')
                    $('[name=codePrefix]').val(productPrefix);
                else
                    $('[name=codePrefix]').val(campaignPrefix + '-' + productPrefix);
            }
        };

    </script>
    <!-- /.booking::voucher.create -->
@stop

@section('rows')
    <!-- booking::voucher.create -->
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'label' => 'ID',
                'name' => 'id',
                'value' => old('id', isset($object->id_226)? $object->id_226 : null),
                'readOnly' => true
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 6,
                'label' => trans_choice('pulsar::pulsar.date', 1),
                'name' => 'date',
                'value' => isset($object->date_text_226)? $object->date_text_226 : date(config('pulsar.datePattern')),
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 6,
                'label' => trans('pulsar::pulsar.prefix'),
                'name' => 'codePrefix',
                'value' => old('codePrefix', isset($object->code_prefix_226)? $object->code_prefix_226 : null),
                'maxLength' => '255',
                'rangeLength' => '2,255',
                'readOnly' => true
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_select_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans_choice('pulsar::pulsar.invoice', 1),
                'id' => 'invoiceId',
                'name' => 'invoiceId',
                'value' => old('customerId', isset($object->invoice_id_226)? $object->invoice_id_226 : null),
                'objects' => isset($invoices)? $invoices : null,
                'idSelect' => 'id',
                'nameSelect' => 'invoiceNumberFormatted',
                'data' => [
                    'language' => config('app.locale'),
                    'width' => '100%',
                    'error-placement' => 'select2-customerId-outer-container'
                ]
            ])
            @include('pulsar::includes.html.form_hidden', [
                'name' => 'invoiceCode',
                'value' => old('invoiceCode', isset($object->invoice_code_226)? $object->invoice_code_226 : null),
            ])
            @include('pulsar::includes.html.form_hidden', [
                'name' => 'invoiceCustomerId',
                'value' => old('invoiceCustomerId', isset($object->invoice_customer_id_226)? $object->invoice_customer_id_226 : null),
            ])
            @include('pulsar::includes.html.form_hidden', [
                'name' => 'invoiceCustomerName',
                'value' => old('invoiceCustomerName', isset($object->invoice_customer_name_226)? $object->invoice_customer_name_226 : null),
            ])
        </div>
    </div>

    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => trans_choice('booking::pulsar.campaign', 1),
        'name' => 'campaign',
        'value' => (int)old('campaign', isset($object->campaign_id_226)? $object->campaign_id_226 : null),
        'objects' => $campaigns,
        'idSelect' => 'id_221',
        'nameSelect' => 'name_221',
        'required' => true,
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-product-outer-container'
        ],
        'dataOption' => [
            'prefix' => 'prefix_221'
        ]
    ])
    @include('pulsar::includes.html.form_iframe_select_group', [
        'label' => trans_choice('pulsar::pulsar.customer', 1),
        'name' => 'customer',
        'value' => old('customer', isset($object->customer_name_226)? $object->customer_name_226 : null),
        'valueId' => old('customerId', isset($object->customer_id_226)? $object->customer_id_226 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'modalUrl' => route('crmCustomer', [
            'offset' => 0,
            'modal' => 1
        ]),
        'required' => true,
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans_choice('pulsar::pulsar.bearer', 1),
        'name' => 'bearer',
        'value' => old('bearer', isset($object->bearer_226)? $object->bearer_226 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255'
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => trans_choice('market::pulsar.product', 1),
        'name' => 'product',
        'value' => (int)old('product', isset($object->product_id_226)? $object->product_id_226 : null),
        'objects' => $products,
        'idSelect' => 'id_111',
        'nameSelect' => 'name_112',
        'required' => true,
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-product-outer-container'
        ],
        'dataOption' => [
            'prefix' => 'prefix_222'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_226)? $object->name_226 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_wysiwyg_group', [
        'label' => trans_choice('pulsar::pulsar.description', 1),
        'name' => 'description',
        'value' => old('description', isset($object->description_226)? $object->description_226 : null)
    ])
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'type' => 'number',
                'label' => trans_choice('pulsar::pulsar.price', 1),
                'name' => 'price',
                'value' => old('price', isset($object->price_226)? $object->price_226 : null),
                'required' => true
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('pulsar::pulsar.expire_date'),
                'name' => 'expireDate',
                'value' => old('expireDate', isset($object->expire_date_226)? date(config('pulsar.datePattern'), $object->expire_date_226) : date(str_replace('d', 't', config('pulsar.datePattern')), strtotime('+1 years'))),
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                    'locale' => config('app.locale')
                ]
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_checkbox_group', [
       'label' => trans('pulsar::pulsar.active'),
       'name' => 'active',
       'value' => 1,
       'checked' => old('active', isset($object->active_226)? $object->active_226 : true)
   ])

    @if($action == 'update')
        @include('pulsar::includes.html.form_section_header', [
            'label' => trans_choice('booking::pulsar.booking', 1),
            'icon' => 'fa fa-hourglass-end'
        ])
        @include('pulsar::includes.html.form_datetimepicker_group', [
            'fieldSize' => 4,
            'label' => trans('booking::pulsar.used_date'),
            'name' => 'usedDate',
            'data' => [
                'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                'locale' => config('app.locale'),
                'default-date' => old('usedDate', isset($object->used_date_226)? date('Y-m-d', $object->used_date_226) : null)
            ]
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
        @include('pulsar::includes.html.form_text_group', [
            'fieldSize' => 2,
            'type' => 'number',
            'label' => trans_choice('pulsar::pulsar.cost', 1),
            'name' => 'cost',
            'value' => old('cost', isset($object->cost_226)? $object->cost_226 : null)
        ])


        @include('pulsar::includes.html.form_section_header', [
            'label' => trans('pulsar::pulsar.paid'),
            'icon' => 'fa fa-credit-card-alt'
        ])
        @include('pulsar::includes.html.form_datetimepicker_group', [
            'fieldSize' => 4,
            'label' => trans('pulsar::pulsar.paid'),
            'name' => 'payoutDate',
            'data' => [
                'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                'locale' => config('app.locale'),
                'default-date' => old('payoutDate', isset($object->place_payout_date_226)? date('Y-m-d', $object->place_payout_date_226) : null)
            ]
        ])
    @endif

    @if(isset($bulk) && $bulk == 1)
        @include('pulsar::includes.html.form_section_header', [
            'label' => trans('booking::pulsar.vouchers_bulk_create'),
            'icon' => 'fa fa-bolt'
        ])
        @include('pulsar::includes.html.form_text_group', [
            'fieldSize' => 3,
            'type' => 'number',
            'label' => trans('booking::pulsar.vouchers_number'),
            'name' => 'bulkCreate',
            'value' => old('bulkCreate'),
            'min' => '1',
            'max' => '10000',
            'required' => true
        ])
    @endif
    <!-- /.booking::voucher.create -->
@stop