@extends('pulsar::layouts.form')

@section('rows')
    <!-- booking::campaign.create -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => 'ID',
        'name' => 'id',
        'value' => old('id', isset($object->id_221)? $object->id_221 : null),
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_221)? $object->name_221 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 4,
        'label' => trans('pulsar::pulsar.prefix'),
        'name' => 'prefix',
        'value' => old('prefix', isset($object->prefix_221)? $object->prefix_221 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255'
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'fieldSize' => 4,
        'label' => trans('pulsar::pulsar.active'),
        'name' => 'active',
        'value' => 1,
        'checked' => old('active', isset($object->active_221)? $object->active_221 : null),
    ])
    <!-- /booking::campaign.create -->
@stop