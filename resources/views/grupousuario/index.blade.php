@extends('dashboards.layouts.admin-dash-layout')
@section('title', 'Lista de usuários')
@section('content')

    <div class="row div-datatable">
        <div class="form-group col-md-12">
            {!! $dataTable->table(['class' => 'table table-condensed table-striped table-datatable']) !!}
        </div>
    </div>
    {!! $dataTable->scripts() !!}
@endsection
