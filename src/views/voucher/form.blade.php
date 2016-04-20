@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- booking::voucher.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.magnific-popup').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-fade'
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
    @include('pulsar::includes.html.form_datetimepicker_group', [
        'fieldSize' => 4,
        'label' => trans_choice('pulsar::pulsar.date', 1),
        'name' => 'date',
        'data' => [
            'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
            'locale' => config('app.locale'),
            'default-date' => old('date', isset($object->date_220)? date('Y-m-d', $object->date_220) : null)
        ]
    ])
    <!-- /.booking::voucher.create -->
@stop