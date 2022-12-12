@extends('dashboards.layouts.admin-dash-layout')
@section('title', 'Lista de clientes')

@section('actions')
    <a href="{{route('cliente.form')}}" class="btn btn-float has-text">
        <i class="nav-icon fa fa-user"></i><span>Cadastrar<br>Cliente</span>
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="form-group col-md-12">
            {!! $dataTable->table(['class' => 'table table-condensed table-striped']) !!}
        </div>
    </div>

    {{-- FORMULÁRIO DE CADASTRO --}}
    {{-- <div class="modal fade" id="modal-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('cliente.create') }}" enctype="multipart/form-data" method="post" class="form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-semibold">E-mail</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Instagram</label>
                                <input type="text" name="instagram" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Data de nascimento</label>
                                <input type="date" class="form-control" name="data_nascimento" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="text-semibold">Endereço</label>
                                <input type="text" name="endereco" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-semibold">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" selected>Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="text-semibold">CPF</label>
                                <input type="text" class="form-control" name="cpf" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-semibold">RG</label>
                                <input type="text" class="form-control" name="rg">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text-semibold">Telefone</label>
                                <input type="text" class="form-control" name="telefone" required>
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
    </div> --}}
    {!! $dataTable->scripts() !!}
@endsection
