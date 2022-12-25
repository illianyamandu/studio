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
<form action="{{ route('grupo.delete', $id) }}" enctype="multipart/form-data" method="post" class="form">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm rounded-0" type="submit" title="Excluir">
      <i class="fa fa-trash"></i>
  </button>
</form>
</div>

<div class="modal fade" id="{{'modal-'.$id}}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('grupo.update', $id) }}" enctype="multipart/form-data" method="post" class="form">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-semibold">Nome</label>
                                <input type="text" class="form-control" name="nome" required value="{{$nome}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-semibold">Descrição</label>
                                <textarea name="descricao" cols="30" rows="5" class="form-control" style="resize: none;">{{isset($descricao) && $descricao != '' ? $descricao : null}}</textarea>
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
