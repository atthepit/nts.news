function validate()
{
    submitHandler: function(form) {
        
        var hay_errores = false;
        $("label.error, input.error, select.error, textarea.error").removeClass("error");
        
        $(".required").each(function(){
            if($(this).val().trim() =="" || $(this).val().trim() == -1){
                $(this).addClass("error");                            
                hay_errores = true;
            }
        });
        //marca el primero de los campos con errores.
        $("input.error, select.error, textarea.error").first().focus();
        if($('#tiene_imagen').val() == 0 && $('#img').val() == '')
        {
            $('#img').addClass('error');
            hay_errores = true;
        }
        
        return hay_errores;
    }
}