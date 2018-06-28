function pais(valor){
	var url = 'DibujaEstado.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divEstado', url, { method: 'get', parameters: pars});
}
function usuarios(valor){
	var url = 'DibujaUsuario.php';
	var pars = ("filtro=" + valor);
	var myAjax = new Ajax.Updater('divUsuario', url, { method: 'get', parameters: pars});
}