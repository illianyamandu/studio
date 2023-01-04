@if($nome != 'cliente' && $nome != 'administrador' && $nome != 'colaborador')
<style>
  .actions{
    display: flex;
  }

  .actions {
    gap: 3px;
  }
</style>

<div class="actions">
    <a class="btn btn-primary btn-sm rounded-0" data-toggle="modal" data-target="{{'#modal-'.$id}}" type="button" title="Editar">
        <i class="fa fa-pen"></i>
    </a>
    <form action="{{ route('grupo.delete', $id) }}" enctype="multipart/form-data" method="post" class="form" id="{{'form-delete-'.$id}}">
    @csrf
    @method('DELETE')
        <button class="btn btn-danger btn-sm rounded-0" type="submit" title="Excluir" id="{{'delete-'.$id}}">
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
                <form action="{{ route('grupo.update', $id) }}" enctype="multipart/form-data" method="post" class="form" id="{{'form-'.$id.'-edit'}}">
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
                                <label class="text-semibold">Título</label>
                                <input type="text" class="form-control" name="titulo" required value="{{$titulo}}">
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


    <script>
    $(document).on('click', '#delete-'+{{$id}}, function(e){
        e.preventDefault();
        
        Swal.fire({
            title: 'Deseja excluir o registro?',
            text: "O registro será permanentemente removido!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, desejo excluir!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form-delete-"+{{$id}}).submit();
            }
        })
    });

</script>
    
<script>
    $(function(){
    $("#form-"+{{$id}}+"-edit").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                $(".modal").modal('hide');
                toastr.success(data.message)
                $(".form-ajax-master")[0].reset();
                $(".table-datatable").DataTable().ajax.reload();
            },
            error:function(data){
                let response = data.responseJSON;
                $.each(response.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                    toastr.error(val[0]);
                });
            }
        });
    });
});
</script>

<script>
    $(function(){
    $("#form-delete-"+{{$id}}).on('submit', function(e){
    
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                $(".modal").modal('hide');
                toastr.success(data.message)
                $(".form-ajax-master")[0].reset();
                $(".table-datatable").DataTable().ajax.reload();
            },
            error:function(data){
                let response = data.responseJSON;
                $.each(response.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                    toastr.error(val[0]);
                });
            }
        });
    });
});
</script>
@endif