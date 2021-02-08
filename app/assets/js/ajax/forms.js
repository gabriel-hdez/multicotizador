(function($){
    $(function(){   
        var form = $('form');

        for (var i = 0; i < form.length; i++) 
        {
            var enviar = '#'+$(form[i]).attr('id');
            $(enviar).submit(function(event)
            {
                var formData = new FormData($(this)[0]);
                event.preventDefault();
                
                $.ajax({
                    url:$(this).attr('action'),
                    type:$(this).attr('method'),
                    data:formData,
                    processData:false,
                    contentType:false,
                    //dataType: 'json',
                    //cache:false,
                    beforeSend:function(){ 
                        $('.progress').removeClass('hide');
                    }
                })
                .done(function(respuesta){
                    var json = $.parseJSON(respuesta);
                    if (json.respuesta == "alert")
                    {
                        // alert
                        Swal.fire({
                          title: 'Ruiz Cano & Asociados C.A',
                          type: json.tipo, // success, error, warning, info, question
                          text: json.texto,
                          showConfirmButton: false,
                          //confirmButtonColor: '#3085d6',
                          //confirmButtonText: 'OK!',
                          timer: 2500,
                        }).then(() => {
                            //console.log("Alerta cerrada");
                            window.location.href = json.redirigir;
                        })
                    }
                    if (json.respuesta == "toast")
                    {
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })
                        Toast.fire({
                          type: json.tipo,
                          title: json.texto
                        })
                    }
                    else
                    {
                        // validacion
                        /*$('input').removeClass('is-invalid').siblings('.helper-text').html();
                        for( var inputs in json)
                        {
                            if(json.hasOwnProperty(inputs))
                            {
                                var ids = "#"+inputs;
                                $(ids).addClass('is-invalid').siblings('.helper-text').html(json[inputs]);
                            }
                            else
                            {
                                $(ids).removeClass('is-invalid').siblings('.helper-text').html();
                            }
                        }*/
                        for( var inputs in json)
                        {
                            if(json.hasOwnProperty(inputs))
                            {
                                var ids = "#"+inputs;
                                $(ids).addClass('invalid').siblings('.helper-text').attr('data-error', json[inputs]);
                            }
                            else
                            {
                                $(ids).removeClass('invalid').siblings('.helper-text').attr('data-error', "");
                            }
                        }
                    }
                })
                .fail(function(respuesta) {
                     const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })
                        Toast.fire({
                          type: 'error',
                          title: 'Ha ocurrido un error fatal, contacte al soporte técnico'
                        })
                    
                    //$('.validate').addClass('invalid');
                })
                .always(function(respuesta) {
                    //$('.progress').addClass('hide');    
                    console.log(respuesta);
                });
            });
        }
    });
})(jQuery);