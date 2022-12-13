<style>
  .actions{
    display: flex;
  }

  .actions a{
    margin-right: 3px;
  }
</style>

<div class="actions">
<a class="btn btn-primary btn-sm rounded-0" data-toggle="modal" data-target="{{'#modal-'.$id}}" type="button" title="Editar">
    <i class="fa fa-pen"></i>
</a>
<form action="{{ route('cliente.delete', $id) }}" enctype="multipart/form-data" method="post" class="form">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm rounded-0" type="submit" title="Excluir">
      <i class="fa fa-trash"></i>
  </button>
</form>
</div>

<div class="modal fade" id="{{'modal-'.$id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('cliente.update', $id) }}" enctype="multipart/form-data" method="post" class="form">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Nome</label>
                                <input type="text" class="form-control" name="nome" required value="{{$nome}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-semibold">E-mail</label>
                                <input type="email" class="form-control" name="email" value="{{$email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="{{$instagram}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-semibold">Data de nascimento</label>
                                <input type="date" class="form-control" name="data_nascimento" required value="{{\Carbon\Carbon::parse($data_nascimento)->format('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label class="text-semibold">Endereço</label>
                                <input type="text" name="endereco" class="form-control" value="{{$endereco}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-semibold">Status</label>
                                <select name="status" class="form-control" required>
                                    <option {{$status == 1 ? 'selected' : ''}} value="1">Ativo</option>
                                    <option {{$status == 0 ? 'selected' : ''}} value="0">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="text-semibold">CPF</label>
                                <input type="text" class="form-control" name="cpf" required value="{{$cpf}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-semibold">RG</label>
                                <input type="text" class="form-control" name="rg" value="{{$rg}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text-semibold">Telefone</label>
                                <input type="text" class="form-control" name="telefone" required value="{{$telefone}}">
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
