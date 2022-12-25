<style>
  .actions{
    display: flex;
  }

  .actions a{
    margin-right: 3px;
  }
</style>

<div class="actions">
<a class="btn btn-primary btn-sm rounded-0" data-toggle="modal" data-target="{{'#modal-'.$user->id}}" type="button" title="Grupo">
    <i class="fa fa-layer-group"></i>
</a>
{{-- <form action="{{ route('cliente.delete', $id) }}" enctype="multipart/form-data" method="post" class="form">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger btn-sm rounded-0" type="submit" title="Excluir">
      <i class="fa fa-trash"></i>
  </button>
</form> --}}
</div>

<div class="modal fade" id="{{'modal-'.$user->id}}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Definir grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('grupousuario.create')}}" enctype="multipart/form-data" method="post" class="form">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="text-semibold">Grupo</label>
                                <select class="form-control" name="grupo" id="" required>
                                <option selected disabled >Selecione um grupo</option>
                                    @foreach($grupos as $grupo)
                                        <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="user" value="{{$user->id}}">
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