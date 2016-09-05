@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- booking::booking.form -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.magnific-popup').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-fade'
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
    <!-- /booking::booking.form -->
@stop