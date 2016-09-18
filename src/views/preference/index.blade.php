@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- booking::preference.index -->
    @include('pulsar::includes.js.messages')
    <!-- /booking::preference.index -->
@stop

@section('rows')
    <!-- booking::preference.index -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 3,
        'type' => 'number',
        'label' => trans('booking::pulsar.vouchers_bulk_create'),
        'name' => 'nVouchersToCreate',
        'value' => (int)$nVouchersToCreate->value_018,
        'min' => '1',
        'max' => '2000',
        'required' => true
    ])
    <!-- /booking::preference.index -->
@stop