(function($){
    $(function(){

    	$('.confirm').click(function() {

            $.ajax({
                url:$(this).attr('data-confirm'),
                type:'POST',
                //dataType: 'json',
                //data:formData,
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function(){ 
                    $('.progress').removeClass('hide');
                }
            })
           .done(function(respuesta){
                var json = $.parseJSON(respuesta);
                
                // if(json.confirmForm != null)
                // {
                //     $('#confirmForm').attr('action',json.confirmForm);
                //     $('#confirmForm').removeClass('hide');
                //     $('#confirmSubmit').attr('type','submit');
                // }
                // else
                // {
                //     $('#confirmForm').removeAttr('action');
                //     $('#confirmForm').addClass('hide');
                //     $('#confirmSubmit').removeAttr('type','submit');
                // }

                // $('.confirmPreload').val(json.confirmPreload);
                // $('#confirmAction').val(json.confirmAction);
                // $('#confirmId').val(json.confirmId);
                // $('#confirmInfo').html(json.confirmInfo);
            
            })
            .fail(function(respuesta) {
                M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
            })
            .always(function(respuesta) {
                $('.progress').addClass('hide'); 
                console.log(respuesta);
            });
        });

    });
})(jQuery);