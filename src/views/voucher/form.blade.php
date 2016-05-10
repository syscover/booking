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
            })

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
            })
        })

        function relatedCustomer(data)
        {
            $('[name="customer"]').val(data.name_301 + ' ' + data.surname_301)
            $('[name="customerId"]').val(data.id_301)

            $.magnificPopup.close()
        }
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
                'value' => old('id', isset($object->id_220)? $object->id_220 : null),
                'readOnly' => true
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 6,
                'label' => trans_choice('pulsar::pulsar.date', 1),
                'name' => 'date',
                'value' => isset($object->date_text_220)? $object->date_text_220 : date(config('pulsar.datePattern')),
                'readOnly' => true,
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 8,
        'label' => trans_choice('market::pulsar.product', 1),
        'name' => 'product',
        'value' => (int)old('company', isset($object->company_078)? $object->company_078 : null),
        'objects' => $campaigns,
        'idSelect' => 'id_111',
        'nameSelect' => 'name_112',
        'required' => true,
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-product-outer-container'
        ]
    ])
    @include('pulsar::includes.html.form_iframe_select_group', [
        'label' => trans_choice('pulsar::pulsar.customer', 1),
        'name' => 'customer',
        'value' => old('customer', isset($object->name_076)? $object->name_076 : null),
        'valueId' => old('customerId', isset($object->customer_220)? $object->customer_220 : null),
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
        'fieldSize' => 8,
        'label' => trans_choice('market::pulsar.product', 1),
        'name' => 'product',
        'value' => (int)old('company', isset($object->company_078)? $object->company_078 : null),
        'objects' => $products,
        'idSelect' => 'id_111',
        'nameSelect' => 'name_112',
        'required' => true,
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-product-outer-container'
        ]
    ])

    @include('pulsar::includes.html.form_text_group', [
         'fieldSize' => 4,
        'label' => trans('pulsar::pulsar.code'),
        'name' => 'code',
        'value' => old('code', isset($object->code_220)? $object->code_220 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_220)? $object->name_220 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_wysiwyg_group', [
        'label' => trans_choice('pulsar::pulsar.description', 1),
        'name' => 'description',
        'value' => old('description', isset($object->description_220)? $object->description_220 : null)
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
                    'default-date' => old('usedDate', isset($object->used_date_220)? date('Y-m-d', $object->used_date_220) : null)
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
                    'default-date' => old('expireDate', isset($object->date_220)? date('Y-m-d', $object->date_220) : null)
                ]
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.active'),
        'name' => 'active',
        'value' => 1,
        'checked' => old('active', isset($object->active_220)? $object->active_220 : true)
    ])
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'labelSize' => 4,
                'fieldSize' => 4,
                'type' => 'number',
                'label' => trans_choice('pulsar::pulsar.price', 1),
                'name' => 'price',
                'value' => old('price', isset($object->price_220)? $object->price_220 : null),
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
                'value' => old('cost', isset($object->cost_220)? $object->cost_220 : null),
                'maxLength' => '255',
                'rangeLength' => '2,255'
            ])
        </div>
    </div>

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