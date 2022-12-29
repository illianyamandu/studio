$(function(){
    $(".form-ajax-master").on('submit', function(e){
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
                $(".form-ajax-master")[0].reset();
                $(".modal").modal('toggle');
                $(".table-datatable").DataTable().ajax.reload();
                toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
                console.log('oi');
            },
            error:function(data){
                let response = data.responseJSON;
                $.each(response.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
        });
    });
});