$(obtener_registros());

function obtener_registros(fletero)
{
	$.ajax({
		url : 'buscadorB.php',
		type : 'POST',
		dataType : 'html',
		data : { fletero: fletero },
		})

	.done(function(resultado){
		$("#resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});
