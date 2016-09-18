@extends('pulsar::layouts.form')

@section('rows')
    <!-- booking::family.create -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => 'ID',
        'name' => 'id',
        'value' => old('id', isset($object->id_223)? $object->id_223 : null),
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_223)? $object->name_223 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('booking::pulsar.mail_template'),
        'name' => 'mailTemplate',
        'value' => old('mailTemplate', isset($object->mail_template_223)? $object->mail_template_223 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    <!-- /booking::family.create -->
@stop