@extends('dashboards.layouts.admin-dash-layout')
@section('title', 'Grupos de Acesso')

@section('actions')
    <a data-toggle="modal" data-target="#modal-form" class="btn btn-float has-text">
        <i class="nav-icon fa fa-user"></i><span>Cadastrar<br>Grupo de Acesso</span>
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="form-group col-md-12">
            {!! $dataTable->table(['class' => 'table table-condensed table-striped']) !!}
        </div>
    </div>

    {{-- FORMULÁRIO DE CADASTRO --}}
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" enctype="multipart/form-data" method="post" class="form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-semibold">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-semibold">Descrição</label>
                                <textarea name="descricao" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {!! $dataTable->scripts() !!}
@endsection