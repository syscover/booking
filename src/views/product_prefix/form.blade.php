@extends('pulsar::layouts.form')

@section('rows')
    <!-- booking::product_prefix.create -->
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 7,
        'label' => trans_choice('pulsar::pulsar.product', 1),
        'name' => 'product',
        'value' => (int)old('product', isset($object->product_id_222)? $object->product_id_222 : null),
        'objects' => $products,
        'idSelect' => 'id_111',
        'nameSelect' => 'name_112',
        'required' => $action != 'update',
        'class' => 'select2',
        'disabled' => $action == 'update',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-model-outer-container'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 3,
        'label' => trans('pulsar::pulsar.prefix'),
        'name' => 'prefix',
        'value' => old('prefix', isset($object->prefix_222)? $object->prefix_222 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    <!-- /booking::product_prefix.create -->
@stop