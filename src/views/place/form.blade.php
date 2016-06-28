@extends('pulsar::layouts.form')

@section('rows')
    <!-- booking::place.create -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => 'ID',
        'name' => 'id',
        'value' => old('id', isset($object->id_220)? $object->id_220 : null),
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => trans_choice('pulsar::pulsar.model', 1),
        'name' => 'model',
        'value' => (int)old('model', isset($object->model_id_220)? $object->model_id_220 : null),
        'objects' => $models,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'required' => true,
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '100%',
            'error-placement' => 'select2-model-outer-container'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_220)? $object->name_220 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    <!-- /.booking::place.create -->
@stop