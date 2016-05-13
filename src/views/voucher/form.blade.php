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

            // start invoice ID
            $.formatInvoice = function(invoice) {
                if(invoice.invoiceNumberFormatted == undefined)
                {
                    return '{{ trans('pulsar::pulsar.searching') }}...';
                }
                else
                {
                    return invoice.invoiceNumberFormatted;

//                    if(Array.isArray(customer.tradeName))
//                    {
//                        return customer.companyCode + ' ' + customer.name
//                    }
//                    else
//                    {
//                        return customer.companyCode + ' ' + customer.name + ' (' + customer.tradeName + ')'
//                    }
                }
            };

            $.formatInvoiceSelection = function (invoice) {
                if(invoice.invoiceNumberFormatted == undefined)
                {
                    @if(isset($customers))
                        return '{{ $customers->first()->companyCode . ' ' . $customers->first()->name . (empty($customers->first()->tradeName)? null : ' ('. $customers->first()->tradeName .')') }}'
                    @else
                        return invoice;
                    @endif
                }
                else
                {
                    return invoice.invoiceNumberFormatted;
//                    if(Array.isArray(customer.tradeName))
//                    {
//                        $('[name=customerName]').val(customer.companyCode + ' ' + customer.name)
//                        return customer.companyCode + ' ' + customer.name
//                    }
//                    else
//                    {
//                        $('[name=customerName]').val(customer.companyCode + ' ' + customer.name + ' (' + customer.tradeName + ')')
//                        return customer.companyCode + ' ' + customer.name + ' (' + customer.tradeName + ')'
//                    }
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
                            //invoiceNumberFormatted:  params.term, // search term
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
            $('[name="customer"]').val(data.name_301 + ' ' + data.surname_301);
            $('[name="customerId"]').val(data.id_301);

            $.magnificPopup.close();
        }

        $.updateCodePrefix = function(){
            var productPrefix = $('[name=product]').children('option:selected').data('prefix');
            var campaignPrefix = $('[name=campaign]').children('option:selected').data('prefix');

            if(productPrefix == undefined || productPrefix == '')
            {
                if(campaignPrefix == undefined || campaignPrefix == '')
                    $('[name=prefix]').val('');
                else
                    $('[name=prefix]').val(campaignPrefix);
            }
            else
            {
                if(campaignPrefix == undefined || campaignPrefix == '')
                    $('[name=prefix]').val(productPrefix);
                else
                    $('[name=prefix]').val(campaignPrefix + '-' + productPrefix);
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
                'readOnly' => true,
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 6,
                'label' => trans('pulsar::pulsar.prefix'),
                'name' => 'prefix',
                'value' => old('prefix', isset($object->prefix_226)? $object->prefix_226 : null),
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
                'nameSelect' => 'name',
                'required' => true,
                'data' => [
                    'language' => config('app.locale'),
                    'width' => '100%',
                    'error-placement' => 'select2-customerId-outer-container'
                ]
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
        'value' => old('customer', isset($object->name_076)? $object->name_076 : null),
        'valueId' => old('customerId', isset($object->customer_226)? $object->customer_226 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'modalUrl' => route('crmCustomer', [
            'offset' => 0,
            'modal' => 1
        ]),
        'required' => true,
        'readOnly' => true
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
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('booking::pulsar.used_date'),
                'name' => 'usedDate',
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                    'locale' => config('app.locale'),
                    'default-date' => old('usedDate', isset($object->used_date_226)? date('Y-m-d', $object->used_date_226) : null)
                ]
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('pulsar::pulsar.expire_date'),
                'name' => 'expireDate',
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
                    'locale' => config('app.locale'),
                    'default-date' => old('expireDate', isset($object->date_226)? date('Y-m-d', $object->date_226) : null)
                ]
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'type' => 'number',
                'label' => trans_choice('pulsar::pulsar.price', 1),
                'name' => 'price',
                'value' => old('price', isset($object->price_226)? $object->price_226 : null),
                'maxLength' => '255',
                'rangeLength' => '2,255',
                'required' => true
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'type' => 'number',
                'label' => trans_choice('pulsar::pulsar.cost', 1),
                'name' => 'cost',
                'value' => old('cost', isset($object->cost_226)? $object->cost_226 : null),
                'maxLength' => '255',
                'rangeLength' => '2,255'
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_checkbox_group', [
       'label' => trans('pulsar::pulsar.active'),
       'name' => 'active',
       'value' => 1,
       'checked' => old('active', isset($object->active_226)? $object->active_226 : true)
   ])

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
            'max' => '1000',
            'required' => true
        ])
    @endif
    <!-- /.booking::voucher.create -->
@stop